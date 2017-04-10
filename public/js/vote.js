function vote() {
    $('#vote').animate({height:"toggle"},500);
    $('#not_voted').hide();
    $.post({
        url : "/public/home/vote",
        data : "vote="+$("input:radio:checked").val(),
        success : function(data){
            var res = $.parseJSON(data);
            if(res != 'Fail'){
                for(var i = 0; i < 5; i++) {
                   $('.vote_result_count:eq('+i+')').html(res['votes'][i]);
                   $('.vote_result:eq('+i+')').width(((res['votes'][i]/res['count'])*100)+"%");
                   $('#votes_count').html(res['count']);
                }
            }
            $('#voted').show();
            $('#vote').animate({height:"toggle"},500);
        },
        error: function(){
            $('#vote').animate({height:"toggle"},500);
        }
        ,
        datatype : "json"
    });
}