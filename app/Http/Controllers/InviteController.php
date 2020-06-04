<?php

namespace App\Http\Controllers;

use App\Invite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Property;
use Illuminate\Support\Facades\Validator;
// use UxWeb\SweetAlert\SweetAlert;
Use Alert;
use Redirect;
// *For Email
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewMessage;
// use App\Providers\SweetAlertServiceProvider;
class InviteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $invites = Invite::all();     
        foreach($invites as $key=>$value){
            $ids = json_decode($value->property_ids);
            $invites[$key]->property_id = $ids;
        }
        return view('admin.team.invites.view' , compact('invites'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if(Property::where(['user_id' => Auth::user()->id ])->exists())
        {
            $properties = Property::where(['user_id' => Auth::user()->id ])->get();
            return view('admin.team.invites.create' , compact('properties') );
        }
        else{  
            return redirect('/invite')->with('info', 'Sorry did not find any property please add property first!');            
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'property_ids' => 'required',
            'invitation_type' => 'required',
            'cleaner_name' => 'required',
            'details' => 'required',
            'invitation_message' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('invite/create')
                        ->withErrors($validator)
                        ->withInput();
        }
        // Send email to cleaner
        if($request->invitation_type == "email"){          
         $details = [
                'title' => 'This is invitation mail from Host',
                'body' => $request->invitation_message
            ];
            // \Mail::to($request->details)->send(new \App\Mail\Invites($details));
            // This function will help you to fetch all deatls about selected properties
            $details['property_details'] = $this->getPropertyDetails($request);
            $details['app_name'] = config('app.name');
            $details['cleaner_name'] = $request->cleaner_name;
            $details['invitation_message'] = $request->invitation_message;         
            Notification::route('mail', $request->email)->notify(new NewMessage($details));
        }
        // Store data to database if data valids
        $invite = new Invite;
        $invite->user_id = Auth::user()->id;
        $invite->property_ids = json_encode($request->property_ids);
        $invite->invitation_type = $request->invitation_type;
        $invite->cleaner_name = $request->cleaner_name;
        $invite->details = $request->details;
        $invite->invitation_message = $request->invitation_message;
        $invite->invitation_code = mt_rand(100000, 999999);
        $invite->save();
        return redirect('invite')->withSuccess('Invite Sent Successfully!');        
    }

    public function getPropertyDetails(Request $request){
        // Property_ids have array so we use arrayin
        $data = Property::whereIn('id',$request->property_ids)->select('property_name','property_address','city','state','country','zipcode')->get();        
        return $data;
    }

    // Unserialize function


    /**
     * Display the specified resource.
     *
     * @param  \App\Invite  $invite
     * @return \Illuminate\Http\Response
     */
    public function show(Invite $invite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invite  $invite
     * @return \Illuminate\Http\Response
     */
    public function edit(Invite $invite)
    {
        $properties = Property::all();
        return view('admin.team.invites.edit' , compact('invite','properties') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invite  $invite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invite $invite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invite  $invite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invite $invite)
    {
        $data = Invite::find($invite->id);
        $data->delete();
        return true;
    }
}
