<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Branch extends Model
{
    protected $fillable = [
        'name','country_name','state_name','district_name','zip_code','address','city_name','created_by'
    ];


}
