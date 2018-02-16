<?php

namespace App\Http\Controllers\reportcontroller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Task;
use Hash;
use Illuminate\Support\Facades\Redirect;
class ReportController extends Controller
{
    public function index()
    {
		 $tasks = Task::all();
		/*$count['total'] = Task::all()->count();
		$count['pending'] = Task::where([
				['status','=', 'enproceso'],
				])->count();
		$count['completed'] = Task::where([
				['status','=', 'facturada'],
				])->count();*/
		
		return view('reports.index',compact('tasks'));
	}
	
    
}
