
<div class="media">
    <a class="pull-left" href="{{route("profile",['first_name' => $user->first_name])}}">
        {{--<img class="media-object" alt="" src="">--}}
        <img class="media-object" alt="" src="/uploads/{{empty($user->image) ? "/default.jpg" : $user->image}}" style="width:150px; height: 150px; border-radius: 50%; margin-right: 25px;" >
    </a>
    <div class="media-body">
        <h4 class="media-heading"><a href="{{route("profile",['first_name' => $user->first_name])}}">{{$user->first_name." ". $user->last_name}}</a></h4>
        @if($user->address)
            <p>{{$user->address}}</p>
            @endif
    </div>

</div>