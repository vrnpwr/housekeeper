<?php

namespace App\Http\Controllers\api\cleaner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use DB;
use Validator;
class CleanerInformation extends Controller
{
    // General Information
    public function general(Request $request){
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
            return response()->json([
                'error'=>$validator->errors()->first(),
                'status'=>false
        ], 401);
        }
        if( !CleanerInformation::where(['user_id'=>Auth::user()->id])->exists() ){
            $data = new CleanerInformation;
            $data->user_id = Auth::user()->id;
            $data->first_name = $request->first_name;
            $data->last_name = $request->last_name;            
            $data->date_of_birth = $request->date_of_birth;
            $data->website = $request->website;
            $data->describes = $request->describes;
            $data->experience = $request->experience;
            $data->car_access = $request->car_access;
            $data->felony = $request->felony;
            $data->travel = $request->travel;
            $data->vacation_rentals = $request->vacation_rentals;
            $data->save();
            return response()->json(['data' => 'General Information saved successfully' , 'status' => true]);
        }else{
            return response()->json(['data' => 'General Information Already saved' , 'status' => true]);            
        }
    }
    // Address Information
    public function address(Request $request){
        $validator = Validator::make($request->all(), [
            'address' => 'required|string|min:8',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'pincode' => 'required',
        ]);
        // If validation failed 
        if ($validator->fails()) {
            return response()->json([
                'error'=>$validator->errors()->first(),
                'status'=>false
        ], 401);
        }
        if(CleanerInformation::where(['user_id' => Auth::user()->id])->exists()){
            $data = CleanerInformation::where(['user_id' => Auth::user()->id])->first();
            $data->address = $request->address;
            $data->city = $request->city;
            $data->state = $request->state;
            $data->country = $request->country;
            $data->pincode = $request->pincode;
            $data->save();
            return response()->json(['data' => 'Address Information saved successfully' , 'status' => true]);
        }else{
            return response()->json(['data' => 'Address Information alredy exist' , 'status' => true]);
        }
    }
    // profile Information
    public function profile_image(Request $request){
        $validator = Validator::make($request->all(), [
            'image' => 'required',            
        ]);
        // If validation failed 
        if ($validator->fails()) {
            return response()->json([
                'error'=>$validator->errors()->first(),
                'status'=>false
        ], 401);
        }

        if(User::where(['id' => Auth::user()->id])->exists()){
            $data = User::where(['id' => Auth::user()->id])->first();
            $data->image = $request->image;           
            $data->save();
            return response()->json(['data' => 'Profile photo saved successfully' , 'status' => true]);
        }
    }
    // Identity Information
    public function identy(Request $request){
        $validator = Validator::make($request->all(), [
            'identy_front' => 'required',
            'identy_back' => 'required',
        ]);
        // If validation failed        
        if ($validator->fails()) {            
            return response()->json([
                'error'=>$validator->errors()->first(),
                'status'=>false
        ], 401);
        }

        if( CleanerInformation::where(['user_id'=>Auth::user()->id])->exists() ){
            $data = CleanerInformation::where(['user_id'=>Auth::user()->id])->first();
            $data->identity_first = $request->image;
            $data->identity_back = $request->image;
            $data->save();
            return response()->json(['data' => 'Profile photo saved successfully' , 'status' => true]);
        }
    }
    // references
    public function references(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'phone' => 'required|integer|min:6',
        ]);
        // If validation failed 
        if ($validator->fails()) {
            return response()->json([
                'error'=>$validator->errors()->first(),
                'status'=>false
        ], 401);
        }
        $data = new References;
        $data->user_id = Auth::user()->id;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->save();
        return response()->json(['data' => 'References saved successfully' , 'status' => true]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
