<?php

namespace App\Model;

use App\Model\Office;
use Illuminate\Database\Eloquent\Model;

class Specifier extends Model
{
    protected $fillable = ['cpf','name','last_name','profession','date-birth','phone','zip_code','state','city'];

    public function office(){
        return $this->belongsToMany(Office::class, 'office_specifiers')->withPivot('status');
    }
}
