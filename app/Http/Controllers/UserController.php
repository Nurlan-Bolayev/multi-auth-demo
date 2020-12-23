<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Http\Requests\UserRegisterFormRequest as RegisterFormRequest;
use App\Http\Requests\UserLoginFormRequest as LoginFormRequest;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(RegisterFormRequest $registerFormRequest)
    {
        $user = User::create([
            'name' => $registerFormRequest['name'],
            'email' => $registerFormRequest['email'],
            'password' => Hash::make($registerFormRequest['password']),
        ]);

        return redirect()->intended('/login');
    }

    public function login(LoginFormRequest $loginFormRequest)
    {
        $attrs = ['email' => $loginFormRequest->email, 'password' => $loginFormRequest->password];
        if(Auth::attempt($attrs)){
            return redirect()->intended('/');
        }
        return redirect()->back()->withInput($loginFormRequest->only('email','password'));
    }
}
