<?php


namespace Webmagic\EcommerceLight;


use Webmagic\EcommerceLight\Category\CategoryRepoContract;
use Webmagic\EcommerceLight\Contracts\Ecommerce as EcommerceContract;
use Webmagic\EcommerceLight\Filtering\FilterRepoContract;
use Webmagic\EcommerceLight\Filtering\FilterServiceContract;
use Webmagic\EcommerceLight\Filtering\OptionGroupContract;
use Webmagic\EcommerceLight\Filtering\OptionRepoContract;
use Webmagic\EcommerceLight\PHPDocs\PHPDocGenerationTrait;
use Webmagic\EcommerceLight\Product\ProductSearchContract;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;


/**********************************************************************************************************************
 * Webmagic\EcommerceLight\Product\ProductSearchContract
 **********************************************************************************************************************
 *
 * @method void productSearchByName(string $product_name_part, string $products_per_page, string $active_only)
 * @method void productSearchByNameInCategories(string $product_name_part, string $categories_id, string $products_per_page, string $active_only)
 * @method void productGetBySlug(string $slug)
 * @method void productGetById(string $id)
 * @method void productGetAll(string $products_per_page)
 * @method void productGetAllActive(string $products_per_page)
 * @method void productGetByCategoryID(string $category_id, string $products_per_page, string $active_only)
 * @method void productGetByCategories(string $categories_id, string $products_per_page, string $active_only)
 * @method void productGetData()
 * @method void productGetAllWithCategoryGrouping()
 * @method void productChangeStatus(string $product_id, string $new_status)
 * @method void productMoveAfter(string $moving_entity_id, string $base_entity_id)
 * @method void productMoveBefore(string $moving_entity_id, string $base_entity_id)
 * @method void productAddNameFilter(\Illuminate\Database\Eloquent\Builder $product_query, string $product_name_part)
 * @method void productCreate(array $product_data)
 * @method void productUpdate(string $product_id, array $product_data)
 * @method void productDestroy(string $entity_id)
 * @method void productDestroyAll()
 * @method array productGetForSelect(string $value, string $key)
 *
 **********************************************************************************************************************

 **********************************************************************************************************************
 * Webmagic\EcommerceLight\Category\CategoryRepoContract
 **********************************************************************************************************************
 *
 * @method \Illuminate\Database\Eloquent\Collection categoryGetTree(string $with_products)
 * @method void categoryCreate(array $category_data)
 * @method void categoryUpdate(string $entity_id, array $category_data)
 * @method \Illuminate\Database\Eloquent\Collection categoryGetAllChildren(\Webmagic\EcommerceLight\Category\Category $category, string $with_products)
 * @method \Illuminate\Database\Eloquent\Collection categoryGetParents(\Webmagic\EcommerceLight\Category\Category $category, string $with_products)
 * @method \Illuminate\Database\Eloquent\Collection categoryGetAll(string $with_products)
 * @method \Illuminate\Database\Eloquent\Collection categoryGetAllActive(string $with_products)
 * @method void categoryGetByID(string $id, string $with_products)
 * @method void categoryGetBySlug(string $slug, string $with_products)
 * @method array categoryGetForMenu()
 * @method void categoryMoveAfter(string $moving_entity_id, string $base_entity_id)
 * @method void categoryMoveBefore(string $moving_entity_id, string $base_entity_id)
 * @method void categorySearchByName(string $category_name_part)
 * @method void categoryDestroy(string $entity_id)
 * @method void categoryDestroyAll()
 * @method array categoryGetForSelect(string $value, string $key)
 *
 **********************************************************************************************************************

 **********************************************************************************************************************
 * Webmagic\EcommerceLight\Filtering\OptionGroupContract
 **********************************************************************************************************************
 *
 * @method void optionGroupGetByID(string $entity_id)
 * @method void optionGroupMoveAfter(string $moving_entity_id, string $base_entity_id)
 * @method void optionGroupMoveBefore(string $moving_entity_id, string $base_entity_id)
 * @method void optionGroupGetAll()
 * @method void optionGroupGetAllActive()
 * @method void optionGroupCreate(array $entity_data)
 * @method void optionGroupUpdate(string $entity_id, array $entity_data)
 * @method void optionGroupDestroy(string $entity_id)
 * @method void optionGroupDestroyAll()
 * @method array optionGroupGetForSelect(string $value, string $key)
 *
 **********************************************************************************************************************

 **********************************************************************************************************************
 * Webmagic\EcommerceLight\Filtering\OptionRepoContract
 **********************************************************************************************************************
 *
 * @method void optionMoveAfter(string $moving_entity_id, string $base_entity_id)
 * @method void optionMoveBefore(string $moving_entity_id, string $base_entity_id)
 * @method void optionGetAll()
 * @method void optionGetAllActive()
 * @method void optionGetByID(string $entity_id)
 * @method void optionCreate(array $entity_data)
 * @method void optionUpdate(string $entity_id, array $entity_data)
 * @method void optionDestroy(string $entity_id)
 * @method void optionDestroyAll()
 * @method array optionGetForSelect(string $value, string $key)
 *
 **********************************************************************************************************************

 **********************************************************************************************************************
 * Webmagic\EcommerceLight\Filtering\FilterRepoContract
 **********************************************************************************************************************
 *
 * @method void filterGetForConfig(string $filter_id)
 * @method void filterGetForProductConfig(string $product_id)
 * @method void filterGetForCategory(string $filter_id, string $category_id)
 * @method void filterGetAll()
 * @method void filterGetAllActive()
 * @method void filterGetByID(string $entity_id)
 * @method void filterCreate(array $entity_data)
 * @method void filterUpdate(string $entity_id, array $entity_data)
 * @method void filterDestroy(string $entity_id)
 * @method void filterDestroyAll()
 * @method array filterGetForSelect(string $value, string $key)
 *
 **********************************************************************************************************************

 **********************************************************************************************************************
 * Webmagic\EcommerceLight\Filtering\FilterServiceContract
 **********************************************************************************************************************
 *
 * @method void getFilteredGetFilteredProducts(string $category_id, array $options, string $products_per_page, string $active_only, array $brands)
 *
 *********************************************************************************************************************/


class Ecommerce implements EcommerceContract
{
    use PHPDocGenerationTrait;

    /** @var array Abstract entities for which access provided  */
    protected $classes = [
        'product' => ProductSearchContract::class,
        'category' => CategoryRepoContract::class,
        'optionGroup' => OptionGroupContract::class,
        'option' => OptionRepoContract::class,
        'filter' => FilterRepoContract::class,
        'getFiltered' => FilterServiceContract::class,
    ];

    /**
     * @param $method
     * @param $args
     *
     * @return mixed
     */
    public function __call($method, $args)
    {
        foreach ($this->classes as $alias => $abstract){
            if(strpos($method, $alias) === 0){
                $obj = app()->make($this->classes[$alias]);
                return $this->callMethod($obj, $args, $method, $alias);
            }
        }

        return new MethodNotAllowedException($method);
    }

    /**
     * Call method on obj with method name cleaning
     *
     * @param $obj
     * @param $args
     * @param $fullMethodName
     * @param $removeFromMethod
     *
     * @return mixed
     */
    protected function callMethod($obj, $args, $fullMethodName, $removeFromMethod)
    {
        $method = str_replace($removeFromMethod, '', $fullMethodName);

        try{
            return call_user_func_array([$obj, $method], $args);
        } catch (MethodNotAllowedException $e){
            return $e;
        }
    }
}