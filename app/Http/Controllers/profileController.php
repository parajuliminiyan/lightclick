<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class profileController extends Controller
{
    function getProfile($first_name)
    {
        $user = User::where('id',$first_name)->first();
        if(!$user){
            abort(404);
        }
        $posts = $user->posts()->orderBy('created_at','desc')->get();
        return view('users.profile')
            ->with('user',$user)
            ->with("posts",$posts)
            ->with("UserIsFriend", Auth::user()->isFriendsWith($user));

    }
}
