<?php

namespace App\Http\Controllers\cleaner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\{CleanerInformation, References};
use Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;


class cleanerInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $names =User::where('id',Auth::user()->id)->select('name','last_name')->first();
        return view('cleaner.information.general',compact('names'));
    }

    public function identity(){
        return view('cleaner.information.identity');
    }

    public function identity_create(Request $request){    
        $validator = Validator::make($request->all(), [
            'identity_front' => 'required',
            'identity_back' => 'required',            
        ]);
        // If validation failed        
        if ($validator->fails()) {
            return redirect('/cleaner/identity')->withErrors($validator)->withInput();
        }
        if( CleanerInformation::where(['user_id'=>Auth::user()->id])->exists() ){
            $data = CleanerInformation::where(['user_id'=>Auth::user()->id])->first();
            $data->identity_front = $request->identity_front;
            $data->identity_back = $request->identity_back;
            $data->save();
            return redirect('cleaner/reference')->withSuccess('Information Saved Successfully!');
        }
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
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',            
            'date_of_birth' => 'required',
            'describes' => 'required',
            'experience' => 'required',
            'car_access' => 'required',
            'felony' => 'required',
            'travel' => 'required',
            'vacation_rentals' => 'required',
        ]);
        // If validation failed        
        if ($validator->fails()) {
            return redirect('/cleaner/information')->withErrors($validator)->withInput();
        }
        // dd($request->date_of_birth);
        if( !CleanerInformation::where(['user_id'=>Auth::user()->id])->exists() ){
            $data = new CleanerInformation;
            $data->user_id = Auth::user()->id;
            $data->first_name = $request->first_name;
            $data->last_name = $request->last_name;
            $date=date_create($request->date_of_birth);
            $data->date_of_birth = date_format($date,"Y/m/d");
            $data->website = $request->website;
            $data->describes = $request->describes;
            $data->experience = $request->experience;
            $data->car_access = $request->car_access;
            $data->felony = $request->felony;
            $data->travel = $request->travel;
            $data->vacation_rentals = $request->vacation_rentals;
            $data->save();
            return redirect('cleaner/address')->withSuccess('Information Saved Successfully!');
        }else{
            return redirect('cleaner/information')->with('info','Something went Wrong!');
        }

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

    // Public function
    public function address(){
        $address = CleanerInformation::where(['user_id' => Auth::user()->id])->first();
        return view('cleaner.information.address',compact('address'));
    }

    // Public funtion 

    public function address_create(Request $request){
        $validator = Validator::make($request->all(), [
            'address' => 'required|string|min:8',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'pincode' => 'required',
        ]);
        // If validation failed 
        if ($validator->fails()) {
            return redirect('/cleaner/address')->withErrors($validator)->withInput();
        }
        if(CleanerInformation::where(['user_id' => Auth::user()->id])->exists()){
            $data = CleanerInformation::where(['user_id' => Auth::user()->id])->first();
            $data->address = $request->address;
            $data->city = $request->city;
            $data->state = $request->state;
            $data->country = $request->country;
            $data->pincode = $request->pincode;
            $data->save();
            return redirect('cleaner/profile_photo')->withSuccess('Address Saved Successfully!');
        }
    }
    // Open cleaner profile page step three
    public function profile_photo(){
        return view('cleaner.information.profile_photo');
    }
    // Save image name
    public function profile_photo_create(Request $request){
        $validator = Validator::make($request->all(), [
            'image' => 'required',            
        ]);
        // If validation failed 
        if ($validator->fails()) {
            return redirect('/cleaner/profile_photo')->withErrors($validator)->withInput();
        }

        if(User::where(['id' => Auth::user()->id])->exists()){
            $data = User::where(['id' => Auth::user()->id])->first();
            $data->image = $request->image;           
            $data->save();
            return redirect('cleaner/identity')->withSuccess('Address Saved Successfully!');
        }


    }
    // Custom function for Clener References this function only open the cleaner reference page
    public function reference()
    {
        // Check reference exist or not
        $hasReference = References::where(['user_id' =>Auth::user()->id])->exists();
        return view('cleaner.reference.references',compact('hasReference'));
    }

    // This function accept post request and may be insert multiple data accordind to data
    public function reference_create(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'phone' => 'required|integer|min:6',
        ]);
        // If validation failed 
        if ($validator->fails()) {
            return redirect('/cleaner/reference')->withErrors($validator)->withInput();
        }
        $data = new References;
        $data->user_id = Auth::user()->id;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->name1 = $request->name1;
        $data->email1 = $request->email1;
        $data->phone1 = $request->phone1;
        $data->save();
        return redirect('cleaner/dashboard')->withSuccess('Information Saved Successfully!');        
    }
    public function reference_create_not_working(Request $request)
    {
        // dd($request->all());
        // $name = $request->name;
        // $email = $request->email;
        // $phone = $request->phone;        
        // $data = array();
        // foreach($name as $key=>$d){
        //     array_push($data["name"], $name[$key]);
        //     array_push($data["email"], $email[$key]);
        //     array_push($data["phone"], $phone[$key]);
        // }
        // dd($data);
        $validator = Validator::make($request->all(), [
            'name' => 'required|array|min:1',
            'name.*'  => 'required|string|distinct|min:1',
            'email' => 'required|array',
            "email.*"  => "required|distinct|min:1",
            'phone' => 'required|array',
            'phone.*' => 'required|distinct|min:1',
        ]);
        // If validation failed        
        if ($validator->fails()) {
            return redirect('/cleaner/reference')->withErrors($validator)->withInput();
        }
        dd($validator);
        return redirect('/cleaner/reference')->withSuccess('Successfully');
    }

}
