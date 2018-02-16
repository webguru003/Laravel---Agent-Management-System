<?php

namespace App\Http\Controllers\team;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Task;
use Hash;
use DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
class TeamController extends Controller
{
    public function index()
    {
    	if(session()->has('team_user_id'))
			{
				
				$newtasks = Task::where([
				['assign_to','=', session()->get('team_user_id')],
				['status', '=', 'nuevoexpeditene']
				])->get();

				$inprocesstasks = Task::where([
				['assign_to','=', session()->get('team_user_id')],
				['status', '!=', 'nuevoexpeditene'],
				['status', '!=', 'visitada'],
				['status', '!=', 'facturada']
				])->get();

				$closedtasks = Task::where([
				['assign_to','=', session()->get('team_user_id')],
				['status', '=', 'facturada']
				])->get();

				$assign_to[]=session()->get('team_user_id');

				return view('team.index',compact('newtasks','inprocesstasks','closedtasks','assign_to'));
			}
			
    	return view('team.login');
    }
     public function check(Request $request)
    {
    	if(session()->has('team_user_id'))
			{
			return view('team.index');
			}
		$this->validate($request, [
		 	
		'username' => [
		'required',
		Rule::exists('users')->where(function ($query) {
		$query->where('typeid', 2);
		}),
		],
        'password' => 'required',
    		]);


		$password = User::where('username', '=', $request->username)->pluck('password');
		$userid = User::where('username', '=', $request->username)->pluck('id');
		 $hashedPassword=$password[0];

			if (Hash::check($request->password, $hashedPassword)) 

			{
				
				$request->session()->put('team_user_id',$userid);
				return redirect('/team/login');
			}
    	else
			{
				return redirect()->back()->with('message', 'Introduzca Corregir nombre de usuario o contraseña'); 
			}
    }

    public function forgot()
    {
    	if(session()->has('team_user_id'))
			{
			return view('team.index');
			}
		return view('team.email');
    }
    public function logout()
    {
    	session()->forget('team_user_id');
		return redirect('/team/login');
    }

    public function newtasksIndex(Request $request)
    {
		$newtasks=Task::where([
		['status','=', "nuevoexpeditene"],
		['assign_to', '=', $request->id],
		[DB::raw('DATE(created_at)'),'=', $request->date]
		])->get();
		return view('team.newtasksindex',compact('newtasks'));
    }
    
}
