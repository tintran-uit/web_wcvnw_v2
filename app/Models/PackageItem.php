<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackageItem extends Model
{
    use CrudTrait;
    //use Sluggable, SluggableScopeHelpers;
    //use SoftDeletes;

     /*
	|--------------------------------------------------------------------------
	| GLOBAL VARIABLES
	|--------------------------------------------------------------------------
	*/

    protected $table = 'm_packages';
    protected $primaryKey = 'id';
    public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['id', 'package_id', 'farmer_id', 'product_id','quantity', 'unit', 'price'];
     // protected $hidden = ['order_id'];
    // protected $dates = [];
    /*protected $casts = [
        'featured'  => 'boolean',
        'visible'   => 'boolean',
    ];*/


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
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }
    public function farmer()
    {
        return $this->belongsTo('App\Models\Farmer', 'farmer_id');
    }
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
    public function package()
    {
        return $this->belongsTo('App\Models\Product', 'package_id');
    }

    /*public function product_price()
    {
        $product = $this->belongsTo('App\Models\Product', 'product_id');
        return ($this->quantity * $product->price)/$product->unit_quantity;
    }*/

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
	| MUTATORS
	|--------------------------------------------------------------------------
	*/
}
