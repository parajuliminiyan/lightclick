@extends('layout.newhomelayout')
@section('content')
    @if (Session::has('profilepic'))

       <h1>Working</h1>


    @endif
    <!-- Begin page content -->
<div class="container page-content ">
    <div class="row col-md-22">
    </div>
    <div class="row">
        <!-- left links -->
        <div class="col-md-3">
            <div class="profile-nav">
                <div class="widget">
                    <div class="widget-body">
                        <div class="user-heading round">
                            <a href="#">
                                <img src="uploads/{{empty(\Illuminate\Support\Facades\Auth::user()->image) ? "default.jpg" : \Illuminate\Support\Facades\Auth::user()->image}} " alt="">
                            </a>
                            <h1>{{\Illuminate\Support\Facades\Auth::user()->first_name}}</h1>
                            <p>@username</p>
                        </div>

                        <ul class="nav nav-pills nav-stacked">
                            <li class="active"><a href="#"> <i class="fa fa-user"></i> News feed</a></li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-envelope"></i> Messages
                                    <span class="label label-info pull-right r-activity"></span>
                                </a>
                                <a href="{{route('friends')}}">
                                    <i class="fa fa-users"></i> Friend Requests
                                    <span class="label label-info pull-right r-activity"></span>
                                </a>
                            </li>
                            <li><a href="#"> <i class="fa fa-calendar"></i> Events</a></li>
                            <li><a href="#"> <i class="fa fa-image"></i> Photos</a></li>
                            <li><a href="#"> <i class="fa fa-share"></i> Browse</a></li>
                            <li><a href="{{route('logout')}}"> <i class="fa fa-sign-out"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>

                <div class="widget">
                    <div class="widget-body">
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#"> <i class="fa fa-globe"></i> Pages</a></li>
                            <li><a href="#"> <i class="fa fa-gamepad"></i> Games</a></li>
                            <li><a href="#"> <i class="fa fa-puzzle-piece"></i> Ads</a></li>
                            <li><a href="#"> <i class="fa fa-home"></i> Markerplace</a></li>
                            <li><a href="#"> <i class="fa fa-users"></i> Groups</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div><!-- end left links -->


        <!-- center posts -->
        <div class="col-md-6">
            <div class="row">
                <!-- left posts-->
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- post state form -->
                            <div class="box profile-info n-border-top">
                                <form action="{{route('post')}}" enctype="multipart/form-data" method="post">
                                        {{csrf_field()}}
                                    <textarea class="form-control input-lg p-text-area" name="body" rows="2" placeholder="Whats in your mind today?"></textarea>
                                <div class="box-footer box-form">
                                    <ul class="nav nav-pills">
                                        <li><a href="#"><i class="fa fa-map-marker"></i></a></li>
                                        <li><a href="#"><i class="fa fa-camera"><input type="file" name="image" style="opacity:0; width:10px; height: 10px; cursor: pointer"></i></a></li>
                                        <li><a href="#"><i class=" fa fa-film"></i></a></li>
                                        <li><a href="#"><i class="fa fa-microphone"></i></a></li>
                                        <button type="submit" class="btn btn-azure pull-right">Post</button>
                                    </ul>


                                </div>
                                    {{--<input type="hidden" value="{{ Session::token() }}" name="_token">--}}
                                </form>

                            </div><!-- end post state form -->

                            <!--   posts -->
                            @if(!$posts->count())
                                <p>There is nothing on your feeds!!</p>
                            @else
                                @foreach($posts as $post)
                                        <div class="box box-widget">
                                            <div class="box-header with-border">
                                                <div class="user-block">
                                                    <img class="img-circle" src=" /uploads/{{empty($post->user->image) ? "/default.jpg" : $post->user->image}}" alt="User Image">
                                                    <span class="username"><a href="{{route("profile",['first_name' => $post->user->id])}}">{{$post->user['first_name']." ".$post->user['last_name']}}</a><i>@if($post->image) added a new photo.@endif</i></span>
                                                    <span class="description">Shared publicly - {{$post->created_at->diffForHumans()}}</span>
                                                </div>
                                            </div>


                                            <div class="box-body" style="display: block;">
                                                @if($post->image)
                                                    <p style="font-size: 20px;">{{$post->caption}}</p>
                                                    <p style="font-size: 30px;"><img src="/post-photos/{{$post->image}}" style="height: 250px; width: 250px; "></p>
                                                @else
                                                <p style="font-size: 30px;"> {{$post->body}}</p>
                                                @endif
                                                    @if(Auth::user() == $post->user)
                                                        <a href="{{route('postDelete',$post->id)}}" name="post_delete">
                                                            <button type="button" class="btn btn-default btn-xs"><i class="fa fa-trash"></i> Delete</button></a>
                                                            <span class="pull-right text-muted">{{$post->likes->count()}} {{str_plural('likes',$post->likes->count())}} - {{$post->comments->count()}} {{str_plural('comments',$post->comments->count())}}</span>

                                                            @else
                                                                <a href="{{route('postlike',["postId" =>$post->id])}}">
                                                                    <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-up"></i> Like</button></a>
                                                                <span class="pull-right text-muted">{{$post->likes->count()}} {{str_plural('likes',$post->likes->count())}} - {{$post->comments->count()}} {{str_plural('comments',$post->comments->count())}}</span>
                                                            @endif
                                                            </div>
                                            <div class="box-footer box-comments" style="display: block;">
                                                @foreach($post->comments as $comment)
                                                <div class="box-comment">
                                                    <img class="img-circle img-sm" src=" /uploads/{{empty($comment->user->image) ? "/default.jpg" : $comment->user->image}}" alt="User Image">
                                                    <div class="comment-text">
                          <span class="username"><a href="{{route("profile",['first_name' => $comment->user->id])}}">{{$comment->user->first_name." ". $comment->user->last_name}}</a></span><span class="pull-right"><!-- Single button -->
<div class="btn-group">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
    <li><a href="#" class="button" data-toggle="modal" data-target="#myModal">Edit</a></li>
    <li><a href="#">Delete</a></li>
  </ul>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Comment</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('editcomment',$comment->id)}}">
                    {{csrf_field()}}

                    <input type="text" class="form-control input-sm" name="comment" placeholder="Press enter to update your comment" >

                    {{--<input type="hidden" value="{{Session::token()}}" name="_token">--}}
                </form>
            </div>
            </div>
        </div>
    </div>
</span>
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

                                        </div>

                                        </div>
                                        </div>
                                </div>
                                  </div>

                                <!--  end posts-->





        <!-- right posts -->
        <div class="col-md-3">
            <div class="row col-md-22">

            </div>
            <!-- Friends activity -->
            <div class="widget">
                <div class="widget-header">
                    <h3 class="widget-caption">Friends activity</h3>
                </div>
                <div class="widget-body bordered-top bordered-sky">
                    <div class="card">
                        <div class="content">
                            <ul class="list-unstyled team-members">
                                <li>
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <div class="avatar">
                                                <img src="img/Friends/woman-2.jpg" alt="img" class="img-circle img-no-padding img-responsive">
                                            </div>
                                        </div>
                                        <div class="col-xs-9">
                                            <b><a href="#">Hillary Markston</a></b> shared a
                                            <b><a href="#">publication</a></b>.
                                            <span class="timeago" >5 min ago</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <div class="avatar">
                                                <img src="img/Friends/woman-3.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                            </div>
                                        </div>
                                        <div class="col-xs-9">
                                            <b><a href="#">Leidy marshel</a></b> shared a
                                            <b><a href="#">publication</a></b>.
                                            <span class="timeago" >5 min ago</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <div class="avatar">
                                                <img src="img/Friends/woman-4.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                            </div>
                                        </div>
                                        <div class="col-xs-9">
                                            <b><a href="#">Presilla bo</a></b> shared a
                                            <b><a href="#">publication</a></b>.
                                            <span class="timeago" >5 min ago</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <div class="avatar">
                                                <img src="img/Friends/woman-4.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                            </div>
                                        </div>
                                        <div class="col-xs-9">
                                            <b><a href="#">Martha markguy</a></b> shared a
                                            <b><a href="#">publication</a></b>.
                                            <span class="timeago" >5 min ago</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> <!-- End Friends activity-->

            <!-- People You May Know -->
            <div class="widget">
                <div class="row col-md-22">

                </div>
                <div class="widget-header">
                    <h3 class="widget-caption">People You May Know</h3>
                </div>
                <div class="widget-body bordered-top bordered-sky">
                    <div class="card">
                        <div class="content">
                          <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Home page ad -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6772199449422751"
     data-ad-slot="6434659429"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
                          <!--  <ul class="list-unstyled team-members">
                                <li>
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <div class="avatar">
                                                <img src="img/Friends/guy-2.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            Carlos marthur
                                        </div>

                                        <div class="col-xs-3 text-right">
                                            <btn class="btn btn-sm btn-azure btn-icon"><i class="fa fa-user-plus"></i></btn>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <div class="avatar">
                                                <img src="img/Friends/woman-1.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            Maria gustami
                                        </div>

                                        <div class="col-xs-3 text-right">
                                            <btn class="btn btn-sm btn-azure btn-icon"><i class="fa fa-user-plus"></i></btn>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <div class="avatar">
                                                <img src="img/Friends/woman-2.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            Angellina mcblown
                                        </div>

                                        <div class="col-xs-3 text-right">
                                            <btn class="btn btn-sm btn-azure btn-icon"><i class="fa fa-user-plus"></i></btn>
                                        </div>-->
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div><!-- End people yout may know -->
        </div><!-- end right posts -->
    </div>
</div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit Comment</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('editcomment',$comment->id)}}">
                        {{csrf_field()}}

                        <input type="text" class="form-control input-sm" name="comment" placeholder="Press enter to update your comment" >

                        {{--<input type="hidden" value="{{Session::token()}}" name="_token">--}}
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>

@endsection
                        <footer class="footer">
                            <div class="container">
                                <p class="text-muted"> Copyright &copy;<?php echo date('Y');?>  LightClick - All rights reserved  </p>
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
