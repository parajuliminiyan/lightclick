@extends('layout.newhomelayout')
@section('content')
    <!-- Begin page content -->
    <div class="container page-content edit-profile">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <!-- NAV TABS -->
                <ul class="nav nav-tabs nav-tabs-custom-colored tabs-iconized">
                    <li class="active"><a href="#profile-tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-user"></i> Profile</a></li>
                    <li class=""><a href="#activity-tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-rss"></i> Recent Activity</a></li>
                    <li class=""><a href="#settings-tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-gear"></i> Settings</a></li>
                </ul>
                <!-- END NAV TABS -->
                <div class="tab-content profile-page">
                    <!-- PROFILE TAB CONTENT -->
                    <div class="tab-pane profile active" id="profile-tab">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="user-info-left">
                                    <img style="height: 200px; width: 200px;" src="/uploads/{{empty($user->image) ? "/default.jpg" : $user->image}}" alt="Profile Picture">
                                    <h2>{{$user->first_name.' '. $user->last_name}}</h2>
                                    <div class="contact">
                                            <form action="{{route('editaccount', $user->id)}}" method="post" enctype="multipart/form-data">
                                                <p><span class="file-input btn btn-azure btn-file">
                          Change Profile Pic <input type="file" multiple="" name="image">
                        </span></p>
                        <p><span class="file-input btn btn-azure btn-file">
                          Change Cover <input type="file" multiple="" name="cover-pic">
                        </span></p>
                                            <button type="submit" class="btn btn-primary">Save Account</button>
                                            <input type="hidden" value="{{ Session::token() }}" name="_token"></form>
                                        </p>
                                        <ul class="list-inline social">
                                            <li><a href="#" title="Facebook"><i class="fa fa-facebook-square"></i></a></li>
                                            <li><a href="#" title="Twitter"><i class="fa fa-twitter-square"></i></a></li>
                                            <li><a href="#" title="Google Plus"><i class="fa fa-google-plus-square"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="user-info-right">
                                    <div class="basic-info">
                                        <h3><i class="fa fa-square"></i> Basic Information</h3>
                                        <p class="data-row">
                                            <span class="data-name">Name</span>
                                            <span class="data-value">{{$user->first_name.' '. $user->last_name}}</span>
                                        </p>
                                        <p class="data-row">
                                            <span class="data-name">Birth Date</span>
                                            <span class="data-value">{{$user->dob}}</span>
                                        </p>
                                        <p class="data-row">
                                            <span class="data-name">Gender</span>
                                            <span class="data-value">@if($user->gender == 1) Male @elseif($user->gender == 2) Female @else @endif</span>
                                        </p>
                                        <p class="data-row">
                                            <span class="data-name">Website</span>
                                            <span class="data-value"><a href="#"></a></span>
                                        </p>
                                        <p class="data-row">
                                            <span class="data-name">Last Login</span>
                                            <span class="data-value"></span>
                                        </p>
                                        <p class="data-row">
                                            <span class="data-name">Date Joined</span>
                                            <span class="data-value">{{$user->created_at->diffForHumans()}}</span>
                                        </p>
                                    </div>
                                    <div class="contact_info">
                                        <h3><i class="fa fa-square"></i> Contact Information</h3>
                                        <p class="data-row">
                                            <span class="data-name">Email</span>
                                            <span class="data-value">{{$user->email}}</span>
                                        </p>
                                        <p class="data-row">
                                            <span class="data-name">Phone</span>
                                            <span class="data-value">{{$user->phone}}</span>
                                        </p>
                                        <p class="data-row">
                                            <span class="data-name">Address</span>
                                            <span class="data-value">{{$user->address}}</span>
                                        </p>
                                    </div>
                                    <div class="about">
                                        <h3><i class="fa fa-square"></i> About Me</h3>
                                        <p>{{$user->about_me}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END PROFILE TAB CONTENT -->


                    <!-- SETTINGS TAB CONTENT -->
                    <div class="tab-pane settings" id="settings-tab">
                        <form class="form-horizontal" role="form">
                            <fieldset>
                                <h3><i class="fa fa-square"></i> Change Details</h3>
                                <div class="form-group">
                                    <label for="old-password" class="col-sm-3 control-label">Old Password</label>
                                    <div class="col-sm-4">
                                        <input type="password" id="old-password" name="old-password" class="form-control">
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="password" class="col-sm-3 control-label">New Password</label>
                                    <div class="col-sm-4">
                                        <input type="password" id="password" name="password" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password2" class="col-sm-3 control-label">Repeat Password</label>
                                    <div class="col-sm-4">
                                        <input type="password" id="password2" name="password2" class="form-control">
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                    <label for="old-password" class="col-sm-3 control-label">First Name</label>
                                    <div class="col-sm-4">
                                        <input type="password" id="old-password" name="old-password" class="form-control">
                                    </div>
                                </div>
                                <hr>
                              </fieldset>

                            <fieldset>
                                <h3><i class="fa fa-square"></i> Privacy</h3>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="colored-blue" checked="checked">
                                        <span class="text">Show my display name</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="colored-blue" checked="checked">
                                        <span class="text">Show my birth date</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="colored-blue" checked="checked">
                                        <span class="text">Show my email</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="colored-blue" checked="checked">
                                        <span class="text">Show my online status on chat</span>
                                    </label>
                                </div>
                            </fieldset>
                            <h3><i class="fa fa-square"> </i>Notifications</h3>
                            <fieldset>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="colored-blue" checked="checked">
                                        <span class="text">Receive message from administrator</span>
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="colored-blue" checked="checked">
                                        <span class="text">New product has been added</span>
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="colored-blue" checked="checked">
                                        <span class="text">Product review has been approved</span>
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="colored-blue" checked="checked">
                                        <span class="text">Others liked your post</span>
                                    </label>
                                </div>
                            </fieldset>
                        </form>
                        <p class="text-center"><a href="#" class="btn btn-custom-primary"><i class="fa fa-floppy-o"></i> Save Changes</a></p>
                    </div>
                    <!-- END SETTINGS TAB CONTENT -->
                </div>
            </div>
        </div>
    </div>
@endsection
    <footer class="footer">
        <div class="container">
            <p class="text-muted"> Copyright &copy; LightClick - All rights reserved </p>
        </div>
    </footer>
    {{--<script type="text/javascript">--}}
        {{--(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){--}}
                    {{--(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),--}}
                {{--m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)--}}
        {{--})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');--}}

        {{--ga('create', 'UA-49755460-1', 'auto', {'allowLinker': true});--}}
        {{--ga('require', 'linker');--}}
        {{--ga('linker:autoLink', ['bootdey.com','www.bootdey.com','demos.bootdey.com'] );--}}
        {{--ga('send', 'pageview');--}}
    {{--</script>--}}
