<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        Session::put('url', url()->previous());
        return view('auth.login');
    }
    public function register()
    {

        return view('auth.register');
    }
    public function profile()
    {
        $user = Auth::user();
        abort_if(!$user, 404);
        $user->email = $this->obfuscate_email($user->email);
        return view('auth.profile', ['user' => $user]);
    }
    public function changePassword()
    {
        return view('auth.changepassword');
    }
    public function obfuscate_email($email)
    {
        $em   = explode("@", $email);
        $name = implode('@', array_slice($em, 0, count($em) - 1));
        $len  = floor(strlen($name) / 2);

        return substr($name, 0, $len) . str_repeat('*', $len) . "@" . end($em);
    }
}
