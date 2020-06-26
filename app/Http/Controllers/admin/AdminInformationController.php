<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{User,Property,Project};

class AdminInformationController extends Controller
{
    // This function show all available hosts which are available in houskeeper
    public function view_hosts(){
        if(User::where(['type' => 'host'])->exists()){
            $hosts = User::where(['type' => 'host'])->get();
            foreach($hosts as $key=>$val){
                $hosts[$key]->properties_count = Property::where(['user_id'=> $val->id])->count();
                $hosts[$key]->projects_count = Project::where(['user_id'=> $val->id])->count();
            }
            return view('superadmin.host.view',compact('hosts'));
        }else{
            
        }
    }

    // This function show all available cleaner which are available in our app
    public function view_cleaners(){
        if(User::where(['type' => 'cleaner'])->exists()){
            $cleaners = User::where(['type' => 'cleaner'])->get();
            foreach($cleaners as $key=>$val){
                $cleaners[$key]->status = ( User::where(['id'=> $val->id , 'status' => 1])->exists() ) ? 'approve' : 'not approve';
            }
            return view('superadmin.cleaner.view',compact('cleaners'));
        }
    }

    // This function show all available Properties which are available in our App
    public function view_properties(){
        if(Property::exists()){
            $properties = Property::all();
            foreach($properties as $key=>$property) {
                $properties[$key]->owner = User::where(['id' => $property->user_id])->first()->name .' '. User::where(['id' => $property->user_id])->first()->last_name;
                $properties[$key]->owner_email = User::where(['id' => $property->user_id])->first()->email;
            }
            return view('superadmin.property.view',compact('properties'));
        }
    }
}
