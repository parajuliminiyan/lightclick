<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use error;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginFormRequest;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class IndexController extends Controller
{
    function index(){
        return view('index.index');

    }



    function login(Request $request){

        if(Auth::attempt($request->only('email','password') ) ){
//            dd('Testing');
            return redirect()->intended(route('home'));

        } else{
            //        dd('error');
            return redirect()->route('login')->with('msg','<div style="border: 1px solid red;
    background-color: #f9b5af;
    color: red;
    height:50px;
    margin-top:168px">Sorry!! Email or Password did not match..</div>');
        }



    }


    function signup(){
        return view('users.register');
    }

    function register(Request $request){
        $validator = Validator::make($request->all(), [
            'first_name' =>'required',
            'last_name' =>'required',
            'gender' => 'required',
            'email' =>'required',
            'password' =>'required',
            'dob' =>'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $user = $request->all();
        $user['auth_token'] = md5(uniqid(str_random()));
//        $user['image'] = $image->getClientOriginalName();
        User::create( $user );
        return redirect('/');
    }
}
