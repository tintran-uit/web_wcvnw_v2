<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use CrudTrait;
    use Sluggable, SluggableScopeHelpers;
    // use SoftDeletes;

     /*
	|--------------------------------------------------------------------------
	| GLOBAL VARIABLES
	|--------------------------------------------------------------------------
	*/

    protected $table = 'products';
    protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['name', 'short_description', 'farmer_id', 'description', 'image', 'thumbnail', 'unit_quantity', 'unit', 'price', 'category', 'created_at', 'updated_at', 'slug', 'en_name', 'en_description', 'en_short_description'];
    // protected $hidden = [];
    // protected $dates = [];
    // protected $casts = [
    //     'featured'  => 'boolean',
    //     'visible'   => 'boolean',
    // ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'slug_or_name',
            ],
        ];
    }

    /*
	|--------------------------------------------------------------------------
	| FUNCTIONS
	|--------------------------------------------------------------------------
	*/

    /*
	|--------------------------------------------------------------------------
	| RELATIONS
	|--------------------------------------------------------------------------
	*/
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category');
    }
    public function brand()
    {
        return $this->belongsTo('App\Models\Brand', 'brand_id');
    }
    public function farmer()
    {
        return $this->belongsTo('App\Models\Farmer', 'farmer_id');
    }

    public function sold()
    {
        return $this->belongsToMany('App\Models\Trading', 'product_id');
    }
    // public function package()
    // {
    //     $packages = App\Models\Product::where('category', 0)->get();
    //    return $packages;
    // }
//    public function images()
//    {
//        return $this->morphMany('App\Models\Image', 'imageable');
//    }

    /*
	|--------------------------------------------------------------------------
	| SCOPES
	|--------------------------------------------------------------------------
	*/

    public function scopeVisible($query)
    {
        return $query->where('visible', '1')
            ->orderBy('lft', 'ASC');
    }

    /*
	|--------------------------------------------------------------------------
	| ACCESORS
	|--------------------------------------------------------------------------
	*/

    // The slug is created automatically from the "name" field if no slug exists.
    public function getSlugOrNameAttribute()
    {
        if ($this->slug != '') {
            return $this->slug;
        }

        return $this->name;
    }

    /*
	|--------------------------------------------------------------------------
	| MUTATORS
	|--------------------------------------------------------------------------
	*/
}
