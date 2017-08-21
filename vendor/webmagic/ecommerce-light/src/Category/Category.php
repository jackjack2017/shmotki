<?php


namespace Webmagic\EcommerceLight\Category;

use Webmagic\EcommerceLight\Filtering\Filter;
use Webmagic\EcommerceLight\Product\Product;
use Nicolaslopezj\Searchable\SearchableTrait;
use Webmagic\Core\Presenter\PresentableTrait;
use Webmagic\Core\Presenter\Presenter;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;


class Category extends Model
{
    use  SearchableTrait, PresentableTrait, NodeTrait;

    /** @var  Presenter class that using for present model */
    protected $presenter = CategoryPresenter::class;


    /**
     * Hide params
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     *  The attributes that are mass assignable.
     */
    protected $fillable = ['name', 'slug', 'title', 'description', 'img', 'parent_id',
        'meta_title', 'meta_description', 'meta_keywords',
        'position', 'filter_id', 'active', 'images'];


    /** @var string Entity DB table */
    protected $table = "ecom_categories";


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
            'ecom_categories.name' => 10,
        ],
    ];


    /**
     * Product constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->fillable = array_merge($this->fillable, config('webmagic.ecommerce.category_available_fields'));

        parent::__construct($attributes);
    }

    /**
     * Relation with products
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products(){
        return $this->hasMany(Product::class);
    }

    /**
     * Relations with additional products
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function additionalProducts()
    {
        return $this->belongsToMany(Product::class, 'ecom_product_category');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function filter()
    {
        return $this->belongsTo(Filter::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subCategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}