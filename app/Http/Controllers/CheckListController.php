<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\CheckList;
use App\Property;
use Illuminate\Support\Facades\Validator;

class CheckListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $checklists = CheckList::all();
        return view('admin.checklist.view', compact('user', 'checklists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $properties = Property::all();
        return view('admin.checklist.add', compact('user', 'properties'));
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
            'title' => 'required',
        ]);

        if ($validator->passes()) {
            $data = new CheckList;
            $data->user_id = $request->input('user_id');
            $data->title = $request->input('title');
            $data->description = $request->input('description');
            $data->public = $request->is_public;
            $data->property_id = json_encode($request->property_id);
            $data->item_image = json_encode($request->input('item_image'));
            $data->item_title = json_encode($request->input('item_title'));
            $data->item_description = json_encode($request->input('item_description'));
            $data->save();
        } else {
            return response()->json(['error' => $validator->errors()->all()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CheckList  $checkList
     * @return \Illuminate\Http\Response
     */
    public function show(CheckList $checkList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CheckList  $checkList
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        /* Selected Properties*/
        $checklist = CheckList::find($id);
        $properties = Property::all();
        $selected_properties = [];
        $property_ids = json_decode($checklist->property_id);
        if (!empty($property_ids)) {
            foreach ($property_ids as $key => $property_id) {
                $property_id = (int) $property_id;
                $data = Property::find($property_id);
                if (!$data == null) {
                    array_push($selected_properties, $data);
                }
            }
        }
        // dd($selected_properties);
        return view('admin.checklist.edit', compact('selected_properties', 'user', 'checklist', 'properties'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CheckList  $checkList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CheckList $checkList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CheckList  $checkList
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = CheckList::find($id);
        $data->delete();
    }

    public function update_checklist(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required',

        ]);

        if ($validator->passes()) {
            $data = CheckList::find($request->input('post_id'));
            $data->user_id = $request->input('user_id');
            $data->title = $request->input('title');
            $data->description = $request->input('description');
            $data->property_id = json_encode($request->property_id);
            $data->item_image = json_encode($request->input('item_image'));
            $data->item_title = json_encode($request->input('item_title'));
            $data->item_description = json_encode($request->input('item_description'));
            $data->save();
        } else {
            return response()->json(['error' => $validator->errors()->all()]);
        }
    }
}
