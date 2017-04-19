$(document).ready(function(){
    get_comments();
});
var first = 0;

function add_comment(){
    var text = $("#type_message").val();
    if (text !== "") {
        $("#type_message").val("");
        document.getElementById("send_message").disabled = true;
        $.post(
            "/public/note/add_comment",
            {
                text: text,
                note_id: module.getNoteId(),

            },
            function (data) {
                window.location.reload();
                document.getElementById("send_message").disabled = false;
            }
        ).fail(function () {
                alert("Server error");
                $("#type_message").val(message);
            });
    }
}

function get_comments(){
        $.post({
            url : "/public/note/getComments",
            data :
            {
                note_id:module.getNoteId()
            },
            success : function(data){
                var res = $.parseJSON(data);
                if(res[0] != "") {
                    first = res[0][res[0].length - 1]["id"];
                    for(var i = res[0].length - 1; i > -1; i--) {
                        $(".comments_add").prepend(
                           "<div class='comment' id='"+res[0][i]['id']+"' onclick='ShowAnswer(this)'><div class='comment_header'><span class='commentator_name'>"+res[0][i]['name']+"</span><span class='comment_date'>"+res[0][i]['created_at']+"</span></div><div class='comment_text'>"+res[0][i]['text']+"</div></div>"
                        );
                    }
                    if(res[0].length == 10){
                        $("#get_comment_btn").show();
                    }else{
                        $("#get_comment_btn").hide();
                    }
                    if(res[1].length != 0){
                        for(var i = 0; i < res[1].length; i++) {
                            $("#"+res[1][i]['sub_id']).after(
                                "<div class='sub_comment' id='"+res[1][i]['id']+"'><div class='comment_header'><span class='commentator_name'>"+res[1][i]['name']+"</span><span class='comment_date'>"+res[1][i]['created_at']+"</span></div><div class='comment_text'>"+res[1][i]['text']+"</div></div>"
                            );
                        }
                    }
                }else{
                    $("#get_comment_btn").hide();
                }
            },
            error : function(){
                window.location.reload();
            },
            datatype : "json"
        });
}

function download_comments(){
    $.post({
        url : "/public/note/downloadComments",
        data :
        {
            note_id:module.getNoteId(),
            first:first
        },
        success : function(data){
            var res = $.parseJSON(data);
            console.log(res);
            if(res[0] != "") {
                first = res[0][res[0].length - 1]["id"];
                for(var i = 0; i < res[0].length; i++) {
                    $(".comments_add").append(
                        "<div class='comment' id='"+res[0][i]['id']+"' onclick='ShowAnswer(this)'><div class='comment_header'><span class='commentator_name'>"+res[0][i]['name']+"</span><span class='comment_date'>"+res[0][i]['created_at']+"</span></div><div class='comment_text'>"+res[0][i]['text']+"</div></div>"
                    );
                }
                if(res[0].length == 10){
                    $("#get_comment_btn").show();
                }else{
                    $("#get_comment_btn").hide();
                }
                if(res[1].length != 0){
                    for(var i = 0; i < res[1].length; i++) {
                        $("#"+res[1][i]['sub_id']).after(
                            "<div class='sub_comment' id='"+res[1][i]['id']+"'><div class='comment_header'><span class='commentator_name'>"+res[1][i]['name']+"</span><span class='comment_date'>"+res[1][i]['created_at']+"</span></div><div class='comment_text'>"+res[1][i]['text']+"</div></div>"
                        );
                    }
                }
            }else{
                $("#get_comment_btn").hide();
            }
        },
        error : function(){
            alert("Server error");
        },
        datatype : "json"
    });
}

function ShowAnswer(id){
    if(module.isSign()){
        $('.answer').remove();
        id = $(id).attr('id');
        $("#"+id).after("<div class='type_zone answer'><textarea class='col-lg-offset-2 col-lg-8 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-1' id='type_answer' rows='3' placeholder='Your answer' maxlength='1000'></textarea><span onclick='answer("+id+")'><img id='send_answer' src='https://maxcdn.icons8.com/Share/icon/win10/Messaging//send1600.png' height='50px' width='50px'></span></div>");
    }
}

function answer(id){
    var message = $("#type_answer").val();
    if (message !== "") {
        $("#type_answer").val("");
        document.getElementById("send_answer").disabled = true;
        $.post(
            "/public/note/add_answer",
            {
                text: message,
                sub_id:id,
                note_id : module.getNoteId()
            },
            function (data) {
                document.getElementById("send_answer").disabled = false;
                window.location.reload();
            }
        ).fail(function () {
                alert("Server error");
                $("#type_answer").val(message);
            });
    }
}