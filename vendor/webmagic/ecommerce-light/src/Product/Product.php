<?php

namespace Webmagic\EcommerceLight\Product;


use Illuminate\Database\Eloquent\Model;
use Webmagic\Core\Presenter\PresentableTrait;
use Laracasts\Presenter\Presenter;
use Webmagic\EcommerceLight\Category\Category;
use Webmagic\EcommerceLight\Filtering\Option;
use Rutorika\Sortable\SortableTrait;
use Nicolaslopezj\Searchable\SearchableTrait;


class Product extends Model
{

    use PresentableTrait, SortableTrait, SearchableTrait;

    /** @var  Presenter class that using for present model */
    protected $presenter = ProductPresenter::class;

    /**
     * Hide params
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     *  The attributes that are mass assignable.
     */
    protected $fillable = ['name', 'active', 'slug',
        'price', 'category_id',  'main_image',
        'images', 'short_description', 'description',
        'meta_title', 'meta_description', 'meta_keywords', 'file'];


    /** @var string Entityt DB table */
    protected $table = 'ecom_products';


    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'ecom_products.name' => 10,
        ],
    ];

    /**
     * Product constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->fillable = array_merge($this->fillable, config('webmagic.ecommerce.product_available_fields'));

        parent::__construct($attributes);
    }


    /**
     * Relations
     */

    /**
     * Relation with main category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relation with additional categories
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function additionalCategories()
    {
        return $this->belongsToMany(Category::class, 'ecom_product_category');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function options()
    {
        return $this->belongsToMany(Option::class, 'ecom_product_option');
    }

}