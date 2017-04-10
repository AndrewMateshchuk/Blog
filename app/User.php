<?php

namespace App;
use Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    public static function isAuth($view){
        if(Auth::check()){
            return view($view, [ 'name'=>Auth::user()->name, 'user_id'=>Auth::user()->id ]);
        }else{
            return view($view);
        }
    }
    protected $fillable = [
        'name',
        'email',
        'password',
        'remember_token',
    ];
    protected $guarded = [
        'id'
    ];
}