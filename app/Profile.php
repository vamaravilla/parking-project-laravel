<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Profile extends Model //Swap Model to use mongodb 
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'paymentrequired', 'paymentperiod', 'amoutperunit'
    ];
}
