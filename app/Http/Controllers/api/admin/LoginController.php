<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Validator;

class LoginController extends Controller
{
        public $successStatus = 200;
        
        // login
        public function login(Request $request){
        $login =  $request->validate([
            'email' => 'required|email',
            'password' => 'required'
            ]);
            
            if( !Auth::attempt( $login)) {
                return response(['message' => 'Invalid login credentials' , 'status' => false]);
            }
            
            $accessToken = Auth::user()->createToken('authToken')->accessToken;
            return response(['user_id'=>Auth::user()->id, 'access_token' => $accessToken , 'status' => true]);
        }
        
        // register
        public function register(Request $request) 
        { 
            $validator = Validator::make($request->all(), [ 
                'email' => 'required|email|unique:users', 
                'password' => 'required', 
                'c_password' => 'required|same:password', 
                ]);
                if ($validator->fails()) { 
                    return response()->json(['error'=>$validator->errors()->first() , 'status' => false], 401);            
                }
                $input = $request->all(); 
                $input['password'] = bcrypt($input['password']); 
                $user = User::create($input); 
                $success['token'] =  $user->createToken('authToken')->accessToken; 
                $success['email'] =  $user->email;
                $success['user_id'] =  $user->id;
                return response()->json(['success'=>$success , 'status' => true], $this->successStatus); 
            }
            
            public function all()
            {
                return User::all();
            }
        }
        