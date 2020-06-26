<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{User};
class ActionController extends Controller
{
    // This function Approve cleaner profile
    public function approve_cleaner(Request $request) {
       $id = $request->id;
       $data = User::where(['id' => $id])->update(['status'=>1]);       
       return true;
    }
    // This function Dissaprove cleaner profile
    public function disapprove_cleaner(Request $request) {
       $id = $request->id;
       $data = User::where(['id' => $id])->update(['status'=>0]);       
       return true;
    }
}
