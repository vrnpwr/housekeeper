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
use App\Notifications\InviteCleaner;
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
        $invites = Invite::where('user_id',Auth::user()->id)->get(); 
        foreach($invites as $key=>$value){
            $ids = json_decode($value->property_ids);
            $invites[$key]->property_id = $ids;
        }
        $properties = Property::all();
        return view('admin.team.invites.view' , compact('invites','properties'));
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
        $data = $request->all();
        // ServerSide Email Validation        
        $email = $data['details'];
        $user_id = Auth::user()->id;
        $result = Invite::where(['user_id' => $user_id , 'details'=> $email])->exists();
        if(!$result){
        $validator = Validator::make($data, $this->validationRules($request), $this->messages());
        if ($validator->fails()) {
            return redirect('invite/create')
                        ->withErrors($validator)
                        ->withInput();
        }
        // Send email to cleaner
        if($request->invitation_type == "email"){          
            // *\Mail::to($request->details)->send(new \App\Mail\Invites($details));
            // This function will help you to fetch all deatls about selected properties
            $details['property_details'] = $this->getPropertyDetails($request);
            // dd($details['property_details']);
            $details['app_name'] = config('app.name');
            $details['cleaner_name'] = $request->cleaner_name;
            $details['invitation_message'] = $request->invitation_message;
            $details['host_name'] = Auth::user()->name;
            // dd($request);
            // return (new InviteCleaner($details))
            //     ->toMail($request->details);
            Notification::route('mail', $request->details)->notify(new InviteCleaner($details));
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
    }else{
        // Email Already Exists        
        return redirect('invite')->with('info','You alredy Connect to this Email Address!');
    }     
    }

    // *this function recieved propert_ids array and return property object
    public function getPropertyDetails($request){
        // Property_ids have array so we use arrayin        
        $data = Property::whereIn('id',$request)
        ->select('property_name','property_address','city','state','country','zipcode')->get();        
        return $data;
    }

    // Unserialize function

    private function messages()
    {
        $messages = [
            'details.required' => 'Email Id is required.',
            'details.unique' => 'You Already Connected to this email Address.',     
        ];

        return $messages;
    }   


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
        $property_ids = json_decode($invite->property_ids);
        $property_details  = $this->getPropertyDetails($property_ids);
        return view('admin.team.invites.edit' , compact('invite','properties','property_details') );
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
        $validator = Validator::make($request->all(), [
            'property_ids' => 'required',
            'invitation_type' => 'required',
            'cleaner_name' => 'required',
            'details' => 'required',
            'invitation_message' => 'required|max:255',
        ]);
        // If validation failed        
        if ($validator->fails()) {
            return redirect('invite/create')->withErrors($validator)->withInput();
        }
    }
    // Resent Notifications

    public function resent($id){
        $request = Invite::where(['id' => $id])->first();
        $type = $request->invitation_type;
        if($type == "email"){
        $details['property_details'] = $this->getPropertyDetails($request);
        $details['app_name'] = config('app.name');
        $details['cleaner_name'] = $request->cleaner_name;
        $details['invitation_message'] = $request->invitation_message;
        $details['host_name'] = Auth::user()->name;        
        Notification::route('mail', $request->details)->notify(new InviteCleaner($details));
        // return redirect('invite')->withSuccess('Invite  Resent Successfully!');
        return true;
        }else{
        // Phone Invitation Sent here
        }
        
    }

    //Contains the form validation rules.
    private function validationRules(Request $request)
    {
        $user_id = Auth::user()->id;
        $validationRules = [
            'property_ids' => 'required',
            'invitation_type' => 'required',
            'cleaner_name' => 'required',
            // 'client_id' => 'unique:Client table,client_id,'.$id
            // 'jercy_number' => 'required|numeric|max:255|unique:players,jercy_number,' . $id . ',id,team_id,' . $team_id,
            'details' => 'required|email',
            'invitation_message' => 'required|max:255',
        ];
        // dd($validationRules);
        return $validationRules;
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
