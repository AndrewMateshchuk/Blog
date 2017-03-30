<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function chat(){
        return User::isAuth('pages/chat');
    }
    public function registration(){
        return User::isAuth('pages/registration');
    }
    public function welcome(){
        return User::isAuth('pages/welcome');
    }
    public function addNotation(){
        return User::isAuth('pages/notation');
    }
}
