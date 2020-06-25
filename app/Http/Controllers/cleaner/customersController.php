<?php

namespace App\Http\Controllers\cleaner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\{User , Invite , Property};
use Auth;


class customersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Invite::where(['invitation_type' => 'email' , 'details'=>Auth::user()->email , 'status'=>1])->exists()){
            $invitations_details = $this->invitations();                     
        $propertydetails = $invitations_details['property_details'];
        $clients_information = [];
        $clients = Invite::where(['invitation_type' => 'email' , 'details'=>Auth::user()->email , 'status'=>1])->get();

        foreach($clients as $key=>$item){
            $clients[$key]->name = user::where(['id' => $item->user_id])->first()->name.' '.$clients[$key]->name = user::where(['id' => $item->user_id])->first()->last_name;
            $clients[$key]->email = user::where(['id' => $item->user_id])->first()->email;
        }
        $invites = Invite::where(['invitation_type' => 'email' , 'details'=>Auth::user()->email , 'status'=>1])->get();
        return view('cleaner.customers.customers',compact('propertydetails','clients','invites'));
        }
    }

    

    // this function accept get request and return new invitation request
    private function invitations(){
        if(Invite::where(['invitation_type' => 'email' , 'details'=>Auth::user()->email , 'status'=>1])->exists()){
            $invitations = Invite::where(['invitation_type' => 'email' , 'details'=>Auth::user()->email,'status'=>1 , 'action'=>0])->get();
            $property_details = [];
            $invitation_id =[];
            foreach($invitations as $key=>$invitation){
                $invitation_id[$key] = $invitation->id;
                $data = json_decode($invitation->property_ids);
                foreach($data as $key=>$value){
                    $property_detail = $this->getPropertyDetails($value);
                    array_push($property_details, $property_detail);                    
                }                
            }            
            $from = [];
            foreach($invitations as $key=>$invite){
                $each = User::find($invite->user_id)->select('email','name')->first();
                array_push($from , $each);
            }
            $data = ['invitations_from' => $from , 'property_details' => $property_details , 'invitation_id' =>$invitation_id];
            return $data;
        }
    }
    // *this function recieved propert_ids array and return property object
    public function getPropertyDetails($request){
        $data = Property::where('id',$request)
        ->select('property_name','property_address','city','state','country','zipcode','property_image','property_image2','property_image3','property_image4','property_image5')->first();        
        return $data;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
