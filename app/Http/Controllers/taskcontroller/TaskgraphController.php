<?php

namespace App\Http\Controllers\taskcontroller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Task;
use App\Client;
use App\User;
use DB;
use Crypt;
use Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class TaskgraphController extends Controller
{
 
    public function index(Request $request)
    {
       
		$tasks = Task::where('completion_date', $request->date)->get();
		$alert['novalue']=1;
      return view('tasks/tasks',compact('tasks','alert'));
    }

    public function agentindex(Request $request)
    {
       
      $tasks = Task::where([
        ['assign_to', $request->id],['completion_date', $request->date]
          ])->get();
      $alert['novalue']=1;
      return view('tasks/tasks',compact('tasks','alert'));
    }
    public function createdatIndex(Request $request)
    {

      $tasks=Task::where([
      ['status','=', "nuevoexpeditene"],
      [DB::raw('DATE(created_at)'),'=', $request->date]
      ])->get();
      $alert['newtask']=1;
      return view('tasks/tasks',compact('tasks','alert'));
    }
  
     public function exporttoexcel(Request $request)
    {
       $dia_ids=rtrim( $request->dia_ids,',');
          $dia_ids=explode(",",$dia_ids);
        foreach ($dia_ids as $dia_id) 
          {
        
              if(!$dia_id)
              {
                return back();
              }
                
                try 
                {
                  $task_id[] = Task::where([
                  ['dia_id','=', $dia_id],
                  ])->pluck('id')[0];

                }
                catch (\Exception $e) 
                {
                  return back();
                }  
               
                  
          }


          return view('tasks.excel',compact('task_id')); 
    }

   
}
