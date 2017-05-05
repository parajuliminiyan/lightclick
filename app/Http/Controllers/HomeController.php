<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    function home()
    {
        $users = User::all();
        return view('users.home', ['users' => $users]);
    }


    function logout(User $user)
    {

        Auth::logout();
        return redirect()->route('login')
            ->with('logout-msg','<h3 class="sm-text">Hope You Had a Great Time.</h3>');
    }

    function post(Request $request, $id)
    {
        $user = User::find($id);
        $user->update($request->only('post'));
        return redirect()->route('home');
    }

    function getAccount()
    {
        return view('users.editprofile', ['user' => Auth::user()]);
    }

    function editAccount(Request $request, $id)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . "." . $image->getClientOriginalExtension();
            Input::file('image')->move(public_path('uploads'), $filename);
            $user = Auth::user();
            $user->image = $filename;
            $user->save();
            return redirect()->route('account');
        }
        if($request->hasFile('cover-pic')){
                $cover_pic = $request->file('cover-pic');
                $cover_filename = time(). "." . $cover_pic->getClientOriginalExtension();
//                Input::file('cover-pic')->move(public_path('cover-pic'), $cover_filename);
                Image::make($cover_pic)->resize(800,300)->save(public_path('cover-pic/'.$cover_filename));
                $user = Auth::user();
                $user->cover_image = $cover_filename;
//                dd($user);
                $user->save();
            //return redirect()->route('account')->with(['meaasge'=> 'hello']);
            return redirect()->route('home')->with(['profilepic'=>'hello']);
        }
        $user = User::find($id);
        $user->update($request->all());

        return redirect()->route('profile',["first_name" => $user->first_name])->with('message','<div style="color: #2ca02c; font-size: 50px;">Profile Successfully Updated </div>');
    }


}
