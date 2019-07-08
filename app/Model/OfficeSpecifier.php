<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OfficeSpecifier extends Model
{
    public $timestamps = false;
    protected $fillable = ['office_id','specifier_id','status'];
}
