<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $fillable = [
        'date',
        'occasion',
        'branch_name',
        'created_by',
        'status',
    ];
}
