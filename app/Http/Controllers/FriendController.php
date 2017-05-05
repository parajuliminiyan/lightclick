<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    function index(){
        $friends = Auth::user()->friends();
        $requests = Auth::user()->friendRequests();
        return view('users.friends')
            ->with('friends',$friends)
            ->with('requests',$requests);


    }

    function getAdd($id){
        $user = User::where('first_name',$id)->first();

        if(!$user){
            return redirect()
                ->route('home')
                ->with('message','That user couldnt be found');
        }

        if(Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user())){
            return redirect()->route('profile',['firstname' => $user->first_name])->with('message','Friend Request already pending');
        }

        if(Auth::user()->isFriendsWith($user)){
            return redirect()->route('profile',['firstname' => $user->first_name])->with('message','You are already friends.');
        }

        Auth::user()->addFriend($user);

        return redirect()->route('profile',['firstname' => $first_name])->with('message','<div class="alert alert-info">Friend Request Sent</div>');
    }

    public function getAccept($first_name){
        $user = User::where('first_name',$first_name)->first();

        if(!$user){
            return redirect()
                ->route('home')
                ->with('message','That user couldnt be found');
        }

        if(!Auth::user()->hasFriendRequestRecived($user)){
            return redirect()->route('home');
        }

        Auth::user()->acceptFriendRequest($user);

        return redirect()->route('profile',['first_name' => $first_name])
            ->with('message','<div class="alert alert-info">Friend Request Accepted</div>');
    }

}
