<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Governorate extends Model 
{

    protected $table = 'governorates';
    public $timestamps = true;
    protected $fillable = array('name');

    public function clients()
    {
        return $this->belongsToMany('App\Models\Client')->withTimestamps();
    }

    public function city()
    {
        return $this->hasMany('App\Models\City');
    }

}