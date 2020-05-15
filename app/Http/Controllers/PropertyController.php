<?php

namespace App\Http\Controllers;

use App\{Property,User,CheckList,CleanerJob};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $user = Auth::user();
        $properties =Property::all();
        return view('admin.property.view',compact('user','properties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $checklists = CheckList::all();
        $cleaners = User::where('type','cleaner')->get();
        $propertyTypes = Property::propertyType();
        return view('admin.property.add',compact('user','checklists','propertyTypes' , 'cleaners'));
    }

    public function update_checklist(Request $request){
        /* Get last checklist id*/
        $data = Property::find($request->post_id);        
        $data->checklist_id = $request->checklist_id;
        $data->save();
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
            'property_name' => 'required',
            'property_address' => 'required',

        ]);

        if ($validator->passes()) {
            $data = new Property;
            $data->user_id = $request->input('user_id');
            $data->property_name = $request->input('property_name');
            $data->property_address = $request->input('property_address');
            $data->unit = $request->input('unit');
            $data->access_code = $request->input('access_code');
            $data->city = $request->input('city');
            $data->state = $request->input('state');
            $data->country = $request->input('country');
            $data->zipcode = $request->input('zipcode');
            $data->currency = $request->input('currency');
            $data->property_color = $request->input('colorpicker_full');
            $data->bathrooms = $request->input('bathrooms');
            $data->bedrooms = $request->input('bedrooms');
            $data->unit_of_measurement = $request->input('unit_of_measurement');
            $data->size = $request->input('size');
            $data->property_description = $request->input('property_description');
            $data->property_image = $request->input('property_image');
            $data->checklist_id = json_encode($request->input('checklist_id'));
            $data->check_in = $request->input('check_in');
            $data->check_out = $request->input('check_out');
            $data->save();

            // $inserted_property_id = response()->json(array('success' => true, 'last_insert_id' => $data->id), 200);
            $cleaners_id = $request->cleaner_ids ? $request->cleaner_ids : null;
            if(!is_null($cleaners_id)){
                $data = [];
                foreach($cleaners_id as $key=>$cleaner){
                    CleanerJob::insert(['property_id' =>  DB::getPdo()->lastInsertId() , 'user_id' => $cleaner]);
                }
            }
        }else{
            return response()->json(['error'=>$validator->errors()->all()]);
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        $user = Auth::user();
        $checklists = CheckList::all();
        return view('admin.property.edit',compact('user','property','checklists'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        $data = Property::find($property->id);
        $data->delete();    
    }

    public function update_property(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'property_name' => 'required',
            'property_address' => 'required',
            
        ]);

        if ($validator->passes()) {
            $data = Property::find($request->input('post_id'));
            $data->user_id = $request->input('user_id');
            $data->property_name = $request->input('property_name');
            $data->property_address = $request->input('property_address');
            $data->unit = $request->input('unit');
            $data->access_code = $request->input('access_code');
            $data->city = $request->input('city');
            $data->state = $request->input('state');
            $data->country = $request->input('country');
            $data->zipcode = $request->input('zipcode');
            $data->currency = $request->input('currency');
            $data->property_color = $request->input('colorpicker_full');
            $data->bathrooms = $request->input('bathrooms');
            $data->bedrooms = $request->input('bedrooms');
            $data->unit_of_measurement = $request->input('unit_of_measurement');
            $data->size = $request->input('size');
            $data->property_description = $request->input('property_description');
            $data->property_image = $request->input('property_image');
            $data->checklist_id = $request->input('checklist_id');
            $data->check_in = $request->input('check_in');
            $data->check_out = $request->input('check_out');
            $data->save();
        }else{
            return response()->json(['error'=>$validator->errors()->all()]);
        }


    }


}
