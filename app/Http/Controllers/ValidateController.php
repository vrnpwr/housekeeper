<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Validator;


class ValidateController extends Controller
{


    /**
     * Display a listing of the myform.
     *
     * @return \Illuminate\Http\Response
     */
    public function myform()
    {
    	return view('myform');
    }


    /**
     * Display a listing of the myformPost.
     *
     * @return \Illuminate\Http\Response
     */
    public function myformPost(Request $request)
    {


    	$validator = Validator::make($request->all(), [
    		'first_name' => 'required',
    		'last_name' => 'required',
    		'email' => 'required|email',
    		'address' => 'required',
    	]);


    	if ($validator->passes()) {


    		return response()->json(['success'=>'Added new records.']);
    	}


    	return response()->json(['error'=>$validator->errors()->all()]);
    }
}
