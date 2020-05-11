<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    public function type(){
        return $this->hasOne('App\ServicesType','id','type_id');
    }
}
