<?php

namespace App\Http\Controllers;

use App\ProjectSetting;
use Illuminate\Http\Request;
use Auth;
use DB;

class ProjectSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $user_id = Auth::user()->id;
        $projectSettings = DB::table('project_settings')->select('project_settings')->where('user_id', $user_id)->first();
        if (!is_null($projectSettings)) {
            $projectSettings = json_decode($projectSettings->project_settings);
        }
        
        $options = array();

        $options[0]['title'] = "Enable Direct Assign";
        $options[0]['description'] = "This will allow you to assign projects directly to a cleaner without the cleaner needing to accept the project. Cleaners will be able to opt out. We recommend that you only use this feature if you have direct control over the cleaners.";
        $options[0]['key']= "assign_project";

        $options[1]['title'] = "When a booking is cancelled after the check-in time, keep the associated cleaning project";
        $options[1]['description'] = "This is useful when the guest arrived and then canceled their stay so the unit still needs to be cleaned."; 
        $options[1]['key']= "cancel_booking";

        $options[2]['title'] = "Quality Control";
        $options[2]['description'] = "This allows hosts and co-hosts to mark a project as Quality Controlled after it is completed.
        ";
        $options[2]['key']= "quality_control";


        $options[3]['title'] = "Checklists";
        $options[3]['description'] = "Require cleaner to check each item off your checklist before completing the project.";
        $options[3]['key']= "checklists";

        
        /* Create a array for options */
        return view('admin.project_setting.project_setting',compact('user','projectSettings','options'));
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
        $settings = $_POST['project_setting'];
        if (!isset($settings[0]['assign_project'])) {
            $settings[0]['assign_project'] = 0;
        }
        if (!isset($settings[1]['cancel_booking'])) {
            $settings[1]['cancel_booking'] = 0;
        }
        if (!isset($settings[2]['quality_control'])) {
            $settings[2]['quality_control'] = 0;
        }
        if (!isset($settings[3]['checklists'])) {
            $settings[3]['checklists'] = 0;
        }
        $user_id = Auth::user()->id;
        $checkData = DB::table('project_settings')->where('user_id', $user_id)->first();

        /* Get data from post request*/


        if ($checkData == null) {
            $data = new ProjectSetting;
            $data->user_id = $user_id;
            $data->project_settings = json_encode($settings);
            $data->save();
        }else{
            $id = $checkData->id;
            $data = ProjectSetting::find($id);
            $data->project_settings = json_encode($settings);
            $data->save();
        }


    }

        /**
     * Display the specified resource.
     *
     * @param  \App\ProjectSetting  $projectSetting
     * @return \Illuminate\Http\Response
     */
        public function show(ProjectSetting $projectSetting)
        {
        //
        }

        /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProjectSetting  $projectSetting
     * @return \Illuminate\Http\Response
     */
        public function edit(ProjectSetting $projectSetting)
        {
        //
        }

        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProjectSetting  $projectSetting
     * @return \Illuminate\Http\Response
     */
        public function update(Request $request, ProjectSetting $projectSetting)
        {
        //
        }

        /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProjectSetting  $projectSetting
     * @return \Illuminate\Http\Response
     */
        public function destroy(ProjectSetting $projectSetting)
        {
        //
        }
    }
