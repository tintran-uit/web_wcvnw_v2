<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use CrudTrait;
    //use Sluggable, SluggableScopeHelpers;
    //use SoftDeletes;

     /*
	|--------------------------------------------------------------------------
	| GLOBAL VARIABLES
	|--------------------------------------------------------------------------
	*/

    protected $table = 'g_orders';
    protected $primaryKey = 'id';
    public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['id', 'order_id', 'customer_id', 'shipper_id','rating', 'note','status', 'shipping_cost', 'delivery_phone', 'delivery_name', 'delivery_address','delivery_district', 'total', 'payment'];
    // protected $hidden = [];
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
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'customer_id');
    }
    public function status()
    {
        return $this->belongsTo('App\Models\Status', 'status');
    }
    public function farmer()
    {
        return $this->belongsTo('App\Models\Farmer', 'farmer_id');
    }
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
    public function shipper()
    {
        return $this->belongsTo('App\Models\Shipper', 'shipper_id');
    }
    public function district()
    {
        return $this->belongsTo('App\Models\District', 'delivery_district');
    }
    public function status_v()
    {
        return $this->belongsTo('App\Models\Status', 'status');
    }
    public function orderItem()
    {
        return $this->hasMany('App\Models\orderItem', 'order_id');
    }
    public function addItem()
    {
        return $this->hasMany('App\Models\orderItem', 'order_id');
    }

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
