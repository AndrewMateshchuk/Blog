<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <script src="/../public/js/jquery-3.1.1.min.js"></script>
    <link rel="stylesheet" href="/../public/css/bootstrap.css">
    <link rel="stylesheet" href="/../public/css/bootstrap-theme.css">
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Sansita" rel="stylesheet">
    <link rel="stylesheet" href="/../public/css/style.css">
    <script src="/../public/js/bootstrap.min.js"></script>
    <script src="/../public/js/auth.js"></script>
    @yield('head')
</head>
<body link="rgba(35, 35, 35, 0.9)">
    <header class="text-center row">
        <div class="head col-sm-12">
            @if(isset($name))
            <div id="greeting">Hello, {{$name}}</div>
            <div id="logout_btn">
                <a href="/../public/logout"><img src="https://cdn0.iconfinder.com/data/icons/thin-essentials/57/thin-050_logout_exit_door-512.png" width="35px" height="35px"></a>
            </div>
            @else
            <div id="login_btn">
                <img src="http://www.freeiconspng.com/uploads/register-secure-security-user-login-icon--7.png" width="35px" height="35px"  data-toggle="modal" data-target=".login_form_modal">
            </div>
            @endif
            <div class="head_title">Title</div>
        </div>
    </header>
        <div class="col-lg-12 col-md-12">
            <ul class="nav nav-pills col-lg-offset-4 col-lg-4 col-md-offset-4 col-md-5 col-sm-6 col-sm-offset-3" id="main_menu">
                <li><img style="margin-right: 5px;" src="https://1.bp.blogspot.com/--Nx865F2rFw/V3ZWsjJxQLI/AAAAAAAAGzM/HNGH03JIYUArycOGe6OajabzEl33cwp9ACLcB/s1600/Cornie-icons.png" width="40px" height="40px"></li>
                <li><a href="/../public/home">Home</a></li>
                <li><a href="/../public/chat">Chat</a></li>
                <li><a href="/../public/Calc">Calculator</a></li>
                <li><a href="/../public/addNotation">Add a Notation</a></li>
                @if(isset($id))<li><a href="/../public/user/{{$id}}">Profile</a></li>@endif
            </ul>
        </div>
    <div class="main row">
        @yield('content')
    </div>
    <footer class="text-center row">
        <div class="footer_title">
            <h5>Andrew Mateshchuk</h5>
        </div>
        <div class="footer_content">
        </div>
    </footer>
    <div class="modal fade login_form_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">Log In</h4>
                </div>
                <div class="modal-body">
                    <form id="login_form" class="form-horizontal" oninput="valid_login_form()">
                        <div class="form-group">
                            <label for="login" class="col-sm-2 control-label">Login</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="login" placeholder="Login" required min-length="4">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="password" placeholder="Password" required min-length="6">
                            </div>
                        </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="remember_token"> Remember me
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                <button type="button" id="sign_in_btn" class="btn btn-default" onclick="log_in()">Sign in</button>
                                </div>
                            </div>
                    </form>
                    <div id="registration">
                        <a href="registration">Registration</a>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</body>
</html>