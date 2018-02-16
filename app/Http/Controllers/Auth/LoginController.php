<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\Rule;
class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
        'username' => [
        'required',
        Rule::exists('users')->where(function ($query) {
        $query->where('typeid', 1);
        }),
        ],
        'password' => 'required',
            ]);

    }
        public function username()
        {
        return 'username';
        }
}