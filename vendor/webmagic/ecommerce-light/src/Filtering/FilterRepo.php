<?php


namespace Webmagic\EcommerceLight\Filtering;


use Webmagic\Core\Entity\EntityRepo;
use Webmagic\EcommerceLight\Ecommerce;

class FilterRepo extends EntityRepo
{

    /**
     * Use for getting current entity
     *
     */
    protected $entity = Filter::class;


    /**
     * Create filter
     *
     * @param array $entity_data
     * @return mixed
     */
    public function create(array $entity_data)
    {
        $query = $this->query();
        $filter = $query->create($entity_data);
        $filter->optionGroups()->attach($entity_data['option_groups']);

        return $filter;
    }


    /**
     * Update filter
     *
     * @param int   $entity_id
     * @param array $entity_data
     *
     * @return mixed|void
     */
    public function update($entity_id, array $entity_data)
    {
        $query = $this->query();
        $filter = $query->find($entity_id);
        $filter->update($entity_data);

        return $filter->optionGroups()->sync($entity_data['option_groups']);
    }


    /**
     * Destroy filter
     *
     * @param array|int $filter_id
     *
     * @return int
     */
    public function destroy($filter_id)
    {
        $query = $this->query();
        $filter = $query->find($filter_id);

        $filter->optionGroups()->detach();

        return  $filter::destroy($filter_id);
    }


    /**
     * Return filter with option groups
     *
     * @param int $entity_id
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function getByID($entity_id)
    {
        $query = $this->query();
        $query->where('id', $entity_id)->with(['optionGroups' => function ($query) {
            $query->orderBy('position');
        }]);

        return $this->realGetOne($query);
    }


    /**
     * Return filter prepared for check
     *
     * @param $filter_id
     *
     * @return mixed
     */
    public function getForConfig($filter_id)
    {
        $query = $this->query();
        $filter_data = $query->join('ecom_filter_option_group', 'ecom_filters.id', '=', 'ecom_filter_option_group.filter_id')
            ->leftJoin('ecom_option_groups', 'ecom_option_groups.id', '=', 'ecom_filter_option_group.option_group_id')
            ->leftJoin('ecom_options', 'ecom_options.option_group_id', '=', 'ecom_option_groups.id')
            ->where('ecom_filters.id', $filter_id)
            ->select('ecom_filters.name', 'ecom_option_groups.title as option_group_title', 'ecom_options.value as option_value', 'ecom_options.id as option_id')
            ->orderBy('ecom_option_groups.position')
            ->get();


        $filter['options'] = $filter_data->groupBy('option_group_title')->toArray();
        $filter['name'] = $filter_data->first()['name'];

        return $filter;
    }

    /**
     * Return filter for config product
     *
     * @param $product_id
     *
     * @return bool|mixed
     */
    public function getForProductConfig($product_id)
    {
        $ecommerce = new Ecommerce();

        if(!$product = $ecommerce->productGetByID($product_id)){
            return false;
        }

        if(!$category = $ecommerce->categoryGetByID($product['category_id'])){
            return false;
        }

        return $this->getForConfig($category['filter_id']);
    }

    /**
     * Return filter without not need options for category
     *
     * Remove options if category have no products with them
     * Remove options if category have products with them by products are no active
     *
     * @param $filter_id
     * @param $category_id
     *
     * @return mixed
     */
    public function getForCategory($filter_id, $category_id)
    {
        $query = $this->query();
        $filter_data = $query->join('ecom_filter_option_group', 'ecom_filters.id', '=', 'ecom_filter_option_group.filter_id')
            ->leftJoin('ecom_option_groups', 'ecom_option_groups.id', '=', 'ecom_filter_option_group.option_group_id')
            ->leftJoin('ecom_options as o', 'o.option_group_id', '=', 'ecom_option_groups.id')
            ->join('ecom_product_option as p_o', 'p_o.option_id', '=', 'o.id' )
            ->join('ecom_products as p', 'p.id', '=', 'p_o.product_id')
            ->leftJoin('ecom_product_category as pc', 'pc.product_id', '=', 'p.id')
            ->where(function($query) use ($category_id) {
                $query->where('p.category_id', '=', $category_id)
                    ->orWhere('pc.category_id', '=', $category_id);
            })
            ->where('p.active', 1)
            ->where('ecom_filters.id', $filter_id)
            ->select('ecom_filters.name', 'ecom_option_groups.title as option_group_title', 'o.value as option_value', 'o.id as option_id', 'o.color as color')
            ->distinct()
            ->orderBy('ecom_option_groups.position')
            ->orderBy('o.position')
            ->get();

        $filter['name'] = $filter_data->first()['name'];

        $filter_data = $filter_data->groupBy('option_group_title');

        foreach($filter_data as $key => $filter)
        {
            if(count($filter) < 2){
                $filter_data->forget($key);
            }
        }

        $filter['options'] = $filter_data->toArray();

        return $filter;
    }
    
    


}