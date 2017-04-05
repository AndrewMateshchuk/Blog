@extends('index')
@section('head')
    <script src="/../public/js/comment.js"></script>
    <script src="/../public/js/like.js"></script>
    <script>
        $(window).scroll(function(){
            if($(window).scrollTop() > $('.main').prop('offsetTop')){
                $('#main_menu').addClass('vertical_menu nav-stacked ');
                $('#main_menu').removeClass('col-lg-offset-4 col-lg-5 col-md-offset-4 col-md-6 col-sm-8 col-sm-offset-2');
            }else{
                $('#main_menu').addClass('col-lg-offset-4 col-lg-5 col-md-offset-4 col-md-6 col-sm-8 col-sm-offset-2');
                $('#main_menu').removeClass('vertical_menu nav-stacked');
            }
        });
        var note_id = "{{$note->id}}";
        var isSign = 0;
        @if(isset($name))
            isSign = 1;
        @endif
    </script>
@stop
@section('content')
    <div class="notes col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
        <div class="note_date">{{$note->created_at}}
            @if(isset($user_id))
                @if($note->user_id === $user_id)
                    <span><a href="/../public/fixNote/{{$note->id}}"><img src="http://s1.iconbird.com/ico/2013/10/464/w512h5121380984696edit.png" width="30" height="30"></a></span>
                @endif
            @endif
        </div>
            <div class="note_title"><h3>{{$note->title}}</h3></div>
            <div class="single_note">{!!$note->text!!}</div>
            <div class="col-sm-offset-4 col-sm-4" style="text-align: center; padding-top: 10px;padding-bottom: 10px;">Автор <a href="/public/user/{{$note['user_id']}}">{{$author}}</a></div>
            <div id="like" style="float: right;"><img type="button" @if(isset($name))onclick="like()"@endif id="like_btn" src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcT_tx0yH2iTVLbxhfavJrDqeZYesUOCvS6OmkC37ZnmQJ-kU7U9tG1Lads" width="30" height="30"><div id="like_count">{{$likes_count}}</div></div>
    </div>
    <div class="comments col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-2">
        <div class="comments_title">
            <h4>Комментарии ({{$comments_count}})</h4>
       </div>
        <div class="comments_add">

        </div>
        <div class="col-sm-offset-2 col-sm-8">
            <btn id="get_comment_btn" type="button" class="btn btn-primary btn-lg btn-block" style="margin-top: 10px;display: none" onclick="download_comments()">Загрузить еще</btn>
        </div>
    </div>
    @if(isset($name))
        <div class="type_zone col-xs-10 col-sm-10 col-md-8 col-md-offset-3 col-lg-8 col-lg-offset-3">
            <div class="col-lg-offset-1 col-lg-10 col-md-10 col-md-offset-1 col-sm-7 col-sm-offset-3 col-xs-12">
                <textarea class="col-sm-10 col-md-8 col-lg-8 col-xs-10" id="type_message" rows="3" placeholder="Your message" maxlength="1000"></textarea>
            <span onclick="add_comment()">
                <img id="send_message" src="https://maxcdn.icons8.com/Share/icon/win10/Messaging//send1600.png" height="50px" width="50px">
            </span>
            </div>
        </div>
    @else
        <div id="stop_message" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h3>Enter, to add comment</h3>
        </div>
    @endif
    <img id="btn_up" src="https://maxcdn.icons8.com/Share/icon/Arrows//up_arrow1600.png" style="position: fixed;right: 20px;bottom: 15%;z-index: 1;display: none;" height="40" width="40" onclick="up()">
@stop