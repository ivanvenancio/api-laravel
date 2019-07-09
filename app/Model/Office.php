<?php

namespace App\Model;

use App\Model\Specifier;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    protected $fillable = ['cnpj','fantasy_name','social_name','zip_code'];

    public function specifier(){
        return $this->belongsToMany(Specifier::class, 'office_specifiers')->withPivot('status');
    }
}
