<?php

namespace Webmagic\EcommerceLight\Product;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use IvanLemeshev\Laravel5CyrillicSlug\Slug;
use Webmagic\Core\Entity\EntityRepo;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;

class ProductRepo extends EntityRepo implements ProductRepoContract
{

    /**
     * Use for getting current entity
     *
     */
    protected $entity = Product::class;

    /**
     * Use for  check is table in joins
     * Need for optimize joins in query
     *
     * @var array
     */
    protected $joined_tables = [];


    /**
     * Return product by slug
     *
     * @param $slug
     *
     * @return Product|null
     */
    public function getBySlug($slug)
    {
        $query = $this->query();
        $query->where('ecom_products.slug', $slug);

        return $this->realGetOne($query);
    }


    /**
     * Return product by Id
     *
     * @param $id
     *
     * @return Product|null
     */
    public function getById($id)
    {
        $query = $this->query();
        $query->where('ecom_products.id', $id);

        return $this->realGetOne($query);
    }


    /**
     * Return all products without grouping
     *
     * @param null $products_per_page
     *
     * @return Collection|LengthAwarePaginator
     */
    public function getAll($products_per_page = null)
    {
        return $this->realGetMany(null, $products_per_page);
    }


    /**
     * Return all active products
     * Check product status and product category status
     *
     * @param null $products_per_page
     *
     * @return Collection|LengthAwarePaginator
     */
    public function getAllActive($products_per_page = null)
    {
        return $this->realGetMany(null, $products_per_page, true);
    }

    /**
     * Return products filtered by currency ID
     *
     * @param      $category_id
     * @param int $products_per_page
     * @param bool $active_only
     *
     * @return Collection|LengthAwarePaginator
     */
    public function getByCategoryID($category_id, $products_per_page = null, $active_only = false)
    {
        $query = $this->addCategoryFilter(null, $category_id);

        return $this->realGetMany($query, $products_per_page, $active_only);
    }

    /**
     * Return products filtered by categories
     *
     * @param array|integer $categories_id
     * @param null $products_per_page
     * @param bool $active_only
     *
     * @return Collection|LengthAwarePaginator
     */
    public function getByCategories($categories_id = null, $products_per_page = null, $active_only = false)
    {
        $query = null;

        if(!is_null($categories_id)){
            $query = $this->addCategoryFilter($query, $categories_id);
        }

        return $this->realGetMany($query, $products_per_page, $active_only);
    }



    /**
     * Return data about products (count, count of active, ect)
     *
     * @return bool|array
     */
    public function getData()
    {
        $query = $this->query();
        $products_data = $query->select(
            DB::raw('COUNT(IF(active,1,null)) as active, COUNT(IF(!active,1,null)) as un_active, COUNT(*) as total')
        )->get();

        if($products_data){
            return $products_data->toArray()[0];
        }

        return false;
    }


    /**
     * @param array $product_data
     *
     * @return Product
     */
    public function create(array $product_data)
    {
        if(isset($product_data['price'])) {
            $product_data = $this->roundPrice($product_data);
        }

        if(!isset($product_data['slug']) || empty($product_data['slug'])){
            $product_data['slug'] = $this->slugGenerate($product_data['name']);
        }

        $query = $this->query();

        $product = $query->create($product_data);

        if(isset($product_data['options'])){
            $product->options()->sync($product_data['options']);
        }

        if(isset($product_data['additional_categories'])){
            $product->additionalCategories()->sync($product_data['additional_categories']);
        }

        return $product;
    }


    /**
     * Round price and price with discount
     *
     * @param array $product_data
     * @return array
     */
    protected function roundPrice(array $product_data)
    {
        $product_data['price'] = round($product_data['price'], 2);

        return $product_data;
    }


    /**
     * Generate slug by name
     *
     * @param string $name
     * @return string
     */
    protected function slugGenerate(string $name)
    {
        $slug = new Slug();
        return $slug->make($name, '-');
    }

    /**
     * Conversion currency and save all changes in product
     *
     * @param $product_id
     * @param $product_data
     *
     * @return mixed
     */
    public function update($product_id, array $product_data)
    {
        if(isset($product_data['price'])){
            $product_data = $this->roundPrice($product_data);
        }

        if(!isset($product_data['slug']) || empty($product_data['slug'])){
            $product_data['slug'] = $this->slugGenerate($product_data['name']);
        }

        $query = $this->query();

        $product = $query->find($product_id);
        $product->update($product_data);

        if (isset($product_data['options']) && $product_data['options'][0]) {
            $product->options()->sync($product_data['options']);
        }

        if(isset($product_data['additional_categories'])){
            $product->additionalCategories()->sync($product_data['additional_categories']);
        }

        return true;
    }


    /**
     * Destroy product with options
     *
     * @param int $product_id
     * @return int
     */
    public function destroy($product_id)
    {
        $query = $this->query();
        $product = $query->find($product_id);

        if(isset($product->options) && !$product->options->isEmpty()){

            foreach ($product->options as $option) {
                $options_id[] = $option['id'] ? $option['id'] : $option;
            }

            $product->options()->detach($options_id);
        }

        if(isset($product->additionalCategories) && !$product->additionalCategories->isEmpty()){

            foreach ($product->additionalCategories as $category) {
                $categories_id[] = $category['id'] ? $category['id'] : $category;
            }

            $product->additionalCategories()->detach($categories_id);
        }

        $product = $this->entity();

        return $product::destroy($product_id);
    }


    /**
     * Return all products grouped by category
     *
     * @return Collection
     */
    public function getAllWithCategoryGrouping()
    {
        $query = $this->query();
        $products = $this->realGetMany($query);

        return $products->groupBy('category_id');
    }


    /**
     * Change product status
     *
     * @param $product_id
     * @param $new_status
     *
     * @return bool
     */
    public function changeStatus($product_id, $new_status)
    {
        if(!is_bool($new_status)){
            return false;
        }

        $product = $this->getById($product_id);

        if(!$product){
            return false;
        }

        if(!$product->update(['active' => $new_status])){
            return false;
        }

        return true;
    }


    /**
     * Change product position
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
     * Change product position
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
     * Add join and select for base category data for query
     *
     * @param Builder    $query
     * @return Builder
     */
    protected function addMainCategoryData(Builder $query)
    {
        if(!$this->isTableJoined('ecom_categories')){

            $query->leftJoin('ecom_categories', 'ecom_categories.id', '=', 'ecom_products.category_id');
            $this->joined_tables[] = 'ecom_categories';
        }

        $query->addSelect('ecom_categories.name as category', 'ecom_categories.slug as category_slug');

        return $query;
    }


    /**
     * Add filtering by part of product name
     *
     * @param Builder|null $query
     * @param null         $product_name_part
     * @return Builder
     */
    public function addNameFilter(Builder $query = null, $product_name_part = null)
    {
        if(is_null($query)){
            $query = $this->query();
        }

        if(!is_null($product_name_part)) {
            $query = $query->where('ecom_products.name', 'like', '%' . $product_name_part . '%');
        }

        return $query;
    }


    /**
     * Add query part for filter products by category id
     *
     * @param Builder|null $query
     * @param integer|array $category_id
     *
     * @return Builder
     */
    protected function addCategoryFilter(Builder $query = null, $category_id)
    {
        if(is_null($query)){
            $query = $this->query();
        }

        if(!$this->isTableJoined('ecom_product_category')){
            $query->leftJoin('ecom_product_category', 'ecom_product_category.product_id', '=', 'ecom_products.id');
            $this->joined_tables[] = 'ecom_product_category';
        }

        if(is_array($category_id)){
            $query->where(function($query) use ($category_id){
                $query->whereIn('ecom_products.category_id', $category_id)
                    ->orWhereIn('ecom_product_category.category_id', $category_id);
            });
        } else {
            $query->where(function($query) use ($category_id){
                $query->where('ecom_products.category_id', $category_id)
                    ->orWhere('ecom_product_category.category_id', $category_id);
            });
        }

        return $query;
    }



    /**
     * Use for really get products by prepared query
     *
     * @param $query
     * @return Model
     */
    protected function realGetOne(Builder $query = null)
    {
        if(is_null($query)){
            $query = $this->query();
        }

        $query = $this->addMainCategoryData($query);

        if(config('webmagic.ecommerce.additional_category_use')) {
            $query->with('additionalCategories');
        }

        if(config('webmagic.ecommerce.filter_use')) {
            $query = $query->with('options');
        }

        $query = $query->addSelect('ecom_products.*');

        return $query->first();
    }

    /**
     * Use for really get products by prepared query
     *
     * @param $query
     * @param $products_per_page
     *
     * @param $active_only
     *
     * @return mixed
     */
    protected function realGetMany(Builder $query = null, $products_per_page = null, $active_only = false)
    {
        if(is_null($query)){
            $query = $this->query();
        }

        $query = $query->orderBy('ecom_products.active', 'desc');
        $query = $query->orderBy('ecom_products.position');

        //Add main category
        $query = $this->addMainCategoryData($query);


        //Active check
        if ($active_only) {
            $query = $query->where('ecom_products.active', 1);
        }

        //Select adding
        $query = $query->addSelect('ecom_products.*');


        if(config('webmagic.ecommerce.filer_use')){
            $query = $query->with('options');
        }

        //Clean tables for next request
        $this->joined_tables = [];

        //Paginate
        if (!is_null($products_per_page)) {
            $products = $query->paginate($products_per_page);

            //Need for correct links generation when paginate
            return $products->appends(Input::except('page'));
        }

        return $query->get();
    }

    /**
     * Check if table use in joins
     * Use for optimize join using
     *
     * @param $table_name
     *
     * @return bool
     */
    //todo Add correct check for joined tables
    protected function isTableJoined($table_name)
    {
        return in_array($table_name, $this->joined_tables);
    }


    /**
     * Destroy all products
     *
     * @return void
     */
    public function destroyAll()
    {
        $query = $this->query();
        return $query->delete();
    }

}