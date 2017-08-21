<?php


namespace Webmagic\EcommerceLight\Filtering;


use Illuminate\Database\Eloquent\Model;
use Webmagic\EcommerceLight\Product\Product;
use Rutorika\Sortable\SortableTrait;

class Option extends Model
{
    use SortableTrait;

    /** @var array Activate mass assignment fields */
    protected $fillable = ['value', 'option_group_id', 'color'];

    /** @var string  */
    protected $table = 'ecom_options';

    /** @var bool  */
    public $timestamps = false;


    /**
     * Option constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->fillable = array_merge($this->fillable, config('webmagic.ecommerce.option_available_fields'));

        parent::__construct($attributes);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function optionGroup()
    {
        return $this->belongsTo(OptionGroup::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}