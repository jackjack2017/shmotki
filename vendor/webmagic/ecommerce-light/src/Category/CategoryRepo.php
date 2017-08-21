<?php


namespace Webmagic\EcommerceLight\Category;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Webmagic\Core\Entity\EntityRepo;
use IvanLemeshev\Laravel5CyrillicSlug\Slug;


class CategoryRepo extends EntityRepo implements CategoryRepoContract
{

    protected $entity = Category::class;


    /**
     * Create category with parents relations
     *
     * @param array $category_data
     *
     * @return bool|mixed
     */
    public function create(array $category_data)
    {
        //generate slug
        if(!isset($category_data['slug']) || empty($category_data['slug'])){
            $category_data['slug'] = $this->slugGenerate($category_data['name']);
        }
        //create category if doesn't have paren't id (without module nestedset)
        if(!isset($category_data['parent_id'])){
            return parent::create($category_data);
        }

        $node = new $this->entity($category_data);

        if($category_data['parent_id'] != 0){
            $parent = $this->getByID($category_data['parent_id']);
            $node->appendToNode($parent)->save();
        }

        return $node->save();
    }

    /**
     * Generate slug by name
     *
     * @param string $name
     *
     * @return string
     */
    protected function slugGenerate(string $name)
    {
        $slug = new Slug();
        return $slug->make($name, '-');
    }



    /**
     * Update entity by ID
     *
     * @param int|string $entity_id
     * @param array $category_data
     *
     * @return int
     */
    public function update($entity_id, array $category_data)
    {
        if(!isset($category_data['slug']) || empty($category_data['slug'])){
            $category_data['slug'] = $this->slugGenerate($category_data['name']);
        }

        $query = $this->query();
        $node = $query->find($entity_id);

        if(!isset($category_data['parent_id'])){
            return parent::update($entity_id, $category_data);
        }

        if($category_data['parent_id'] != 0){
            $parent = $this->getByID($category_data['parent_id']);
            $node->appendToNode($parent)->update();
        }

        return $node->update($category_data);
    }



    /**
     * Get all categories with multilevel
     *
     * @param bool $with_products
     *
     * @return Collection|mixed
     */
    public function getTree($with_products = true): Collection
    {
        $categories = $this->realGetMany($this->query(), $with_products);
        $nodes = $categories->toTree();

        return $nodes;
    }


    /**
     * Return all descendants of category
     *
     * @param Category $category
     * @param bool $with_products
     *
     * @return Collection
     */
    public function getAllChildren(Category $category, $with_products = true): Collection
    {
        if($with_products){
            $node = $this->entity();
            $node = $node::with('products');
        } else
            $node = $this->query();

        $categories = $node->descendantsOf($category);

        return $categories;
    }


    /**
     * Return collection of all parents
     *
     * @param Category $category
     * @param bool $with_products
     *
     * @return Collection
     */
    public function getParents(Category $category,  $with_products = true): Collection
    {
        $query = $category->ancestors();

        if($with_products){
            $query = $query->with('products');
        }

        return $query->get();
    }


    /**
     * Return all categories
     *
     * @param bool $with_products
     *
     * @return Collection
     */
    public function getAll($with_products = true): Collection
    {
        $query = $this->query();

        return $this->realGetMany($query, $with_products);
    }


    /**
     * Return all active categories
     *
     * @param bool $with_products
     *
     * @return Collection
     */
    public function getAllActive($with_products = true): Collection
    {
        $query = $this->query();
        $query->where('active', true);

        return $this->realGetMany($query, $with_products);
    }


    /**
     * Return category by id with products
     *
     * @param int $category_id
     * @param bool $with_products
     *
     * @return Category
     */
    public function getByID($category_id, $with_products = true)
    {
        $query = $this->query();
        $query->where('id', $category_id);

        return $this->realGetOne($query, $with_products);
    }


    /**
     * Return category by slug with products
     *
     * @param string $slug
     * @param bool $with_products
     *
     * @return Category
     */
    public function getBySlug(string $slug, $with_products = true)
    {
        $category_query = $this->query();
        $category_query->where('slug', $slug);

        return $this->realGetOne($category_query, $with_products);
    }


    /**
     * Return categories prepared for menu
     *
     * @return array
     */
    public function getForMenu(): array
    {
        $categories = $this->getAllActive();

        $menu = [];

        foreach($categories as $category)
        {
            if($category['parent_id'] != 0){
                $menu[$category['parent_id']]['sub-categories'][] = $this->prepareURL($category)->toArray();
            } else {
                $menu[$category['id']]['category'] = $this->prepareURL($category)->toArray();
            }
        }

        foreach ($menu as $key => $value){
            if(!isset($value['category'])){
                unset($menu[$key]);
            }
        }

        return $menu;
    }


    /**
     * Prepare url based on config rule
     *
     * @param Category $category
     *
     * @return Category
     */
    protected function prepareURL(Category $category)
    {
        $category['url'] = $category->present()->url;

        return $category;
    }


    /**`
     * Really get category
     *
     * @param Builder $query
     * @param bool $with_products
     *
     * @return Category
     */
    protected function realGetOne(Builder $query, $with_products = true)
    {
        if(config('webmagic.ecommerce.multilevel_categories')){
            $query = $query->with(['subCategories' => function($query) use($with_products){
                if($with_products){
                   $query->with('products');
                }
                $query->orderBy('position');
            }])->with('products');
        }

        $category = $query->first();

        if(config('webmagic.ecommerce.multilevel_categories') && $category) {
            $category = $this->addAssociatedCategories($category);
        }

        return $category;
    }


    /**
     *  Get all entities based on query
     *
     * @param Builder $query
     * @param bool $with_products
     *
     * @return Collection|static[]
     */
    protected function realGetMany(Builder $query, $with_products = true)
    {
        if($with_products){
            $query->with('products');
        }

        $categories = $query->get();

        return $categories;
    }


    /**
     * Add subcategories for category
     *
     * @param Category $category
     *
     * @return Category
     */
    protected function addAssociatedCategories(Category $category)
    {
        $category['sub_categories'] = $category['subCategories'];
        $category['parent_category'] =  $category['parent_id'] !== 0 ? Category::find($category['parent_id']) : false;

        return $category;
    }


    /**
     * Change category position
     *
     * @param $moving_entity_id
     * @param $base_entity_id
     */
    public function moveAfter($moving_entity_id, $base_entity_id)
    {
        $option = $this->query()->find($moving_entity_id);
        $option->moveAfter($this->query()->find($base_entity_id));
    }


    /**
     * Change category position
     *
     * @param $moving_entity_id
     * @param $base_entity_id
     */
    public function moveBefore($moving_entity_id, $base_entity_id)
    {
        $option = $this->query()->find($moving_entity_id);
        $option->moveBefore($this->query()->find($base_entity_id));
    }


    /**
     * Search by name or by part of name
     *
     * @param string $category_name_part
     *
     * @return Collection
     */
    public function searchByName(string $category_name_part)
    {
        $query = $this->query();
        $query->search($category_name_part, null, false, true);

        return $this->realGetMany($query);
    }

}