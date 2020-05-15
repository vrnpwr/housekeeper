<?php

namespace App\Http\Controllers\cleaner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('cleaner.profile.profile',compact('user'));   
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
        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $data->last_name = $request->last_name;
        $data->business_name = $request->business_name;
        $data->image = $request->image;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->language = $request->language;
        $data->time_format = $request->time_format;
        $data->first_day = $request->first_day;
        if ($request->password == null) {
            # code...
        }else{
            $check = $this->checkOldPassword($request);
            if (! $check == false) {
                $new_password = $request->new_password;
                $data->password = $request->new_password;
                $data->save();
            }
        }
        
        $data->save();
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

    private function checkOldPassword(Request $request) {

        /* Custom Code */

        // $this->validate($request, [
        //     'pass'     => 'required',
        // ]);

        $data = $request->all();
        $user = User::find(auth()->user()->id);
        if(!Hash::check($data['password'], $user->password)){
         return false;
     }else{
        return true;
       // write code to update password
    }
}

public function deleteImage(Request $request){
    $image_path = public_path('/images/'.$request->image);

     // Value is not URL but directory file path
    if(File::exists($image_path)) {
        File::delete($image_path);
    }else{
        echo $image_path;
        echo "Path not found";
    }
    /* Remove Path from DataBase*/
    $data = User::findOrFail(Auth::user()->id);
    $data->image = null;
    $data->save();

}
}
