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
function homeLike(noteId, obj) {
    $(obj).attr('onclick',"return false;");
    $.post(
        "/public/note/like",
        {
            note_id:noteId,
        },
        function (data) {
            $(obj).next().text(data);
            $(obj).attr('onclick',"homeLike("+noteId+",this)");
        }
    ).fail(function () {
        alert("Server error");
        $(obj).attr('onclick',"homeLike("+noteId+",this)");
    });
}
function like(){
    $('#like_btn').attr('onclick',"return false;");
    $.post(
        "/public/note/like",
        {
            note_id:module.getNoteId(),
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
