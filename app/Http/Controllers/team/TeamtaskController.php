<?php

namespace App\Http\Controllers\team;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Hash;
use DB;
use App\Task;
use Illuminate\Support\Facades\Redirect;
class TeamtaskController extends Controller
{
 
public function show(Request $request){
      $task = Task::where('id', $request->id)->first();
      $comments = DB::select("select * from comments where task_id = '".$request->id."' order by id DESC", [1]);
          

      return view('team.teamtasks.show' ,compact('task','comments'));
   }
	
	public function password2(Request $request){
      //$task = Task::where('id', $request->id)->first();
      return view('team.teamtasks.forgetpass');
   }
    public function passupdate(Request $request){
		$newpass = Hash::make($request->newpass);
		$rnewpass1 = $request->newpass;
		$rnewpass2 = $request->rnewpass;
		$useridd = $request->id;
		if($rnewpass1 !== $rnewpass2)
		{
			 $mess = 'Ambas contraseñas deben ser las mismas';
	   		 return view('team.teamtasks.forgetpass', compact( 'mess') );
        }
		
	 	DB::insert('update users set password = "'.$newpass.'" where id ="'.$useridd.'"');
			 $mess = 'Contraseña cambiada con éxito';
	 
			return view('team.teamtasks.forgetpass', compact( 'mess') );
      
   }
    public function update(Request $request){
			$rules= array('kilometers' => 'nullable|numeric', 
					'message' => 'nullable',);
			$this->validate($request,$rules);
			
			$Task = Task::find($request->id);
			$Task->kilometers = $request->kilometers;
			$Task->message = $request->message;
			if(isset($request->status))
			{
				$Task->status=$request->status;
			}
			if($request->status=="enproceso" && !isset($Task->task_startdate))
			{
				$Task->task_startdate=date('Y-m-d');
				$Task->task_start_time=date('H:i:s');
			}

			if($request->status=="reunionfija" && !isset($Task->meeting_date))
			{
				$rules= array(
					'meeting_date' => 'required|date', 
					'meeting_time' => 'required',
						);
				$validation_messages=array('meeting_date.required' => 'necesario', 'meeting_date.date' => 'Incorrecto Fecha','meeting_time.required' => 'seleccionar');
				$this->validate($request,$rules,$validation_messages);
				
				$meeting_date=explode("-",$request->meeting_date);
				$meeting_date=$meeting_date[2]."-".$meeting_date[1]."-".$meeting_date[0];
				$Task->meeting_date=$meeting_date;
				$Task->meeting_time=$request->meeting_time;
			}
			$Task->save();
			
 				$dateetime = date("d-m-Y")." ".date("h:i:sa");
				$comentttid = time();
 			  	DB::insert("INSERT INTO `comments` (`id`, `task_id`, `userid`, `comments`, `datetime`) VALUES ('".$comentttid."', '".$request->id."','".$request->assign_to."','".$request->message."','".$dateetime."')");
				 
	 		return redirect('/team/login');
      
   }
}
