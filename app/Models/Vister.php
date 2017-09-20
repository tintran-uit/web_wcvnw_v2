<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vister extends Model
{
    protected $primaryKey = 'id';
	protected $table = 'visters';
	protected $fillable = array('email');
}
