<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\SoftDeletes;

class Farmer extends Model
{
    use CrudTrait;
    //use Sluggable, SluggableScopeHelpers;
    use SoftDeletes;

     /*
	|--------------------------------------------------------------------------
	| GLOBAL VARIABLES
	|--------------------------------------------------------------------------
	*/

    protected $table = 'farmers';
    protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['id','name', 'en_name','address', 'short_address', 'en_short_address', 'quality', 'en_quality', 'product_list', 'en_product_list', 'phone', 'rating', 'agent_id', 'rating_count', 'profile', 'en_profile', 'photo'];
    // protected $hidden = [];
    // protected $dates = [];
    /*protected $casts = [
        'featured'  => 'boolean',
        'visible'   => 'boolean',
    ];*/

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
    public function brand()
    {
        return $this->belongsTo('App\Models\Brand', 'brand_id');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\ProductCategory', 'products_categories','product_id','category_id');
    }

    public function images()
    {
        return $this->belongsToMany('App\Models\Image', 'products_images','product_id','image_id');
    }

//    public function images()
//    {
//        return $this->morphMany('App\Models\Image', 'imageable');
//    }

  
    /*
	|--------------------------------------------------------------------------
	| MUTATORS
	|--------------------------------------------------------------------------
	*/
}
