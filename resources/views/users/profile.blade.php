@extends('layout.newhomelayout')
@section('content')

<!-- Begin page content -->
<div class="row page-content">
    <div class="col-md-8 col-md-offset-2">
        <div class="row">
            <div class="col-md-12 col-md-22">
                <div class="cover profile">
                    <div class="wrapper">
                        <div class="image">
                            <img style="width: 636px; height: 200px;" src="/cover-pic/{{empty($user->cover_image) ? "default.jpg" : $user->cover_image}} " alt="Cover Photo">
                            {{--<img src="/cover-pic/{{$user->cover_image}}" class="show-in-modal" alt="Cover Photo">--}}
                        </div>
                        <ul class="friends">
                            <li>
                                <a href="#">
                                    <img src="/uploads/{{$user->image}}" alt="people" class="img-responsive">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="/uploads/{{$user->image}}" alt="people" class="img-responsive">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="/uploads/{{$user->image}}" alt="people" class="img-responsive">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="/uploads/{{$user->image}}" alt="people" class="img-responsive">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="/uploads/{{$user->image}}" alt="people" class="img-responsive">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="/uploads/{{$user->image}}" alt="people" class="img-responsive">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="/uploads/{{$user->image}}" alt="people" class="img-responsive">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="/uploads/{{$user->image}}" alt="people" class="img-responsive">
                                </a>
                            </li>
                            <li><a href="#" class="group"><i class="fa fa-group"></i></a></li>
                        </ul>
                    </div>
                    <div class="cover-info">
                        <div class="avatar">
                            <img src=" /uploads/{{empty($user->image) ? "/default.jpg" : $user->image}}" alt="people">
                        </div>
                        <div class="name"><a href="#">{{$user->first_name." ". $user->last_name}}</a></div>
                        <ul class="cover-nav">
                            <li class="active"><a href="profile.html"><i class="fa fa-fw fa-bars"></i> Timeline</a></li>
                            <li><a href="about.html"><i class="fa fa-fw fa-user"></i> About</a></li>
                            <li><a href="friends.html"><i class="fa fa-fw fa-users"></i> Friends</a></li>
                            <li><a href="photos1.html"><i class="fa fa-fw fa-image"></i> Photos</a></li>
                            <div class="pull-right">
                                @if(\Illuminate\Support\Facades\Auth::user()->hasFriendRequestPending($user))
                                    <p>Waiting for {{$user->first_name}} to accept your friend request</p>
                                @elseif(\Illuminate\Support\Facades\Auth::user()->hasFriendRequestRecived($user))
                                    <a href="{{route('friend.accept',['first_name' => $user->first_name])}}" class="btn btn-primary">Accept Friend Request</a>
                                @elseif(\Illuminate\Support\Facades\Auth::user()->isFriendsWith($user)|| $user->isFriendsWith(\Illuminate\Support\Facades\Auth::user()))
                                    <p> You and {{$user->first_name}} are friends.</p>
                                @elseif(\Illuminate\Support\Facades\Auth::user()==$user)
                                    <a href="{{route('account')}}" class="btn btn-azure btn-lg btn-block pull-right">Edit Profile</a>
                                @else
                                    <a href="{{route("friend.Add",["first_name" => $user->first_name])}}" class="btn btn-azure pull-right">Add as Friend</a>
                                @endif

                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="widget">
                    <div class="widget-header">
                        <h3 class="widget-caption">About</h3>
                    </div>
                    <div class="widget-body bordered-top bordered-sky">
                        <ul class="list-unstyled profile-about margin-none">
                            <li class="padding-v-5">
                                <div class="row">
                                    <div class="col-sm-4"><span class="text-muted">Date of Birth</span></div>
                                    <div class="col-sm-8">{{$user->dob}}</div>
                                </div>
                            </li>
                            <li class="padding-v-5">
                                <div class="row">
                                    <div class="col-sm-4"><span class="text-muted">Job</span></div>
                                    <div class="col-sm-8">Ninja developer</div>
                                </div>
                            </li>
                            <li class="padding-v-5">
                                <div class="row">
                                    <div class="col-sm-4"><span class="text-muted">Gender</span></div>
                                    <div class="col-sm-8">@if($user->gender == 1) Male @elseif($user->gender == 2) Female @else @endif</div>
                                </div>
                            </li>
                            <li class="padding-v-5">
                                <div class="row">
                                    <div class="col-sm-4"><span class="text-muted">Lives in</span></div>
                                    <div class="col-sm-8">{{$user->address}}</div>
                                </div>
                            </li>
                            <li class="padding-v-5">
                                <div class="row">
                                    <div class="col-sm-4"><span class="text-muted">Credits</span></div>
                                    <div class="col-sm-8">249</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="widget widget-friends">
                    <div class="row col-md-22">
                    </div>
                    <div class="widget-header">
                        <h3 class="widget-caption">Friends</h3>
                    </div>
                    <div class="widget-body bordered-top  bordered-sky">
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="img-grid" style="margin: 0 auto;">
                                      @foreach($user->friends() as $friend)


                                        <li>@if(count($friend) <= 0)
                                            @if(\Illuminate\Support\Facades\Auth::user() == $user)
                                                <p>You have no any friends</p>
                                            @else
                                                <p>{{$user->first_name}} has no any friends.</p>
                                            @endif
                                        @endif</li>
                                        <li> <a href="#">
                                            <img src="/uploads/{{$friend->image}}" alt="image">
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="widget">
                    <div class="widget-header">
                        <h3 class="widget-caption">Groups</h3>
                    </div>
                    <div class="widget-body bordered-top bordered-sky">
                        <div class="card">
                            <div class="content">
                                <ul class="list-unstyled team-members">
                                    <li>
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <div class="avatar">
                                                    <img src="img/Likes/likes-1.png" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                Github
                                            </div>

                                            <div class="col-xs-3 text-right">
                                                <btn class="btn btn-sm btn-azure btn-icon"><i class="fa fa-user"></i></btn>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <div class="avatar">
                                                    <img src="img/Likes/likes-3.png" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                Css snippets
                                            </div>

                                            <div class="col-xs-3 text-right">
                                                <btn class="btn btn-sm btn-azure btn-icon"><i class="fa fa-user"></i></btn>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <div class="avatar">
                                                    <img src="img/Likes/likes-2.png " alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                Html Action
                                            </div>

                                            <div class="col-xs-3 text-right">
                                                <btn class="btn btn-sm btn-azure btn-icon"><i class="fa fa-user"></i></btn>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>






            <!--============= timeline posts-->
            <div class="col-md-7">
                <div class="row">
                    <!-- left posts-->
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- post state form -->
                                <div class="box profile-info n-border-top">
                                    <form>
                                        <textarea class="form-control input-lg p-text-area" rows="2" placeholder="Whats in your mind today?"></textarea>
                                    </form>
                                    <div class="box-footer box-form">
                                        <button type="button" class="btn btn-azure pull-right">Post</button>
                                        <ul class="nav nav-pills">
                                            <li><a href="#"><i class="fa fa-map-marker"></i></a></li>
                                            <li><a href="#"><i class="fa fa-camera"></i></a></li>
                                            <li><a href="#"><i class=" fa fa-film"></i></a></li>
                                            <li><a href="#"><i class="fa fa-microphone"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- end post state form-->

                                <!--   posts -->
                                @if(!$posts->count())
                                    @if(Auth::user()== $user)
                                        <p>You have not posted anything yet.</p>
                                    @else
                                    <p>{{$user->first_name}} has not posted anything yet.</p>
                                    @endif
                                @else
                                    @foreach($posts as $post)
                                        <div class="box box-widget">
                                            <div class="box-header with-border">
                                                <div class="user-block">
                                                    <img class="img-circle" src=" /uploads/{{empty($post->user->image) ? "/default.jpg" : $post->user->image}}" alt="User Image">
                                                    <span class="username"><a href="#">{{$post->user['first_name']." ".$post->user['last_name']}}</a></span>
                                                    <span class="description">Shared publicly - {{$post->created_at->diffForHumans()}}</span>
                                                </div>
                                            </div>


                                            <div class="box-body" style="display: block;">
                                                @if($post->image)
                                                    <p style="font-size: 20px;">{{$post->caption}}</p>
                                                    <p style="font-size: 30px;"><img src="/post-photos/{{$post->image}}" style="height: 250px; width: 250px; "></p>
                                                @else
                                                    <p>{{$post->body}}</p>
                                                @endif
                                                @if(Auth::user() == $post->user)
                                                    <a href="{{route('postDelete',$post->id)}}" name="post_delete">
                                                        <button type="button" class="btn btn-default btn-xs"><i class="fa fa-trash"></i> Delete</button></a>

                                                        <span class="pull-right text-muted">{{$post->likes->count()}} {{str_plural('likes',$post->likes->count())}} - {{$post->comments->count()}} {{str_plural('comments',$post->comments->count())}}</span>

                                                    @else
                                                        <a href="{{route('postlike',["postId" =>$post->id])}}">
                                                            <button type="button" class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-up"></i> Like</button></a>
                                                        <span class="pull-right text-muted">{{$post->likes->count()}} {{str_plural('likes',$post->likes->count())}} - {{$post->comments->count()}} {{str_plural('comments',$post->comments->count())}}</span>
                                                    @endif

                                            </div>
                                            <div class="box-footer box-comments" style="display: block;">
                                                @foreach($post->comments as $comment)
                                                    <div class="box-comment">
                                                        <img class="img-circle img-sm" src=" /uploads/{{empty($comment->user->image) ? "/default.jpg" : $comment->user->image}}" alt="User Image">
                                                        <div class="comment-text">
                          <span class="username">
                          {{$comment->user->first_name." ". $comment->user->last_name}}
                              <span class="text-muted pull-right"> {{$comment->created_at->diffForHumans()}}</span>
                          </span>{{$comment->body}}
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="box-footer" style="display: block;">
                                                    <form action="{{route('comments',$post->id)}}" method="post">
                                                        {{csrf_field()}}
                                                        <img class="img-responsive img-circle img-sm" src=" /uploads/{{empty(\Illuminate\Support\Facades\Auth::user()->image) ? "/default.jpg" : \Illuminate\Support\Facades\Auth::user()->image}}" alt="Alt Text">
                                                        <div class="img-push">
                                                            <input type="text" class="form-control input-sm" name="comment" placeholder="Press enter to post comment">
                                                            <input type="hidden" value="{{Session::token()}}" name="_token">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            </div>
                                    @endforeach
                                            @endif


                                <!--  end posts -->
                            </div>
                        </div>
                    </div> <!--end left posts-->
                </div>
            </div> <!-- end timeline posts -->






        </div>
    </div>
</div>


<!-- Modal-->
<div class="modal fade" id="modalShow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body text-centers">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
<footer class="footer">
    <div class="container">
        <p class="text-muted"> Copyright &copy; LightClick - All rights reserved  </p>
    </div>
</footer>
<script type="text/javascript">
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-49755460-1', 'auto', {'allowLinker': true});
    ga('require', 'linker');
    ga('linker:autoLink', ['bootdey.com','www.bootdey.com','demos.bootdey.com'] );
    ga('send', 'pageview');
</script>
</body>
</html>
