<?php

namespace App\Http\Controllers;

use App\Project;
use App\Property;
use App\CheckList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Illuminate\Support\Arr;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        $user = Auth::user();
        $pending_projects = Project::where('status',0)->get();
        $pendings = [];
        foreach ($pending_projects as $key => $pending) {
            $data =  DB::table('projects')
            ->select('projects.dates_timmings','properties.property_name','projects.id','projects.publish_project')
            ->join('properties','properties.id','=','projects.property_id')
            ->where('properties.id',$pending->property_id)
            ->get();
            array_push($pendings, $data);
        }

        $pending = Arr::where($pendings, function ($value, $key) {
            return !empty($value[0]);
        });
        $pendings = $pending;
            // $pendings = array_filter($value);
        return view('admin.project.view',compact('user','pendings','projects'));
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
       $checklists = CheckList::all();
       return view('admin.project.add',compact('user','properties','checklists'));
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
            'property_id' => 'required',
            'cleaning_price' => 'required',
            'rate' => 'required',            
        ]);

        if ($validator->passes()) {
            $data = new Project;
            $data->user_id = $request->input('user_id');
            $property = explode('-', $request->property_id);
            $data->property_id = $property[0];
            $data->property_name =$property[1];

            /* ########## GET DATES AND TIMMINGS ########*/
            $dates = $request->input('dates_timmings');
            $dates = explode('-', $dates);
            /* Filter dates and time*/
            if (count($dates) == 2) {
                /* Check dates have start and end time*/
                $start = $dates[0];

                $start_date_time = explode(' ', $start);
                $start_date = $start_date_time[0];
                $start_time = $start_date_time[1].' '.$start_date_time[2];

                $end = $dates[1];
                $end_date_time = explode(' ', $end);
                $end_date = $end_date_time[1];
                $end_time = $end_date_time[2].' '.$end_date_time[3];

            }else{
               /*Only Same Day Available*/
               $start = $dates[0];
               $start_date_time = explode(' ', $start);
               $start_date = $start_date_time[0];
               $start_time = $start_date_time[1].' '.$start_date_time[2];
           }
           /* ########## GET DATES AND TIMMINGS ########*/
           $data->dates_timmings = $request->dates_timmings;
           $data->start_date = $start_date;
           $data->end_date = $end_date;
           $data->start_time = $start_time;
           $data->end_time = $end_time;
           $data->rate = $request->input('rate');
           $data->status = 0;
           $data->cleaning_price = $request->input('cleaning_price');
           $data->additional_notes = $request->input('additional_notes');
           $data->host_notes = $request->input('host_notes');
           $data->checklist_id = $request->input('checklist_id');
           $data->publish_project = $request->input('publish_project');
           $data->restrict_cleaner = $request->input('restrict_cleaner');
           $data->save();
       }else{
        return response()->json(['error'=>$validator->errors()->all()]);
    }
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $user = Auth::user();
        $selectedProperty = Property::find($project->property_id); 
        $selectedChecklist = CheckList::find($project->checklist_id);
        $properties = Property::all();
        $checklists = CheckList::all();
        return view('admin.project.edit',compact('user','selectedProperty','project','properties','checklists','selectedChecklist'));
    }

    public function edit_project($id){
        $user = Auth::user();
        $selectedProperty = Property::find($id); 
        $project = Project::find($id);
        $selectedChecklist = CheckList::find($project->checklist_id);
        // if (empty($selectedChecklist)) {
        //     $selectedChecklist = $selectedProperty;
        // }
        // dd($selectedChecklist);
        $properties = Property::all();
        $checklists = CheckList::all();
        return view('admin.project.edit',compact('user','selectedProperty','project','properties','checklists','selectedChecklist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $data = Project::find($project->id);
        $data->delete(); 
    }

    public function update_project(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'property_id' => 'required',
            'cleaning_price' => 'required',
            'rate' => 'required',            
        ]);

        if ($validator->passes()) {
            $data = Project::find($request->post_id);
            $data->user_id = $request->input('user_id');
            $data->property_id = $request->input('property_id');
            $data->property_name =$request->property_name;

            /* ########## GET DATES AND TIMMINGS ########*/
            $dates = $request->input('dates_timmings');
            $dates = explode('-', $dates);
            /* Filter dates and time*/
            if (count($dates) == 2) {
                /* Check dates have start and end time*/
                $start = $dates[0];

                $start_date_time = explode(' ', $start);
                $start_date = $start_date_time[0];
                $start_time = $start_date_time[1].' '.$start_date_time[2];

                $end = $dates[1];
                $end_date_time = explode(' ', $end);
                $end_date = $end_date_time[1];
                $end_time = $end_date_time[2].' '.$end_date_time[3];

            }else{
               /*Only Same Day Available*/
               $start = $dates[0];
               $start_date_time = explode(' ', $start);
               $start_date = $start_date_time[0];
               $start_time = $start_date_time[1].' '.$start_date_time[2];
           }
           /* ########## GET DATES AND TIMMINGS ########*/
           $data->dates_timmings = $request->dates_timmings;
           $data->start_date = $start_date;
           $data->end_date = $end_date;
           $data->start_time = $start_time;
           $data->end_time = $end_time;
           $data->rate = $request->input('rate');
           $data->status = 0;
           $data->cleaning_price = $request->input('cleaning_price');
           $data->additional_notes = $request->input('additional_notes');
           $data->host_notes = $request->input('host_notes');
           $data->checklist_id = $request->input('checklist_id');
           $data->publish_project = $request->input('publish_project');
           $data->restrict_cleaner = $request->input('restrict_cleaner');
           $data->save();
       }else{
        return response()->json(['error'=>$validator->errors()->all()]);
    }


}
}
