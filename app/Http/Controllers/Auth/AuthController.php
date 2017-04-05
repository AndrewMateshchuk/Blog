<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Http\UploadedFile;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function registration(Request $r) {
        $validator = Validator::make(
            array(
                'name' => $r->input('name'),
                'email' => $r->input('email'),
                'password' => $r->input('password')
            ),
            array(
                'name' => 'required|min:4|max:60|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6|max:60'
            )
        );
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }else{
            $img = $r->file('image');
            $user = new User();
            $user->name = $r->input('name');
            $user->email = $r->input('email');
            $user->password = Hash::make($r->input('password'));
            $user->save();
            if(isset($img)) {
                if(($img->extension() == "jpeg" || $img->extension() == "jpg" || $img->extension() == "png") && $img->getClientSize() < 5000000) {
                    $img->move('images', $user->id . ".jpeg", array());
                    $user->image = $user->id;
                    $user->save();
                }
            }
             return redirect('/welcome');
        }
    }

    public function login(Request $r) {
                Auth::attempt(['name' => $r->input('name'), 'password' => $r->input('password')], $r->input('remember'));
            if(Auth::check())
            {
                return response(json_encode('success'));
            }
            else
            {
                return response(json_encode('fail'));
            }
        }

    public function logout(){
        Auth::logout();
        return redirect()->back();
    }
}