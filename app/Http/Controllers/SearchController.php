<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    function getResults(Request $request){

        $query = $request->input('query');
        if(!$query){
            return redirect()->route('home');

        }

        $users = User::where(DB::raw("CONCAT(first_name, '', last_name)"),'LIKE',"%{$query}%")->get();


        return view('users.search')->with('users', $users);
    }
}
