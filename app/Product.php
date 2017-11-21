<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = ['name', 'description'];

    public function price() {
    	return $this->hasOne('App\Price');
    }
}
