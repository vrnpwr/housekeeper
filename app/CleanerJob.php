<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CleanerJob extends Model
{

    protected $fillable = array(
        'property_id',
        'user_id',   
        'created_at'     
        );

    public function property()
    {
        $this->belongsTo('App\Property','property_id','id');
    }
}
