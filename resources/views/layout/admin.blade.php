<html>
<head>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.1.0.js" integrity="sha256-slogkvB1K3VOkzAI8QITxV3VzpOnkeNVsKvtkYLMjfk=" crossorigin="anonymous"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">

            <a class="navbar-brand" href="#">
                <img alt="Brand" src="{{asset('assets\logo.png')}}"style="height: 40px; margin-top: -10px" >
            </a>
        </div>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#" id="signin-btn">SignIn</a></li>
                <li><a href="{{route('signup')}}">SignUp</a></li>

            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title">Login</h5>
            </div>

            <div class="modal-body">
                <!-- The form is placed inside the body of modal -->
                <form id="loginForm" method="post" class="form-horizontal">
                    <button style="display: none; width: 0px; height: 0px;" class="fv-hidden-submit" type="submit"></button>
                    {{csrf_field()}}

                    <div class="form-group" id="form">
                        <label class="col-xs-3 control-label">Email</label>
                        <div class="col-xs-5">
                            <span class="danger">{{$errors->first('email')}}</span>
                            <input type="email" class="form-control email" name="email" />
                            <i data-fv-icon-for="username" class="form-control-feedback" style="display: none;"></i>
                            <small data-fv-result="NOT_VALIDATED" data-fv-for="username" data-fv-validator="notEmpty" class="help-block" style="display: none;">The username is required</small>
                            <div class="message"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-3 control-label">Password</label>
                        <div class="col-xs-5">
                            <span class="danger"> </span>
                            <input type="password" class="form-control password " name="password" />
                            <i data-fv-icon-for="password" class="form-control-feedback" style="display: none;"></i>
                            <small data-fv-result="NOT_VALIDATED" data-fv-for="password" data-fv-validator="notEmpty" class="help-block" style="display: none;">The password is required</small>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-5 col-xs-offset-3">
                            <button type="submit" class="btn btn-primary login">Login</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div><script src="{{asset('assets/js/index.js')}}"></script>
<div class="container">
@yield('content')
</div>
</body>
</html>