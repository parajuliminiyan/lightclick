@extends('layout.newhomelayout')
@section('content')
<div class="container page-content ">
    <div class="row">
      <h3>You Searched for "{{Request::input('query')}}" </h3>
   @if(!$users->count())
       <div class="container">Sorry no result found!!</div>
       @else
       <div>
       @foreach($users as $user)
       <div class="box box-widget">
           <div class="box-header with-border">
               <div class="user-blocks">
                 <img height="150px" width="150px" src=" /uploads/{{empty($user->image) ? "/default.jpg" : $user->image}}" alt="User Image">
                 <span class="username" style="font-size:30px; "><a href="{{route("profile",['first_name' => $user->id])}}">{{$user['first_name']." ".$user['last_name']}}</a></span>
                 <div class="pull-right">
                     @if(\Illuminate\Support\Facades\Auth::user()->hasFriendRequestPending($user))
                         <p>Waiting for {{$user->first_name}} to accept your friend request</p>
                     @elseif(\Illuminate\Support\Facades\Auth::user()->hasFriendRequestRecived($user))
                         <a href="{{route('friend.accept',['first_name' => $user->first_name])}}" class="btn btn-primary">Accept Friend Request</a>
                     @elseif(\Illuminate\Support\Facades\Auth::user()->isFriendsWith($user)|| $user->isFriendsWith(\Illuminate\Support\Facades\Auth::user()))

                         <div class="btn-group" role="group" aria-label="...">
  <button type="button" class="btn btn-default"><i class="glyphicon glyphicon-ok"></i></button>
      <button type="button" class="btn btn-default">Friends</button>
</div>
                     @elseif(\Illuminate\Support\Facades\Auth::user()==$user)
                         <a href="{{route('account')}}" class="btn btn-azure btn-lg btn-block pull-right">Edit Profile</a>
                     @else
                         <a href="{{route("friend.Add",["first_name" => $user->first_name])}}" class="btn btn-azure pull-right">Add as Friend</a>
                     @endif

                 </div>
           </div>
           <div class="box-body" style="display: block;">
             @if($user->address)
                 <p>{{$user->address}}</p>
             @endif

           </div>

               <!-- <div class="media">
                   <a class="pull-left" href="{{route("profile",['first_name' => $user->first_name])}}">
                       <img class="media-object" alt="" src="">
                   </a>
                   <div class="media-body">
                       <h4 class="media-heading"><a href="{{route("profile",['first_name' => $user->first_name])}}">{{$user->first_name." ". $user->last_name}}</a></h4>
                       @if($user->address)
                           <p>{{$user->address}}</p>
                       @endif
                   </div>
               </div> -->
             </div></div>
       @endforeach
       </div>
       @endif

    </div>
  </div>



    @endsection
