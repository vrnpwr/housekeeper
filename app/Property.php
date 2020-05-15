<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    public static function propertyType(){
        $types = ['Home', 'Office', 'Flat'];
        return $types;
    }

    public function cleanerjobs()
    {
        return $this->hasMany('App\CleanerJob');
    }
}
