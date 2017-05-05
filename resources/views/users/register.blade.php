@extends('layout.admin')
@section('content')
    <div class="row">
        <form action="{{route('register')}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
                <label for="exampleInputEmail1">FirstName</label>
                <input type="text" class="form-control" name="first_name" placeholder="First Name"  >
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">LastName</label>
                <input type="TEXT" class="form-control" name="last_name" placeholder="Last Name">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Email">
            </div><div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Address</label>
                <input type="text" class="form-control" name="address" placeholder="Address">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Phone</label>
                <input type="text" class="form-control" name="phone" placeholder="Phone">

            </div><div class="form-group">
                <label for="exampleInputPassword1">Image</label>
                <input type="file" class="form-control" name="image" placeholder="Phone">

            </div>

            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>


@stop