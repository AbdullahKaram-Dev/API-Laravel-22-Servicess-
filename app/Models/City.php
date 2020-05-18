<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model 
{

    protected $table = 'cities';
    public $timestamps = true;
    protected $fillable = array('governorate_id', 'name');

    public function governorate()
    {
        return $this->belongsTo('App\Models\Governorate','governorate_id');
    }

    public function donation(){

        return $this->hasMany('App\Models\DonationRequest','city_id');
    }

}