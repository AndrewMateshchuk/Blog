@extends('index')
@section('head')
    <script src="js/mjs.js"></script>
@stop
@section('content')
    <span onclick="down();">
        <img id="down_btn" src="http://img.freepik.com/free-icon/down-arrow_318-140021.jpg?size=338c&ext=jpg" width="40px" height="40px">
    </span>
    <div class="chat col-sm-6 col-sm-offset-3 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3" onscroll="scrollLoad();">
        <h3 class="old-note">There are no oldest messages</h3>
        <div></div>
    </div>
    @if(isset($name))
    <div class="type_zone col-xs-12 col-sm-12 col-md-8 col-md-offset-3 col-lg-8 col-lg-offset-3">
            <div class="col-lg-offset-1 col-lg-10 col-md-10 col-md-offset-1 col-sm-7 col-sm-offset-3 col-xs-12">
                <textarea class="col-sm-10 col-md-8 col-lg-8 col-xs-10" id="type_message" rows="3" placeholder="Your message" maxlength="1000"></textarea>
            <span onclick="send()">
                <img id="send_message" src="https://maxcdn.icons8.com/Share/icon/win10/Messaging//send1600.png" height="50px" width="50px">
            </span>
            </div>
    </div>
    @else
        <div id="stop_message" class="col-sm-12">
            <h3>Enter, to send message</h3>
        </div>
    @endif
@stop
