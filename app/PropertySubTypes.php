<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertySubTypes extends Model
{
    public function property_type()
    {
        return hasOne('App\PropertyType');
    }
    
}
