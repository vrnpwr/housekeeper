<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Invite , User, Property, Quote};
use Auth;
class HostJobController extends Controller
{
    public function jobs(){
        $invites = Invite::where(['user_id' => Auth::user()->id ])->get();
        $property_details = Property::where(['user_id' => Auth::user()->id , 'id' => json_decode($invites[0]->property_ids)[0]])->exists();
        // Check If property not exists
        if($property_details){
        foreach($invites as $key=>$invite){
            // invitation Status            
            if($invite->status == 1){
                $invites[$key]->invite_status = true;
                $invites[$key]->invite_accepted_by = $invite->email;
            }else{
                $invites[$key]->invite_status = false;
            }
            $property_details = Property::where(['id' => json_decode($invite->property_ids)[0]])->exists();
            // Property            
                $invites[$key]->property_name = $property_details->property_name;
                $invites[$key]->property_image = json_decode($property_details->property_image);
                $invites[$key]->check_in = $property_details->check_in;
                $invites[$key]->check_out = $property_details->check_out;
                $invites[$key]->city = $property_details->city;
                $invites[$key]->state = $property_details->state;
                $invites[$key]->country = $property_details->country;
                $invites[$key]->zipcode = $property_details->zipcode;
                // Quotes
                $quotes_details = Quote::where(['property_id' => json_decode($invite->property_ids)[0]])->exists();
                if($quotes_details){
                    $quotes_details = Quote::where(['property_id' => json_decode($invite->property_ids)[0]])->get();
                    $invites[$key]->quote_status = true;
                    $invites[$key]->quotes_array = $quotes_details;
                    $cleaner_info = array();                
                    foreach( $quotes_details as $key2 => $cleaner){                    
                        $cleaner_info[$key2]['name'] = $cleaner->cleaner->name .' '.$cleaner->cleaner->last_name;                    
                    }
                    $invites[$key]->cleaner_information = $cleaner_info;                
                }else{
                    $invites[$key]->quote_status = false;
                }
            }
        }else{
            $invites = null;
        }
              
        // Sending invitation_status and quote_status in invites variable
        return view('admin.project.view',compact('invites'));
    }
}
