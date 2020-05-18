<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloodType extends Model 
{

    protected $table = 'blood_types';
    public $timestamps = true;
    protected $fillable = array('name');

    public function clientss()
    {
        return $this->belongsToMany('App\Models\Client');
    }

    public function clients()
    {
        return $this->hasMany('App\Models\Client','client_id');
    }

    public function donation(){

        return $this->hasMany('App\Models\DonationRequest','blood_type_id');
    }
}