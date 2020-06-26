<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{User,References,cleanerInformation};
class CleanerDetailController extends Controller
{
    // This Function get the cleaner details like(References , Identity proofs etc)
public function cleaner_details($id){
    $references = References::where(['user_id' => $id])->first();    
    $identityFront = cleanerInformation::where(['user_id' => $id])->select('identity_front')->first()->identity_front;
    $identityBack = cleanerInformation::where(['user_id' => $id])->select('identity_back')->first()->identity_back;
    $cleanerName = User::where(['id' => $id])->first()->name;
    $status = ( User::where(['id'=>$id])->first()->status == 1 ) ? 'approve' : 'disapprove';   
    return view('superadmin.cleaner.information',compact('references','identityFront','identityBack','cleanerName','id','status'));
}
}
