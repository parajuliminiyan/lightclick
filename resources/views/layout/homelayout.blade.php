<html>
<head>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('assets\css\main.css')}}">
    <link rel="stylesheet" href="{{asset('assets\css\home.css')}}">
    <link rel="stylesheet" href="{{asset('assets\css\style.css')}}">
    <link rel="stylesheet" href="{{asset('assets\comment-js\comment-css.css')}}">
    <script src="{{asset('assets\js\app.js')}}"></script>
    <script src="{{asset('assets\js\ajax.js')}}"></script>
    <script src="{{asset('assets\comment-js\src\recorder.js')}}"></script>
    <script src="{{asset('assets\comment-js\src\Fr.voice.js')}}"></script>
    <script src="{{asset('assets\comment-js\js/jquery.js')}}"></script>
    <script src="{{asset('assets\comment-js\js/app.js')}}"></script>

</head>
<body style="background-color: #e9ebee;">
@if( Auth::check())
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">

            <a class="navbar-brand" href="#">
                <img alt="Brand" src="{{asset('assets\logo.png')}}"style="height: 40px; margin-top: -10px" >
            </a>
            <ul  class="nav navbar-nav ">
                <li class="nav-item ">
                    <a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('friends')}}" >Friends</a>
                </li>
                <form class="navbar-form navbar-left" action="{{route('search')}}" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Find People" name="query">
                    </div>
                    <button type="submit" class="btn btn-default"><i class="fa fa-search search"></i></button>
                </form>

            </ul>

        </div>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="position:relative; padding-left: 60px; ">
                    <img src="/uploads/{{empty(Auth::user()->image) ? "/default.jpg" : \Illuminate\Support\Facades\Auth::user()->image}}" style="width: 40px; height: 40px; position: absolute; top: 5px; left:10px; border-radius: 50%;">
                    {{ Auth::user()->first_name }} <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li class="nav-item">
                        <a class="fa fa-user" href="{{route('profile',['first_name' => \Illuminate\Support\Facades\Auth::user()->first_name])}}" >Account</a>
                    </li>
                    <li role="separator" class="divider"></li>
                    <li class="nav-item">
                        <a class="fa fa-sign-out" href="{{route('logout')}}" >Logout</a>
                    </li>
                </ul>
            </li>


        </ul>
    </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
@endif

@yield('content')
</body>
</html>