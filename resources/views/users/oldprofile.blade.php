
@extends('layout.homelayout')
@section('content')

<div class="row container">

    @if (Session::has('message'))

        {!!  Session::get('message')  !!}
    @endif
    </div>
    <div class="col-lg-5">
        @include('users/userblock')
<hr style=" padding: 0;
    border: none;
    border-top: medium double #333;
    color: #333;
    text-align: center;">
        @if(!$posts->count())
            @if(\Illuminate\Support\Facades\Auth::user()==$user)
                <p>You have not posted anything yet.</p>
            @else
            <p>{{$user->first_name}} has not posted anything yet.</p>
            @endif
        @else
            @foreach($posts as $post)
                <article class="post" data-postid="{{ $post->id }}">
                    <table border="0">
                        <tr>
                            <td><img src=" /uploads/{{empty($post->user->image) ? "/default.jpg" : $post->user->image}}" style="height: 55px; width: 55px; border-radius: 10%;">
                                &nbsp;<b><u>{{$post->user['first_name']." ".$post->user['last_name']}}</u></b></td>
                        </tr>
                        <tr><td colspan="2">@if(($post->image))
                                    {{$post->caption}}
                            </td></tr>
                        <tr>
                            <td><img src="/post-photos/{{$post->image}}" style="height: 250px; width: 250px; "></td>
                        </tr>
                        @else
                            {{$post->body}}
                        @endif
                    </table>
                    &nbsp;&nbsp;&nbsp;
                    <table border="0">
                        <tr><td>
                                @if($UserIsFriend)
                                <div class="interaction">
                                    <ul class="list-inline">
                                        <li><a href="{{route('postlike',["postId" =>$post->id])}}">Like</a></li>
                                        <li>{{$post->likes->count()}} {{str_plural('likes',$post->likes->count())}}</li>
                                    </ul>



                                    @if(Auth::user() == $post->user )
                                        |
                                        <a href="#" class="edit-btn">Edit</a>
                                        <a href="{{route('postDelete',$post->id)}}" name="post_delete">Delete</a>
                                    @endif
                                </div>
                                    @endif
                            </td></tr>


                    </table>
                    <div class="info">
                        <i class="divider" role="separator">

                        </i></div>


                    <table border="0" style="width: 100%">
                        <div class="comment">
                            <label>Comments</label><hr>
                            @foreach($post->comments as $comment)

                                <tr>
                                    <td>
                                        <div style="color: #3c763d;"><img src=" /uploads/{{empty($comment->user->image) ? "/default.jpg" : $comment->user->image}}" style="height: 55px; width: 55px; border-radius: 10%;"><b><u>{{$comment->user->first_name." ".$comment->user->last_name}}</u></b></div>
                                    </td>
                                    <td> @if(Auth::user() == $comment->user )<div class="btn-group ">
                                            <i style="color: #ecf0f1;" class="glyphicon glyphicon-chevron-down pull-right" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            </i>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="">Edit</a>
                                                <a class="dropdown-item" href="#"> Delete</a>
                                            </div>
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{$comment->body}}<hr style="border: 0;
    height: 1px;
    background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));"></td>
                                </tr>

                            @endforeach
                        </div>
                    </table>
                    <table border="0px" style="width: 100%">
                        @if($UserIsFriend)
                        <tr><td><label>Write a Comments </label></td></tr>
                        <tr><td>
                                <form action="{{route('comments',$post->id)}}" method="post">
                                    {{csrf_field()}}
                                    <textarea class="comment-field form-control" name="comment" style="resize: none;" ></textarea>
                                    <input type="hidden" value="{{Session::token()}}" name="_token">


                        <tr><td>
                                <button class="btn btn-primary pull-right">Post</button>
                                {{--<button type="submit" class="btn-block pull-right">Comment</button>--}}
                                </form>
                            </td></tr>
                        @endif
                    </table>
                    <hr style=" height: 30px;
    border-style: solid;
    border-color: black;
    border-width: 1px 0 0 0;
    border-radius: 20px;"><hr>
                </article>
            @endforeach
        @endif
    </div>
</section>


</div>


    <div class="col-lg-4 col-lg-offset-3">
        @if(\Illuminate\Support\Facades\Auth::user()->hasFriendRequestPending($user))
            <p>Waiting for {{$user->first_name}} to accept your friend request</p>
            @elseif(\Illuminate\Support\Facades\Auth::user()->hasFriendRequestRecived($user))
                <a href="{{route('friend.accept',['first_name' => $user->first_name])}}" class="btn btn-primary">Accept Friend Request</a>
            @elseif(\Illuminate\Support\Facades\Auth::user()->isFriendsWith($user)|| $user->isFriendsWith(\Illuminate\Support\Facades\Auth::user()))
            <p> You and {{$user->first_name}} are friends.</p>
            @elseif(\Illuminate\Support\Facades\Auth::user()==$user)
            <a href="{{route('account')}}" class="btn btn-primary">Edit Profile</a>
            @else
            <a href="{{route("friend.Add",["first_name" => $user->first_name])}}" class="btn btn-primary">Add as Friend</a>
            @endif
        <h4>{{$user->first_name}} has {{$user->friends()->count()}} {{str_plural('friends',$user->friends()->count())}}</h4>
            <h4>{{$user->first_name}}'s Friends</h4>
            @if(!$friends->count())
                <p>You have no friends.</p>
            @else
                @foreach($friends as $user)
                    @include('users/userblock')
                @endforeach
            @endif
    </div>
    </div>
</div>

@endsection