<?php

namespace App\Http\Controllers\cleaner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CleanerInformation;
use Auth;
class CleanerJobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formOne = CleanerInformation::where(['user_id' => Auth::user()->id])->exists();

        $formTwo = CleanerInformation::where(['user_id' => Auth::user()->id])->first();
        $formTwo = is_null($formTwo->indenty_back) ? false : true;

        $profilePicture = User::where(['user_id' => Auth::user()->id])->select('image')->first();
        $profilePicture = is_null(profilePicture) ? false : true;

        $address = User::where(['user_id' => Auth::user()->id])->select('address1')->first();
        $address = is_null(address) ? false : true;
        
        $refrence = Reference::where(['user_id' => Auth::user()->id])->exists();
        return view('cleaner.job.jobs',compact('formOne','formTwo','profilePicture','address','refrence'));
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
