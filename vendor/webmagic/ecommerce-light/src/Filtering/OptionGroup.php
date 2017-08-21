<?php


namespace Webmagic\EcommerceLight\Filtering;


use Illuminate\Database\Eloquent\Model;
use Rutorika\Sortable\SortableTrait;

class OptionGroup extends Model
{
    use SortableTrait;

    /** @var array Activate mass assignment fields  */
    protected $fillable = ['name', 'title'];

    /** @var string  */
    protected $table = 'ecom_option_groups';

    /** @var bool  */
    public $timestamps = false;

    /**
     * Option groups constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->fillable = array_merge($this->fillable, config('webmagic.ecommerce.option_groups_available_fields'));

        parent::__construct($attributes);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function options()
    {
        return $this->hasMany(Option::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function filters()
    {
        return $this->belongsToMany(Filter::class, 'ecom_filter_option_group');
    }
}
