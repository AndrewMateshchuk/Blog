@extends('index')
@section('head')
    <script src="js\like.js"></script>
    <script src="js\vote.js"></script>
    <script>
        $(window).scroll(function(){
            if($(window).scrollTop() > $('.main').prop('offsetTop')){
                $('#main_menu').addClass('vertical_menu nav-stacked ');
                $('#main_menu').removeClass('col-lg-offset-4 col-lg-5 col-md-offset-4 col-md-6 col-sm-8 col-sm-offset-2');
                $('#vote').addClass("vote_fixed");

            }else{
                $('#main_menu').addClass('col-lg-offset-4 col-lg-5 col-md-offset-4 col-md-6 col-sm-8 col-sm-offset-2');
                $('#main_menu').removeClass('vertical_menu nav-stacked');
                $('#vote').removeClass("vote_fixed");
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
                    <img @if(isset($name))style="cursor: pointer;" onclick="homeLike({{$note->id}}, this)"@endif src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcT_tx0yH2iTVLbxhfavJrDqeZYesUOCvS6OmkC37ZnmQJ-kU7U9tG1Lads" width="25" height="25"><div style="display: inline;padding-left: 5px">{{$likes[$note->id]}}</div>
                </div>
            </div>
            <hr>
        @endforeach
    </div>
    <div id="vote" class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
            <div id="voted" style="@if(!$isVoted) display:none; @endif"><span style="float: left;padding: 5px;cursor: pointer" onclick="$('#vote').hide()">X</span>
                <div  style="background-color:#7a9dd5;color: white;text-align: center;font-size: medium;padding: 5px;">You are voted</div>
                <ol style="padding: 5px 10px 5px 20px;">
                    <li>Awesome <span class="vote_result_count">({{$votes[0]}})</span>
                <div class="result_frame">
                    <div class="vote_result" style="background-color: #28e215;width: {{($votes[0]/$votes_count)*100}}%"></div>
                </div>
            </li>
                    <li>Nice <span class="vote_result_count">({{$votes[1]}})</span>
                <div class="result_frame">
                    <div class="vote_result" style="background-color: #69ae54;width: {{($votes[1]/$votes_count)*100}}%"></div>
                </div>
            </li>
                    <li>Not bad <span class="vote_result_count">({{$votes[2]}})</span>
                <div class="result_frame">
                    <div class="vote_result" style="background-color: #f2f32c;width: {{($votes[2]/$votes_count)*100}}%"></div>
                </div>
            </li>
                    <li>Normal <span class="vote_result_count">({{$votes[3]}})</span>
                <div class="result_frame">
                    <div class="vote_result" style="background-color: rgba(243, 148, 23, 0.79);width: {{($votes[3]/$votes_count)*100}}%"></div>
                </div>
            </li>
                    <li>Horrible <span class="vote_result_count">({{$votes[4]}})</span>
                <div class="result_frame">
                    <div class="vote_result" style="background-color: #ae000c;width: {{($votes[4]/$votes_count)*100}}%"></div>
                </div>
            </li>
        </ol>
    </div>
        <div id="not_voted" style="@if($isVoted) display:none @endif">
            <div style="background-color: #7a9dd5;color: white;text-align: center;font-size: medium;padding-left: 5px;">Mark the site</div>
            <ol>
                <li><input type="radio" name="mark" checked value="1"> Awesome</li>
                <li><input type="radio" name="mark" value="2"> Nice</li>
                <li><input type="radio" name="mark" value="3"> Not bad</li>
                <li><input type="radio" name="mark" value="4"> Normal</li>
                <li><input type="radio" name="mark" value="5"> Horrible</li>
            </ol>
            <div onclick="vote()" style="background-color: rgba(204, 7, 0, 0.68);color: white;text-align:center;margin-left: 20px;margin-right: 20px;margin-bottom: 10px;cursor: pointer;">Проголосовать</div>
        </div>
    <div style="background-color: rgba(105, 105, 105, 0.74);color: white;text-align: center;font-size: medium;padding: 5px">Votes : <span id="votes_count">{{$votes_count}}</span></div>
    </div>
    <img id="btn_up" src="https://maxcdn.icons8.com/Share/icon/Arrows//up_arrow1600.png" style="position: fixed;right: 50px;bottom: 15%;z-index: 1;display: none;" height="40" width="40" onclick="up()">
    <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: center;z-index: 0">
        {{ $notes->links() }}
    </div>
@stop