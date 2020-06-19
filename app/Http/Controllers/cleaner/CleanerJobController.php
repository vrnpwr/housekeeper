<?php

namespace App\Http\Controllers\cleaner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{CleanerInformation,User};
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
        $user = Auth::user();        
        $title = 'Cleaner Dashboard';
        $formOne = CleanerInformation::where(['user_id' => Auth::user()->id])->exists();
        $cleanerInformation = CleanerInformation::where(['user_id' => Auth::user()->id])->first();
        $formThree = User::where(['id'=> Auth::user()->id])->first();      
        // Address
        if($cleanerInformation){
            $formTwo = is_null($cleanerInformation->address) ? false : true;
        }else{
            $formTwo = null;
        }
        // Image
        if($formThree){
            $formThree = is_null($formThree->image) ? false : true;
        }
        // Identity
        if($cleanerInformation){
            $formFour = is_null($cleanerInformation->identity_front) ? false : true;
        }else{
            $formFour = null;
        }
        return view('cleaner.job.jobs',compact('user','title','formOne','formTwo','formThree','formFour'));
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
