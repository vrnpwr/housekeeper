<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use DB;
use Validator;

class ProfileController extends Controller
{
    public function account_type(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'user_id' => 'required', 
            'type' => 'required', 
            ]);
            if ($validator->fails()) { 
                return response()->json(['error'=>$validator->errors()], 401);            
            }
            $type = $request->type;
            $id = $request->user_id;
            $affected_row = false;
            if(User::where('id',$id)->exists()){
                $user = User::where('id',$id)->first();
                $user->type = $type;
                $user->save();
                return response()->json([
                    'message' => 'Account type successfully updated to ' . $type
                ], 200);
            }else{
                return response()->json([
                    'message','user id not found'
                ],404);
            }
        }

        // Basic Info API

        public function basic_info(Request $request)
        {
            $validator = Validator::make($request->all(), [ 
                'user_id' => 'required', 
                'first_name' => 'required', 
                'phone' => 'required|integer|unique:users', 
                ]);
                if ($validator->fails()) { 
                    return response()->json(['error'=>$validator->errors()], 401);            
                }
                $id = $request->user_id;
                if(User::where('id',$id)->exists()){
                    $user = User::where('id',$id)->first();
                    $user->name = $request->first_name;
                    $user->last_name = $request->last_name;
                    $user->phone = $request->phone;
                    $user->save();
                    return response()->json([
                        'message' => 'Account successfully updated'
                    ], 200);
                }else{
                    return response()->json([
                        'message','something went gone'
                    ],404);
                }
            }

        // Address Info API
        public function address_info(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'address_line1' => 'required', 
                'region' => 'required', 
                'city' => 'required', 
                'zipcode' => 'required|integer|max:12', 
                ]);
                if ($validator->fails()) { 
                    return response()->json(['error'=>$validator->errors()], 401);
                }
                $id = $request->user_id;
                $affected_row = false;
                if(User::where('id',$id)->exists()){
                    $user = User::where('id',$id)->first();
                    $user->address_line1 = $request->address_line1;
                    $user->address_line2 = $request->address_line2;
                    $user->city = $request->city;
                    $user->zipcode = $request->zipcode;
                    $user->save();
                    return response()->json([
                        'message' => 'Address successfully updated'
                    ], 200);
                }else{
                    return response()->json([
                        'message','something went gone'
                    ],404);
                }
        }

        

        // About Yourself API
        public function about_yourself(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'about' => 'required', 
                ]);
                if ($validator->fails()) {
                    return response()->json(['error'=>$validator->errors()], 401);
                }
                $id = $request->user_id;
                if(User::where('id',$id)->exists()){
                    $user = User::where('id',$id)->first();
                    $user->about = $request->about;                    
                    $user->save();
                    return response()->json([
                        'message' => 'About yorself successfully updated'
                    ], 200);
                }else{
                    return response()->json([
                        'message','something went gone'
                    ],404);
                }
        }



    }
    