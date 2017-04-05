var last = 0;
var first;
$(document).ready(function(){
    update();
    setTimeout(down, 1000);
});

function update(){
    $.ajax({
        url : "/public/chat/update",
        type : "POST",
        data : "last="+last,
        success : function(data){
            var res = $.parseJSON(data);
            if(res != "") {
                last = res[0]["id"];
                if(first == null){
                    first = res[res.length - 1]["id"];
                }
                for(var i = res.length - 1; i > -1; i--) {
                    $(".chat > div").append(
                        "<div><div><pre><span class='message_login'><b>" + res[i]['name'] + "     " + "</b></span><span class='message_date'>" + res[i]["created_at"] + "</span></pre></div><div class='message_text col-sm-offset-1'>" + res[i]["message"] + "</div></div>"
                    );
                }
            }
          setTimeout(update, 400);
        },
        error : function(){
          setTimeout(update, 400);
        },
        datatype : "json"
    });
}

function send(){
    var message = $("#type_message").val();
    if (message !== "") {
        $("#type_message").val("");
        document.getElementById("send_message").disabled = true;
        $.post(
            "/public/chat/new",
            {
                message: message
            },
            function (data) {
               /* var res = $.parseJSON(data);
                console.log(res);
                if(res == "login_error"){
                    alert("Try to login");
                    $("#type_message").val(message);
                }*/
                document.getElementById("send_message").disabled = false;
                down();
            }
        ).fail(function () {
                alert("Server error");
                $("#type_message").val(message);
            });
    }
}

function down() {
    $('.chat').animate({scrollTop:$(".chat div")[0].scrollHeight},500);
}

function load_messages(){
    var Height = $(".chat")[0].scrollHeight;
    $.ajax({
        url : "/public/chat/load",
        type : "POST",
        data : "first="+first,
        success : function(data){
            var res = jQuery.parseJSON(data);
            if(res != "") {
                first = res[res.length - 1]["id"];
                for(var i = 0; i < res.length - 1;i++) {
                    $(".chat > div").prepend(
                        "<div><div><pre><span class='message_login'><b>" + res[i]['name'] +"     "+ "</b></span><span class='message_date'>" + res[i]["created_at"] + "</span></pre></div><div class='message_text'>" + res[i]["message"] + "</div></div>"
                    );
                }
                $('.chat').scrollTop($(".chat div")[0].scrollHeight-Height);
            }else{
                $(".old-note").show();
            }
        },
        datatype : "json"
    });
}

function scrollLoad(){
    if($(".chat").scrollTop() == 0) load_messages();
}