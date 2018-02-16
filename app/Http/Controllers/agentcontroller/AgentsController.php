<?php

namespace App\Http\Controllers\agentcontroller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
 use App\User;
 use App\Task;
 use Crypt;
 use Hash;
 use Illuminate\Support\Facades\Redirect;
class AgentsController extends Controller
{
   
    public function index()
    {
         $agents = User::where('typeid','=', 2)->get();
      return view('agents/agents',compact('agents'));
    }

   
    public function create()
    {
       return view ('agents/add');
    }


    public function store(Request $request)
    {
         $this->validate($request, [
                'fname' => 'required',
                'lname' => 'required',
                'username' => 'required|unique:users',
                'email' => 'required|unique:users|email',
                'phone' => 'required',
                'password' => 'required|confirmed',
                'password_confirmation' => 'required',
                    ]);

                $password = bcrypt($request->password);
                $User = new User;
                $User->fname = $request->fname;
                $User->lname = $request->lname;
                $User->username = $request->username;
                $User->email = $request->email;
                $User->phone = $request->phone;
                $User->typeid = 2;
                $User->password = $password;

                $User->save();

                return Redirect::to('/agents');
    }

    public function show($id)
    {
        echo "Show";
    }

      public function report()
    {
        return view('agents.agentreport');
    }
   
    public function edit($id)
    {

          $agent = User::find($id);
        return view('agents/edit',compact('agent'));
    }

   
    public function update(Request $request, $id)
    {
        
           $this->validate($request, [
             'fname' => 'required',
             'lname' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'password' => 'confirmed',
            
                ]);

            $User = User::find($id);
            if(isset($request->password))
            {
                $password = bcrypt($request->password);
                $User->fname = $request->fname;
                $User->lname = $request->lname;
                $User->email = $request->email;
                $User->phone = $request->phone;
                $User->password = $password;
                $User->save();
            }
            else 
            {
                $User->fname = $request->fname;
                $User->lname = $request->lname;
                $User->email = $request->email;
                $User->phone = $request->phone;
                $User->save();  
            }

           return Redirect::to('/agents');
    }

    
    public function destroy($id)
    {
       $total_assigned_task_count = Task::where([
        ['assign_to', $id]])->count();
     if($total_assigned_task_count > 0)
       {
        return Redirect::back()->withErrors(['No se puede eliminar porque algunas tareas están asociadas con el perito']);
       }
       $User = User::find($id);
        $User->delete();
        return Redirect::back();
    }
}
