<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    public function property(){
        return hasOne('App\Property','propert_ids','id');
    }
}
