<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model 
{

    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('notification_settings_text', 'about_app', 'phone', 'email', 'facebook_link', 'twitter_link', 'instagram_link');

}