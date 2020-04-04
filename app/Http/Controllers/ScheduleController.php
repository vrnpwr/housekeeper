<?php

namespace App\Http\Controllers;

use App\Schedule;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Redirect,Response;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $projects = Project::select('id','dates_timmings')->get();
        return view('admin.schedule.view',compact('user','projects'));
    }

    public function show_calendar()
    {
        $result=array();
        $project_list = Project::all();
        
        if($project_list)
        {
            foreach($project_list as $project_list1)
            {
                if(!empty($project_list1['end_date']))
                {
                    $end_date=date('Y-m-d',strtotime($project_list1['end_date'] . ' +1 day'));
                }
                else
                {
                    $end_date="";
                }
                
                $result[]=array('id'=>$project_list1['id'],'title'=>$project_list1['property_name'],'start'=>$project_list1['start_date'],'end'=>$end_date,'backgroundColor'=>'#f39c12','borderColor'=>'#f39c12','description'=>'No Cleaner');
            }
        }
        print_r(json_encode($result));
    }

    public function get_calendar_detail()
    {
        $data = array();
        $id=$_POST['id'];
        $data['project_data'] = Project::find($id);
        return view('modal.body',compact('data'));
        
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
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        //
    }
}
