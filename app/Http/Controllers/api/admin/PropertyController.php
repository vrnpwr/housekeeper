<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FilePondController;
use Illuminate\Http\Request;
use App\{User, Property , PropertyType , PropertySubTypes};
use DB;
use Validator;
use Auth;
use Config;

use Illuminate\Support\Facades\Storage;
class PropertyController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    
    // Fetch all Properties_types
    public function property_types()
    {
        return response()->json(['data' => PropertyType::all() , 'status' => true]);
    }
    
    // Fetch poserty sub typer by property type ID
    public function property_sub_types(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required', 
            ]);
            if ($validator->fails()) { 
                return response()->json([
                    'error'=>$validator->errors()->first(),
                    'status'=>false
            ], 401);
            }
            if(PropertySubTypes::where('property_type_id' , $request->id)->exists()){
                return response()->json(['data' => PropertySubTypes::where('property_type_id' , $request->id)->get() , 'status' => true]);
            }
    }

        public function index()
        {            
            if(Property::where('user_id' , Auth::user()->id )->exists() ){
                $properties = Property::where('user_id' , Auth::user()->id )->get();
                foreach($properties as $key=>$property){
                    $properties[$key]->property_image = json_decode($property->property_image);
                    $properties[$key]->property_sub_types = json_decode($property->property_sub_types);
                }
                return response()->json([
                    'data' => $properties , 
                    'status' =>true , 
                    'count' => Property::where('user_id' , Auth::user()->id )->count() ,
                    'image_url' => Config::get('app.url').'images/' 
                    ]);
            }else{
                return response()->json(['message' => 'Properties not found' ,  'status' => false]);
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
        $validator = Validator::make($request->all(), $this->validationRules($request));
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first() , 'status' => false ]);
        }        
        $data = new Property;
        $data->property_type = $request->property_type; //Id
        $data->property_sub_types = $request->property_sub_types; //array
        $data->user_id = Auth::user()->id;
        $data->property_name = $request->property_name;
        $data->property_address = $request->property_address;
        $data->city = $request->city;
        $data->state = $request->state;
        $data->country = $request->country;
        $data->zipcode = $request->zipcode;
        $data->property_description = $request->property_description;
        if(!empty($request->base64) ){
            $imageNames = $this->imageUpload($request);
        }
        // return response()->json($imageNames);
        $data->property_image = json_encode($imageNames);
        
        $data->save();
        return response()->json(['message' => 'Property added successfully' , 'status' => true]);
    }
    
    // image Uploading
    
    private function imageUpload(Request $request){    
		
        if(!empty($request->base64)) {
            $images = $request->base64;
            // return response()->json(gettype($images));
            $fileNames = [];
            $images = json_decode($images);
            foreach($images as $key=>$image){
                $image = str_replace('data:image/png;base64,', '', $image->uri);
                $image = str_replace(' ', '+', $image);
                $fileName = str_random(5) . '.png';
                array_push($fileNames , $fileName);
                Storage::disk('public_driver')->put($fileName, base64_decode($image));
            }
            return $fileNames;

        }else{
            return false;
            // return response()->json(['file' => null,'status'=> false]);        
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
        
        // if(Property::find($id)->exists()){
        //     return response()->json(['data' => Property::find($id)->first() , 'status' =>true ]);
        // }
        // else{
        //     return response()->json(['message' => 'no data found' , 'status' =>false ]);
        // }
    }
    
    
     public function view_properties(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors()->first() , 'status' => false ]);
            } 
        $id = $request->id;   
        if(Property::where(['user_id' => Auth::user()->id , 'id' => $id])->exists() ){
            $properties = Property::where( ['user_id' => Auth::user()->id , 'id' => $id] )->get();
            foreach($properties as $key=>$property){
                $properties[$key]->property_image = json_decode($property->property_image);
                $properties[$key]->property_sub_types = json_decode($property->property_sub_types);
                $properties[$key]->property_type_name = ($property->property_type->type) ? $property->property_type->type : null;
            }
            return response()->json(['data' => $properties , 'id' => $id, 'status' =>true ]);
        }
        else{
            return response()->json(['message' => 'no data found' , 'status' =>false ]);
        }
    }
    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        if(Property::find($id)->exists()){
            return response()->json(['data' => Property::find($id)->first() , 'status' =>true ]);
        }
        else{
            return response()->json(['message' => 'no data found' , 'status' =>false ]);
        }
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
        // $validator = Validator::make($request->all(), $this->validationRules($request));
        // if ($validator->fails()) {
        //     return response()->json(['message' => $validator->errors()->first() , 'status' => false ]);
        // } 
        // else {
        //     $id = ($id) ? $id : null;
        //     if($id){
        //         $data = Property::findOrFail($id);
        //         $data->property_type = $request->property_type; //Id
        //         $data->property_sub_types = $request->property_sub_types; //array
        //         $data->property_name = $request->property_name;
        //         $data->property_address = $request->property_address;
        //         $data->city = $request->city;
        //         $data->state = $request->state;
        //         $data->country = $request->country;
        //         $data->zipcode = $request->zipcode;
        //         $data->property_description = $request->property_description;
        //         $data->save();
        //         return response()->json(['message' => 'Property updated successfully' , 'status' => true]);
        //     }
            
        // }
    }

    public function update_property(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validationRules($request));
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first() , 'status' => false ]);
        } 
        $id = ($request->id) ? $id : null;
        if($id){
            $data = Property::findOrFail($id);
            $data->property_type = $request->property_type; //Id
            $data->property_sub_types = $request->property_sub_types; //array
            $data->property_name = $request->property_name;
            $data->property_address = $request->property_address;
            $data->city = $request->city;
            $data->state = $request->state;
            $data->country = $request->country;
            $data->zipcode = $request->zipcode;
            $data->property_description = $request->property_description;
            $data->save();
            return response()->json(['message' => 'Property updated successfully' , 'status' => true]);
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
        // $data = Property::find($id);
        // $data->delete();
    }
    
    // Delete Properties 
    public function delete_property(Request $request)
    {
        $data = Property::findOrFail($request->id);
        $data->delete();
        if($data->id){
            return response()->json(['status' => true , 'message' => 'property deleted successfully']);
        }else
        {
            return response()->json(['status' , false , 'message' => 'property not deleted']);
        }
    }
    
    //Contains the form validation rules.
    private function validationRules(Request $request)
    {
        $id = $request->id;
        $validationRules = [
            'property_name' => 'required|unique:properties,property_name' .$id,
            'property_type' => 'required',
            'property_address' => 'required', 
            'city' => 'required|min:2|max:20', 
            'state' => 'required|min:2|max:20', 
            'country' => 'required|min:2|max:20', 
            'zipcode' => 'required|min:4|max:12',
            'property_type' => 'required',
            'property_sub_types' => 'required',
            'base64' => 'required'
        ];   
        
        return $validationRules;
    }
}
