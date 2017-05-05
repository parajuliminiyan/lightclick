@extends('layout.homelayout')
@section('content')

    <div class="container">

        <div class="sidebar-left"></div>
        <div class="central-content" style=" width: 40%; min-width: 425px">
            <div class="post-div">Hello <b>{{ Auth::user()->first_name }}</b>, we thought you'd like to post an update.
                <form class="form" method="POST" enctype="multipart/form-data" action="{{route('post')}}" >
                    {{csrf_field()}}
                    <textarea placeholder="What would you like to share?" name="body" ></textarea>
                    <div class="tab">
                        <i class="fa fa-cloud-upload" id="file-upload"></i>
                    </div>
                    <div class="tab">
                        <i class="fa fa-flag" id="set-location"></i>
                    </div>
                    <div class="tab">
                        <i class="fa fa-tags" id="set-tag"></i>
                    </div>
                    <div class="tab">
                        <i class="fa fa-smile-o" id="set-feeling"></i>
                    </div>
                    <div class="tab">
                        <i class="fa fa-lock" id="set-privacy"></i>
                    </div>
                    <div class="clear">

                    </div>
                    <div class="post-details pull-left">
                        <div class=" file" id="file-upload-div" >
                            <input type="file" name="image">
                        </div>
                        <div class=" locaion" id="location-div">
                            <input type="text" placeholder="Set Location" name="location" />
                        </div>
                        <div class = "tag-friends" id="tag-div">
                            <input type="text" name="tag" placeholder="Tag Friends" />
                        </div>
                        <div class=" feelings" id="feeling-div">
                            <input type="text" placeholder="How are you feeling?" />
                        </div>
                        <div class="privacy" id="privacy-div">
                            <select class="small">
                                <option value="1">Public</option>
                                <option value="2">Friends</option>
                                <option value="3">Only Me</option>
                            </select>

                        </div>

                    </div>
                    <div class="pull-right" style="height:50px;">
                        <button value="Post" class="pull-right" type="submit">Post</button>
                    </div>
                    <input type="hidden" value="{{Session::token()}}" name="_token">
                </form>
                <div> @if (Session::has('message'))

                        {!! Session::get('message')  !!}


                    @endif</div>
            </div>
            </div>

        </div>


<section class="row posts">
    <div class="col-md-6 col-md-offset-3">
        <header><h3>Your Feeds...</h3></header>
        @if(!$posts->count())
            <p>There is nothing on your feeds!!</p>
        @else
            @foreach($posts as $post)
                <article class="post" data-postid="{{ $post->id }}">
                    <table border="0">
                        <tr>
                            <td><img src=" /uploads/{{empty($post->user->image) ? "/default.jpg" : $post->user->image}}" style="height: 55px; width: 55px; border-radius: 10%;">
                                &nbsp;<a href="{{route("profile",['first_name' => $post->user->first_name])}}">
                                    <b><u>{{$post->user['first_name']." ".$post->user['last_name']}}</u></b></a></td>
                        </tr>
                        <tr><td colspan="2">@if(($post->image))
                                    {{$post->caption}}
                            </td></tr>
                        <tr>
                            <td><img src="/post-photos/{{$post->image}}" style="height: 250px; width: 250px; ">
                                <ul class="list-inline">
                                    <li>{{$post->created_at->diffForHumans()}}</li>
                                </ul>
                            </td>
                        </tr>

                        @else
                            {{$post->body}}
                            <ul class="list-inline">
                                <li>{{$post->created_at->diffForHumans()}}</li>
                            </ul>
                        @endif
                    </table>
                    &nbsp;&nbsp;&nbsp;
                    <table border="0">
                        <tr><td><div class="interaction">
                                    <ul class="list-inline">
                                        <li><a href="{{route('postlike',["postId" =>$post->id])}}">Like</a></li>
                                        <li>{{$post->likes->count()}} {{str_plural('likes',$post->likes->count())}}</li>
                                    </ul>



                                    @if(Auth::user() == $post->user )
                                        |
                                        <a href="#" class="edit-btn">Edit</a>
                                        <a href="{{route('postDelete',$post->id)}}" name="post_delete">Delete</a>
                                    @endif
                                </div></td></tr>


                    </table>
                    <div class="info">
                        <i class="divider" role="separator">

                        </i></div>


                    <table border="0" style="width: 100%">
                        <div class="comment">
                            <label>Comments</label><hr style="border: 0;
    height: 1px;
    background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));">
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
                                    <td>{{$comment->body}}<hr></td>
                                </tr>

                            @endforeach
                        </div>
                    </table>
                    <table border="0px" style="width: 100%">
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

                    </table>
                </article>
        @endforeach
        @endif
    </div>
</section>

<div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Post</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="post-body">Edit the Post</label>
                        <textarea name="post-body" id="post-body" class="form-control" rows="5"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
    <script>
        var token = '{{Session::token()}}';
        var urlEdit = '{{route('edit')}}';
        {{--var urlLike = '{{route('like')}}';--}}
    </script>
@stop




