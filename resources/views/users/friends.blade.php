@extends('layout.newhomelayout')
@section('content')
    <div class="container page-content ">
        <div class="row col-md-22">
    <div class="col-xs-6">
        <h4>Friend  Requests</h4>
        @if(!$requests->count())
            <p>You have no any Friend Requests.</p>
            @else
            @foreach($requests as $user)
                @include('users/userblock')
            @endforeach
        @endif
    </div>
    </div>
    </div>
    </div>
@endsection
    {{--@endsection--}}