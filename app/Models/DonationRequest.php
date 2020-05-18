<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonationRequest extends Model 
{

    protected $table = 'donation_requests';
    public $timestamps = true;
    protected $fillable = array('patient_name', 'patient_phone', 'city_id', 'hospital_name', 'blood_type_id', 'patient_age', 'bags_number', 'hospital_address', 'details', 'longitude', 'latitude', 'client_id');

    public function city()
    {
        return $this->belongsTo('App\Models\City','city_id');
    }

    public function bloodType()
    {
        return $this->belongsTo('App\Models\BloodType','blood_type_id');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client','client_id');
    }

    public function notification()
    {
        return $this->hasOne('App\Models\Notification','donation_request_id');
    }

}