$(document).ready(function(){
    active();
});
function add_image(image){
    if(image.files && image.files[0]){
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#upload_img').attr('src', e.target.result);
        };
        reader.readAsDataURL(image.files[0]);
    }
}
function check_reg_pass(){
        $('#reg_login').val($('#reg_login').val().replace(/([^A-Za-z0-9-_])+/,""));
        $('#reg_email').val($('#reg_email').val().replace(/([^A-Za-z0-9@.-_])+/,""));
        $('#reg_password').val($('#reg_password').val().replace(/([^A-Za-z0-9-_])+/,""));
        if($('#reg_password').val() != $('#repeat_password').val()){
            $('#repeat_password_group').addClass('has-error');
            $('#reg_form button').prop("disabled", true);
        }else{
            $('#repeat_password_group').removeClass('has-error');
            $('#reg_form button').prop("disabled", false);
        }
}

function valid_login_form() {
        $('#login').val($('#login').val().replace(/([^A-Za-z0-9-_])+/,""));
        $('#password').val($('#password').val().replace(/([^A-Za-z0-9-_])+/,""));
        if($('#login').val().length < 4 || $('#password').val().length < 6){
            $('#sign_in_btn').prop("disabled", true);
        }else{
            $('#sign_in_btn').prop("disabled", false);
    }
}

function log_in(){
    $.post(
        {
            url: '/public/login',
            data:
            {
               name : $('#login').val(),
               password : $('#password').val(),
               remember :  $('#remember_token').prop('checked')
            },
            success: function(data){
                if($.parseJSON(data) == "success"){
                    console.log($.parseJSON(data));
                    if(window.location.href == "https://mateshchuk.000webhostapp.com/public/registration" || window.location.href == "https://mateshchuk.000webhostapp.com/public/welcome"){
                     window.location.replace("https://mateshchuk.000webhostapp.com/public/home");
                    }else {
                     location.reload();
                    }
                }else{
                    alert("Error");
                }
            }
        }
    );
}

function active(){
    var list = $('#main_menu li a');
    for(var i = 0; i < list.length; i++){
        if(list[i].href == window.location.href){
            $(list[i]).parent().addClass('active');
        }
    }
}