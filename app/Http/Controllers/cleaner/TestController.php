<?php

namespace App\Http\Controllers\cleaner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function session(Request $request){
        session(['key' => 'value']);        
        $this->checksession($request);
    }
    private function checksession($request){
        if ($request->session()->has('key')) {
            dd("Key Available in session");
        }
    }
}
