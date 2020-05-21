<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Parking extends Model //Swap Model to use mongodb 
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vehicle','profile', 'month', 'intime', 'outtime','time','amount'
    ];
}
