<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Client extends Authenticatable
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('phone','email','password','name','date_of_birth','blood_type','last_doniation_date','city_id','pin_code');

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function bloodtypes()
    {
        return $this->belongsToMany('App\Models\BloodType','blood_type_client','client_id')->withTimestamps();
    }

    public function posts()
    {
        return $this->belongsToMany('App\Models\Post');
    }

    public function notifications()
    {
        return $this->belongsToMany('App\Models\Notification');
    }

    public function governorates()
    {
        return $this->belongsToMany('App\Models\Governorate','client_governorate','client_id')->withTimestamps();
    }

    public function donations()
    {
        return $this->hasMany('App\Models\DonationRequest','client_id');
    }

    public function tokens(){

        return $this->hasMany('App\Models\Token','client_id');
    }

    protected $hidden = [
        'password', 'api_token',
    ];

}