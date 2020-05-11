<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServicesType extends Model
{
    public function services()
    {
        return $this->hasMany('App\Services');
    }
}
