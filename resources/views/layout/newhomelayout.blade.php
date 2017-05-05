<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/favicon.png">
    <title></title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{asset('homeassets/css/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('homeassets/css/timeline.css')}}" rel="stylesheet">
    <link href="{{asset('homeassets/css/cover.css')}}" rel="stylesheet">
    <link href="{{asset('homeassets/css/forms.css')}}" rel="stylesheet">
    <link href="{{asset('homeassets/css/edit_profile.css')}}" rel="stylesheet">
    <link href="{{asset('homeassets/css/buttons.css')}}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular.min.js"></script>
    <script src="{{asset('homeassets/js/custom.js')}}"></script>
    <script src="{{asset('assets/js/app.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    {{--<!--[if lt IE 9]>--}}
    {{--<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>--}}
    {{--<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>--}}
    {{--<![endif]-->--}}
</head>

<body class="animated fadeIn">

<!-- Fixed navbar -->
<nav class="navbar navbar-white navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <ul class="nav navbar-nav ">
                <li class="nav-item">
                    <a class="navbar-brand navbar-link" href="{{route('home')}}"><b><img style="height: 35px;" src="{{asset('assets/images/logo.fw.png')}}"> </b></a>
                </li>
                <li class="nav-item">
                    <form class="navbar-form navbar-left" action="{{route('search')}}" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" id="search-box" placeholder="Find People" name="query">
                        </div>
                        <button type="submit" class="search-btn btn btn-default" id="search"><i class="fa fa-search search"></i></button>
                    </form>
                </li>
            </ul>

        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="actives"><a href="{{route('profile',['first_name' => \Illuminate\Support\Facades\Auth::user()->first_name])}}">
                                        <img height="28px" width="28px" src="/uploads/{{empty(Auth::user()->image) ? "/default.jpg" : Auth::user()->image}}">{{Auth::user()->first_name}}</a>
                </li>
                <li><a href="{{route('home')}}">Home</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        Pages <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="profile2.html">Profile 2</a></li>
                        <li><a href="profile3.html">Profile 3</a></li>
                        <li><a href="profile4.html">Profile 4</a></li>
                        <li><a href="sidebar_profile.html">Sidebar profile</a></li>
                        <li><a href="user_detail.html">User detail</a></li>
                        <li><a href="edit_profile.html">Edit profile</a></li>
                        <li><a href="about.html">About</a></li>
                        <li><a href="friends.html">Friends</a></li>
                        <li><a href="friends2.html">Friends 2</a></li>
                        <li><a href="profile_wall.html">Profile wall</a></li>
                        <li><a href="photos1.html">Photos 1</a></li>
                        <li><a href="photos2.html">Photos 2</a></li>
                        <li><a href="view_photo.html">View photo</a></li>
                        <li><a href="messages1.html">Messages 1</a></li>
                        <li><a href="messages2.html">Messages 2</a></li>
                        <li><a href="group.html">Group</a></li>
                        <li><a href="list_users.html">List users</a></li>
                        <li><a href="file_manager.html">File manager</a></li>
                        <li><a href="people_directory.html">People directory</a></li>
                        <li><a href="list_posts.html">List posts</a></li>
                        <li><a href="grid_posts.html">Grid posts</a></li>
                        <li><a href="forms.html">Forms</a></li>
                        <li><a href="buttons.html">Buttons</a></li>
                        <li><a href="error404.html">Error 404</a></li>
                        <li><a href="error500.html">Error 500</a></li>
                        <li><a href="recover_password.html">Recover password</a></li>
                        <li><a href="registration_mail.html">Registration mail</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
@yield('content')




</body>
</html>