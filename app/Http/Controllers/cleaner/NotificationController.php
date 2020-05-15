<?php

namespace App\Http\Controllers\cleaner;

use App\Http\Controllers\Controller;

use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Exception;


class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $notifications = DB::table('notifications')
        ->select('notification')->where('user_id',$user->id)->first();
        if ( !$notifications == null ) {
            $notifications = json_decode($notifications->notification);
        }

        /* Create a array for options */
        $options = array();

        $options[0]['title'] = "Notify me when guests leave early (enable in property check-in/check-out settings)";
        $options[0]['name'] = "guests";

        $options[1]['title'] = "Notify me when cleaners accept my invites";
        $options[1]['name'] = "invites";

        $options[2]['title'] = "Notify me when cleaners accept my projects";
        $options[2]['name'] = "cleaners";

        $options[3]['title'] = "Notify me when one of my projects is marked as complete by a cleaner";
        $options[3]['name'] = "projects";

        $options[4]['title'] = "Notify me when a cleaner asks to be removed from a project";
        $options[4]['name'] = "remove_project";

        $options[5]['title'] = "Notify me when one of my projects is started by a cleaner";
        $options[5]['name'] = "project_started";

        $options[6]['title'] = "Notify me when there is a new cleaner available in my area";
        $options[6]['name'] = "cleaner_available";

        $options[7]['title'] = "Notify me about events related to payments";
        $options[7]['name'] = "events";

        $options[8]['title'] = "Notify me about events related to marketplace bids and searches";
        $options[8]['name'] = "marketplace";

        $options[9]['title'] = "Notify me about pending cleaner reviews";
        $options[9]['name'] = "reviews";

        $options[10]['title'] = "Remind me when my projects still don\'t have a cleaner";
        $options[10]['name'] = "remind";

        /* Create a array for options */
        return view('cleaner.notification.notification',compact('user','options','notifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        foreach ($_POST['notification'] as $key => $value) {

            if(!isset($value['notification'])){
               $_POST['notification'][$key]['notification'] = 0;
           }

           if(!isset($value['email'])){
             $_POST['notification'][$key]['email'] = 0;
         }
         if(!isset($value['mobile'])){
           $_POST['notification'][$key]['mobile'] = 0;
       }

       if(!isset($value['sms'])){
         $_POST['notification'][$key]['sms'] = 0;
     }

 }



 $user_id =Auth::user()->id;
 $check = DB::table('notifications')->where('user_id',$user_id)->get();
 if (!count($check) == 0 ) { 
    $post_id = DB::table('notifications')->where('user_id',$user_id)->first();    
    $post_id = $post_id->id;
    $data = Notification::findOrFail($post_id);
    $data->notification = json_encode($_POST['notification']);

    $data->save();
}else{
    /* Insert Update Settings if There is no setting for user */
    $data = new Notification;
    $data->user_id = $user_id;
    $data->notification = json_encode($_POST['notification']);

    $data->save();
}
        //
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notification $notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $notification)
    {
        //
    }
}
