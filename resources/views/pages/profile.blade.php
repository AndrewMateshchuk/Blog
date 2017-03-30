@extends('index')
@section('content')
    @if(isset($name))
    <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
        @if($image)
            <img id="user_image" src="/../public/images/{{$id}}.jpeg">
        @endif
            <form enctype="multipart/form-data" style="height: 75vh;margin-top: 50px;" oninput="check_reg_pass()" id="reg_form" class="form-horizontal" method="POST" action="/../public/registration">
                <div class="form-group">
                    <label for="reg_login" class="col-sm-3 control-label">Login</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="reg_login" placeholder="Login" required minlength="4" maxlength="60" name="name" value="{{$name}}">
                    </div>
                    <div class="col-sm-8 col-sm-offset-2">
                        <h5 style="color:red">{{$errors->first('name')}}</h5>
                    </div>
                </div>
                <div class="form-group">
                    <label for="reg_email" class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" id="reg_email" placeholder="Email" required name="email" value="{{$email}}">
                    </div>
                    <div class="col-sm-8 col-sm-offset-2">
                        <h5 style="color:red">{{$errors->first('email')}}</h5>
                    </div>
                </div>
                <div class="form-group">
                    <label for="reg_password" class="col-sm-3 control-label">Password</label>
                    <div class="col-sm-9">
                        <input oninput="check_reg_pass()" type="password" class="form-control" id="reg_password" placeholder="Password" required minlength="6" maxlength="60" name="password">
                    </div>
                    <div class="col-sm-8 col-sm-offset-2">
                        <h5 style="color:red">{{$errors->first('password')}}</h5>
                    </div>
                </div>
                <div class="form-group" id="repeat_password_group">
                    <label for="repeat_password" class="col-sm-3 control-label">Repeat password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="repeat_password" placeholder="Password" required minlength="6" maxlength="60">
                    </div>
                </div>
                <div class="form-group" id="image_group">
                    <label for="image" class="col-sm-3 control-label">Add image</label>
                    <div class="col-sm-9">
                        <input onchange="add_image(this)" id="image" type="file" name="image"  multiple accept="image/*">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Change data</button>
                        <img style="max-width: 20vw; max-height: 20vh; float: right" id="upload_img" src="">
                    </div>
                </div>
            </form>
            <h3>Notations({{count($notes['id'])}})</h3>
            <ul>
        @for($i = 0; $i < count($notes['id']); $i++)
                <li><a href="note/{{$notes['id'][$i]}}">{{$notes['title'][$i]}}</a></li>
            @endfor
            </ul>
    </div>
    @endif
@stop
