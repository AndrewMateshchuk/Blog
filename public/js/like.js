function up(){
    $('body').animate({scrollTop:0},500);
}

$(window).scroll(
    function(){
        if($(window).scrollTop() > 500){
            $('#btn_up').show();
        }else{
            $('#btn_up').hide();
        }
    }
);

function like(){
    $('#like_btn').attr('onclick',"return false;");
    $.post(
        "/public/note/like",
        {
            note_id:note_id,
        },
        function (data) {
            $('#like_count').text(data);
            $('#like_btn').attr('onclick',"like()");
        }
    ).fail(function () {
            alert("Server error");
            $('#like_btn').attr('onclick',"like()");
        });
}
