@extends('index')
@section('content')
    <div class="col-lg-8 col-lg-offset-2  col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1" style="height: 75vh; margin-top: 2%;">
        <div class="row" style="border-bottom: 1px solid rgba(203, 178, 183, 0.3);padding-bottom: 15px">
            @if($image)
                <div class="col-sm-6">
                <img id="user_image" src="/../public/images/{{$id}}.jpeg">
                </div>
            @endif
                <div class="col-sm-6">
                    <h4>Name: {{$author_name}}</h4>
                    <h4>Email: {{$email}}</h4>
                    <h4>Registered at: {{$date}}</h4>
                </div>
        </div>
        <div class="col-sm-12">
            <h3>Notations({{count($notes['id'])}})</h3>
             @if({{count($notes['id']) == 0}})
             <h4>You have no notations, but you can fix it)</h4>
             @endif
            <ul>
                @for($i = 0; $i < count($notes['id']); $i++)
                    <li style="padding-bottom: 5px;"><a href="/public/note/{{$notes['id'][$i]}}">{{$notes['title'][$i]}}</a></li>
                @endfor
            </ul>
        </div>
    </div>
@stop