<?php

namespace App\Http\Controllers\cleaner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{CleanerInformation,User,Invite,Property};
use Auth;
class CleanerJobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();        
        $title = 'Cleaner Dashboard';
        $formOne = CleanerInformation::where(['user_id' => Auth::user()->id])->exists();
        $cleanerInformation = CleanerInformation::where(['user_id' => Auth::user()->id])->first();
        $formThree = User::where(['id'=> Auth::user()->id])->first();      
        // Address
        if($cleanerInformation){
            $formTwo = is_null($cleanerInformation->address) ? false : true;
        }else{
            $formTwo = null;
        }
        // Image
        if($formThree){
            $formThree = is_null($formThree->image) ? false : true;
        }
        // Identity
        if($cleanerInformation){
            $formFour = is_null($cleanerInformation->identity_front) ? false : true;
        }else{
            $formFour = null;
        }
        // New invitation
        $invitations_details = $this->invitations();
        $property_information = array();        
        foreach($invitations_details['property_details'] as $key=>$item){            
            if(isset($item[$key])){                        
            $property_information[$key]['property_name'] = $item[$key]->property_name;
            $property_information[$key]['property_address'] = $item[$key]->property_address;
            $property_information[$key]['city'] = $item[$key]->city;
            $property_information[$key]['state'] = $item[$key]->state;
            $property_information[$key]['country'] = $item[$key]->country;   
            $property_information[$key]['property_image'] = $item[$key]->property_image;
            }
        }
        return view('cleaner.job.jobs',compact('user','title','formOne','formTwo','formThree','formFour','invitations_details'));
    }
    // this function accept get request and return new invitation request
    private function invitations(){
        if(Invite::where(['invitation_type' => 'email' , 'details'=>Auth::user()->email , 'status'=>0])->exists()){
            $invitations = Invite::where(['invitation_type' => 'email' , 'details'=>Auth::user()->email])->get();
            $property_details = [];
            foreach($invitations as $key=>$invitation){
                $property_detail = $this->getPropertyDetails($invitation->property_ids);
                array_push($property_details, $property_detail);
            }
            $from = [];
            foreach($invitations as $key=>$invite){
                $each = User::find($invite->user_id)->select('email','name')->first();
                array_push($from , $each);
            }
            $data = ['invitations_from' => $from , 'property_details' => $property_details];
            return $data;
        }
    }
    // *this function recieved propert_ids array and return property object
    public function getPropertyDetails($request){
        $request = json_decode($request);        
        $data = Property::whereIn('id',$request)
        ->select('property_name','property_address','city','state','country','zipcode')->get();        
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
