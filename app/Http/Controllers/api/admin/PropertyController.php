<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FilePondController;
use Illuminate\Http\Request;
use App\{User, Property};
use DB;
use Validator;
use Auth;

class PropertyController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {       
        return response()->json(['data' => Property::where('user_id' , Auth::user()->id )->get() , 'status' =>true ]);
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
        $validator = Validator::make($request->all(), $this->validationRules($request));
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first() , 'status' => false ]);
        } 
        
        $data = new Property;
        $data->user_id = $request->user_id;
        $data->property_name = $request->property_name;
        $data->property_address = $request->property_address;
        $data->city = $request->city;
        $data->state = $request->state;
        $data->country = $request->country;
        $data->zipcode = $request->zipcode;
        $data->bathrooms = $request->bathrooms;
        $data->bedrooms = $request->bedrooms;
        $data->size = $request->size;
        $data->property_description = $request->property_description;
        $data->save();
        return response()->json(['message' => 'Property added successfully' , 'status' => true]);
    }
    
    // image Uploading
    
    public function imageUpload(Request $request){

        
        $filepond = new FilePondController();
        $data = $filepond->uploadImage($request);
        return response()->json($data);
        
    }
    
    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        return response()->json(['data' => Property::find($id)->first() , 'status' =>true ]);
    }
    
    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        return response()->json(['data' => Property::find($id)->first() , 'status' =>true ]);
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
        $validator = Validator::make($request->all(), $this->validationRules($request));
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first() , 'status' => false ]);
        } 
        else {
            $id = ($id) ? $id : null;
            if($id){
                $data = Property::findOrFail($id);
                $data->property_name = $request->property_name;
                $data->property_address = $request->property_address;
                $data->city = $request->city;
                $data->state = $request->state;
                $data->country = $request->country;
                $data->zipcode = $request->zipcode;
                $data->bathrooms = $request->bathrooms;
                $data->bedrooms = $request->bedrooms;
                $data->size = $request->size;
                $data->property_description = $request->property_description;
                $data->save();
                return response()->json(['message' => 'Property updated successfully' , 'status' => true]);
            }
            
        }
    }
    
    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    
    public function destroy($id)
    {
        $data = Property::find($id);
        $data->delete();
    }
    
    //Contains the form validation rules.
    private function validationRules(Request $request)
    {
        $id = $request->id;
        $validationRules = [
            'property_name' => 'required|unique:properties,property_name' .$id,
            'city' => 'required|min:2|max:20', 
            'state' => 'required|min:2|max:20', 
            'country' => 'required|min:2|max:20', 
            'zipcode' => 'required|min:4|max:12'
        ];   
        
        return $validationRules;
    }
}
