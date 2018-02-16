<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Admincontroller extends Controller
{
    public function index()
    {
    	if(session()->has('adminusername'))
			{
			return view('home');
			}
			
    	return view('login');
    }
}
