@extends('index')
@section('head')
    <script src="js\like.js"></script>
    <script>
        $(window).scroll(function(){
            if($(window).scrollTop() > $('.main').prop('offsetTop')){
                $('#main_menu').addClass('vertical_menu nav-stacked ');
                $('#main_menu').removeClass('col-lg-offset-4 col-lg-4 col-md-offset-4 col-md-5 col-sm-6 col-sm-offset-3');
            }else{
                $('#main_menu').addClass('col-lg-offset-4 col-lg-4 col-md-offset-4 col-md-5 col-sm-6 col-sm-offset-3');
                $('#main_menu').removeClass('vertical_menu nav-stacked');
            }
        });
    </script>
@stop
@section('content')
    <div class="notes col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-2">
        @foreach($notes as $note)
            <div class="note_date">{{$note->created_at}}
                @if(isset($user_id))
                    @if($note->user_id === $user_id)
                        <span><a href="fixNote/{{$note->id}}"><img src="http://s1.iconbird.com/ico/2013/10/464/w512h5121380984696edit.png" width="30" height="30"></a></span>
                    @endif
                @endif
            </div>
            <div class="note_title"><h3><a  href="note/{{$note->id}}">{{$note->title}}</a></h3></div>
            <div class="note">{!!$note->text!!}</div>
            <div class="note_link">
                <a href="note/{{$note->id}}">Читать дальше</a>
                <div class="like" style="float: right;">
                    <img src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcT_tx0yH2iTVLbxhfavJrDqeZYesUOCvS6OmkC37ZnmQJ-kU7U9tG1Lads" width="25" height="25"><div style="display: inline;padding-left: 5px">{{$likes[$note->id]}}</div>
                </div>
            </div>
            <hr>
        @endforeach
    </div>
    <img id="btn_up" src="https://maxcdn.icons8.com/Share/icon/Arrows//up_arrow1600.png" style="position: fixed;right: 20px;bottom: 15%;z-index: 1;display: none;" height="40" width="40" onclick="up()">
    <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: center;z-index: 0">
        {{ $notes->links() }}
    </div>
@stop