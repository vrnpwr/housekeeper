<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{

    protected $fillable = [
        'property_ids',
        'invitation_type',
        'cleaner_name',
        'cleaner_email',
        'invitation_message',
        'invitation_code'       
    ];

    public function property(){
        return hasOne('App\Property','propert_ids','id');
    }
}
