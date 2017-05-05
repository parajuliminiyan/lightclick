<!DOCTYPE html>
<html>
<head>
    <title> You're at LightClick </title>
   <link rel="stylesheet" type="text/css" href="{{asset('assets/css/home.css')}}">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
   <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    {{--<script src="{{asset('assets/js/ajax.js')}}"></script>--}}


</head>
<body>
<div class="pagetop">
    <div class="logo-box"></div>
    <div class="links-panel">
        <a>Get App</a> <a>Terms</a> <a>Privacy Policies</a> <a>Cookies</a> <a>Help Center</a>
    </div>
    <br class="clear" />
<div class="pagemiddle">
    <div class="first-panel">
        @if (Session::has('logout-msg'))

            {!!  Session::get('logout-msg')  !!}
            @else
            <h3 class="sm-text">Hello! Just a short glance</h3>
        @endif


    <div class="banner-picture">
        @if (Session::has('logout-msg'))
            <img src="{{asset('assets/images/logout.png')}}" alt="LightClick" class="img-fluids" style="height: 350px; width: 280px">
        @else
        <img src="{{asset('assets/images/untitled-1.png')}}" alt="LightClick" title="Short look at LightClick features" class="img-fluids" />
            @endif
    </div>
    <div class="links-panel bottom">
        <a class="text-strong">Report A Problem</a> <a>Get App</a> <a>Terms</a> <a>Privacy Policies</a> <a>Cookies</a> <a>FAQs</a> <a>Help Center</a>
    </div>
</div>
    </div>
    <div class="second-panel">
        <div class="login-panel">
            <h2>Sign In to continue.</h2>
            <form  method="post" action="">
                {{csrf_field()}}
                <input type="text" name="email" placeholder="Email" id="username" />
                <input type="password" name="password" placeholder="Password" id="password" />
                <text class="pull-left">Forgot Password?</text> <br />
                <a class="critical pull-left">Recover My Account</a>
                <button class="pull-right" type="submit">Sign In</button>
            </form>
            <div class="login-error" >

                @if (Session::has('msg'))


                    {!! Session::get('msg') !!}


                @endif
            </div>

        <br class="clear" />
        <div class="signup-panel">
            <h2>Don't have an account? Here we help you make it up.</h2>
                            @if (count($errors) > 0)
                               <div class="alert alert-danger">
                                   <ul>
                                       @foreach ($errors->all() as $message)
                                    <li>
                                        {{$message}}
                                    </li>
                                       @endforeach
                                </ul>
                               </div>
            @endif

            <form action="{{route('register')}}" method="post">
                {{csrf_field()}}
                <input type="text" name="first_name" placeholder="First Name" id="f_name" class="small"/>
                <input type="text" name="last_name" placeholder="Last Name" id="l_name" class="small" />
                <input type="email" name="email" placeholder="New Email" id="reg_username"/>
                <input type="password" name="password" placeholder="New Password" id="reg_password"/>
                <select name="gender" id="reg_gender">
                    <option value="" selected name="gender">Select your gender.</option>
                    <option value="1" name="gender">Male</option>
                    <option value="2" name="gender">Female</option>
                </select>
                <span class="form-text">Your Birthday: <input type="date" name="dob" > </span>
                <input type="submit" value="Sign Up" class="pull-right" />
            </form>
        </div>
        <br class="clear" />
        <h5 class="term-hint">By clicking Sign Up button, you proceed to sign you up, accepting our <a class="text-strong">formalities</a>.</h5>
    </div>
    <br class="clear" />
</div>
</div>
<div class="footer">
    <div class="footer-left">
        <ul>
            <li>
                <a href="">Settings and Privacy</a>
            </li>
        </ul>
    </div>
    <div class="footer-mid">
        &copy; LightClick Inc. <?php echo date('Y');?>
    </div>
</div>
</body>
</html>