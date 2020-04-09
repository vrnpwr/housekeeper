<?php

namespace App\Http\Controllers;

use App\Cleaner;
use Illuminate\Http\Request;
use Auth;

class CleanerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $user = Auth::user();
        return view('admin.team.cleaner.add',compact('user'));
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
