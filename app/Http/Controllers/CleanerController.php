<?php

namespace App\Http\Controllers;

use App\{Property , Invite , Cleaner , User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CleanerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function availabeCleaners(Request $request){
    // Get Accepted request Cleaner
    $cleaners = Invite::where(['user_id' => Auth::user()->id , 'status' => 1])->get();
    foreach($cleaners as $key=>$cleaner){
        if($cleaner->invitation_type == 'email'){
            $cleaners[$key]->cleaner_id = User::where(['email'=>$cleaner->details])->select('id')->first()->id;
        }
    }
    $invites = Invite::where(['user_id' => Auth::user()->id , 'status' => 1])->get(); 
    foreach($invites as $key=>$value){
        $ids = json_decode($value->property_ids);
        $invites[$key]->property_id = $ids;
    }
    $properties = Property::all();
    return view('admin.team.cleaner.view',compact('cleaners','invites','properties'));
    }

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
        // $user = Auth::user();
        // $properties = Property::all();
        // return view('admin.team.cleaner.add', compact('user', 'properties'));
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
     * @param  \App\Cleaner  $cleaner
     * @return \Illuminate\Http\Response
     */
    public function show(Cleaner $cleaner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cleaner  $cleaner
     * @return \Illuminate\Http\Response
     */
    public function edit(Cleaner $cleaner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cleaner  $cleaner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cleaner $cleaner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cleaner  $cleaner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cleaner $cleaner)
    {
        //
    }
}
