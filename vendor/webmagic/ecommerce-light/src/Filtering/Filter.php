<?php


namespace Webmagic\EcommerceLight\Filtering;


use Illuminate\Database\Eloquent\Model;
use Webmagic\EcommerceLight\Category\Category;

class Filter extends Model
{
    /** @var array  */
    protected $fillable = ['name'];

    /** @var array  */
    protected $table = 'ecom_filters';

    /** @var bool  */
    public $timestamps = false;

    /**
     * Filter constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->fillable = array_merge($this->fillable, config('webmagic.ecommerce.filter_available_fields'));

        parent::__construct($attributes);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function optionGroups()
    {
        return $this->belongsToMany(OptionGroup::class, 'ecom_filter_option_group');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories()
    {
        return $this->hasMany(Category::class);
    }


}