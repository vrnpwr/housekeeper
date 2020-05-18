<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    
    public function property_sub_types(){
        return hasMany('App\PropertySubTypes');
    }
}
