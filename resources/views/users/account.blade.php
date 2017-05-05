@extends('layout.homelayout')
@section('content')
    <section class="row new-post">
        <div class="col-md-6 col-md-offset-3">

                @if (Session::has('message'))

                    {!!  Session::get('message')  !!}
                @endif

            <header><h3>Your Account</h3>
                <div class="col-lg-2"> <img src="/uploads/{{empty($user->image) ? "/default.jpg" : $user->image}}" style="width:150px; height: 150px; border-radius: 50%; margin-right: 25px;" ></div>
                <div class="col-lg-4 col-lg-offset-4">
                    <form action="" method="" enctype="multipart/form-data">
                            <input type="file" name="image" class="form-control" >

                        <button type="submit" class="btn btn-primary">Change </button>
                        <input type="hidden" value="{{ Session::token() }}" name="_token">
                    </form>
                </div>
            </header>
            <form action="{{route('editaccount', $user->id)}}" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}" id="first_name">
                </div><div class="form-group">
                    <label for="first_name">last Name</label>
                    <input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}" id="first_name">
                </div>
                <div class="form-group">
                    <label for="first_name">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" id="first_name">
                </div>
                <div class="form-group">
                    <label for="first_name">Address</label>
                    <input type="text" name="address" class="form-control" value="{{ $user->address }}" id="first_name">
                </div><div class="form-group">
                    <label for="first_name">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ $user->phone }}" id="first_name">
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" class="form-control" >
                </div>
                <button type="submit" class="btn btn-primary">Save Account</button>
                <input type="hidden" value="{{ Session::token() }}" name="_token">
            </form>
        </div>
    </section>
    <div class="container">
        <div class="row">




        </div>
    </div>

    @endsection