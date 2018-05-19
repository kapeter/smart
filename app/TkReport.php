<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class TkReport extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];   
}
