<?php

namespace App\Http\Controllers;

use App\Invite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Property;
use Illuminate\Support\Facades\Validator;
class InviteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $invites = Invite::all();     
        foreach($invites as $key=>$value){
            $ids = json_decode($value->property_ids);
            $invites[$key]->property_id = $ids;
        }
        return view('admin.team.invites.view' , compact('invites'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Property::where(['user_id' => Auth::user()->id ])->exists())
        {
            $properties = Property::where(['user_id' => Auth::user()->id ])->get();
            return view('admin.team.invites.create' , compact('properties') );
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $validator = Validator::make($request->all(), [
        //     'property_ids' => 'required',
        //     'invitation_type' => 'required',
        //     'cleaner_name' => 'required',
        //     'details' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     return redirect('invite/create')
        //                 ->withErrors($validator)
        //                 ->withInput();
        // }

        // dd($request->all());      
        
    }

    // Unserialize function


    /**
     * Display the specified resource.
     *
     * @param  \App\Invite  $invite
     * @return \Illuminate\Http\Response
     */
    public function show(Invite $invite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invite  $invite
     * @return \Illuminate\Http\Response
     */
    public function edit(Invite $invite)
    {
        $properties = Property::all();
        return view('admin.team.invites.edit' , compact('invite','properties') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invite  $invite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invite $invite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invite  $invite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invite $invite)
    {
        $data = Invite::find($invite->id);
        $data->delete();
        return true;
    }
}
