<?php

namespace App\Http\Controllers\taskcontroller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Task;
use App\Client;
use App\User;
use App\Invoice;
use App\Setting;
use Crypt;
use Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
		use DB;


 class MailinSms {
    
        protected $key, $to, $from, $callback, $text, $tag, $webaction = 'SENDSMS', $url = 'http://ws.mailin.fr/', $type='marketing';
        
        public function __construct($key){
            $this->key = $key;
        }
        
        public function addTo($to){
            $this->to = $to;
            return $this;
        }

        public function setFrom($from){
            $this->from = $from;
            return $this;
        }

        public function setCallback($callback_url){
            $this->callback = $callback_url;
            return $this;
        }

        public function setText($text){
            $this->text = $text;
            return $this;
        }

        public function setTag($text){
            $this->tag = $text;
            return $this;
        }
        
        public function setType($text){
            $this->type = $text;
            return $this;
        }

        public function send(){
        
            $ch = curl_init();
            $data = array(
                'webaction' => $this->webaction,    
                'key' => $this->key,    
                'to' => $this->to,  
                'from' => $this->from,  
                'text' => $this->text,
                'tag' => $this->tag,
                'callback_url' => $this->callback,
                'type' => $this->type
            );
    
            $ndata='';
            if(is_array($data)){
                foreach($data AS $key=>$value)
                    $ndata .=$key.'='.urlencode($value).'&';
            }else{
                $ndata=$data;
            }

            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
            curl_setopt($ch, CURLOPT_POST,1);
            curl_setopt ($ch, CURLOPT_POSTFIELDS,$ndata);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set curl to return the data instead of printing it to the browser.
            curl_setopt($ch, CURLOPT_URL, $this->url);
            $data = curl_exec($ch);
            curl_close($ch);
            return $data;
        }
    }



class TaskController extends Controller
{
 
    public function index()
    {
        $tasks = Task::where('status','!=', "facturada")->get();
      return view('tasks/tasks',compact('tasks'));
    }

  
    public function create()
    {
         $agents = User::where('typeid','!=', 1)->get();
         $clients = Client::all();
         return view ('tasks/add',compact('agents','clients'));
    }

    
    public function store(Request $request)
    {
        $this->validate($request, [
                'title' => 'required',
                'dia_id' => 'required|unique:tasks',
                'comapnyid' => 'required',
                'reference_number' => 'required',
                'phone_number' => 'required',
                'contact_person' => 'required',
                'task_price' => 'nullable|numeric',
                'assignto' => 'required',
                'duedate' => 'required|date',
                'status' => 'required',
           
                    ],
                    ['dia_id.unique' => 'Ya asignado a Expediente',]);
                $reference_number=$request->ref_select.$request->reference_number;
                $file = $request->file('doc');
				$duedatevalue = explode("-",$request->duedate);
				$duedate = $duedatevalue[2]."-".$duedatevalue[1]."-".$duedatevalue[0];
                if($request->status != "facturada")
                {
                    $agent=User::where('id','=', $request->assignto)->first();
                    
                    $link=url('/team/login');
                    // To send HTML mail, the Content-type header must be set
                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    // Create email headers
                    $headers .= 
                    'X-Mailer: PHP/' . phpversion();
                    // Compose a simple HTML email message
                    $message = '<html><body>';
                    $message .= '<h1>Tarea asignada</h1>';
                    $message .= '<p>
                    Tarea Título:'.$request->title.'<br/>'.
                    'Número de referencia:'.$reference_number.'<br/>'.
                    'Para más detalles Ingresar <br/>';
                    $message .= '
                    <a href="'.$link.'"  target="_blank">Iniciar sesión</a>
                    <p>';

                    $message .='</body></html>';
                    mail($agent->email,"Una nueva tarea",$message,$headers);
                }
                
                if(isset($file)) 
                {
                    $extension = $file->getClientOriginalExtension();
                    $unique_name = md5($request->name. time());
                    $filename= $unique_name.'.'.$extension;
                    $file->storeAs( 'public/details', $filename);
                }
                if (!isset($filename)) {
                     $filename="";
                }
                $Task = new Task;
                $Task->title = $request->title;
                $Task->asegurado = $request->asegurado;
                $Task->dia_id = $request->dia_id;
                $Task->reference_number = $reference_number;
                $Task->tramitador = $request->tramitador;
                $Task->clients_id = $request->comapnyid;
                $Task->attach_file = $filename;
                $Task->details = $request->details;
                $Task->assign_to = $request->assignto;
				$Task->phone_number = $request->phone_number;
                $Task->contact_person = $request->contact_person;
                $Task->task_price = $request->task_price;
				$Task->due_date = $duedate;
                $Task->status = $request->status;
                if($request->status=="enproceso" && !isset($Task->task_startdate))
                {
                    $Task->task_startdate=date('Y-m-d');
                    $Task->task_start_time=date('H:i:s');
                    
                }
                $Task->save();

				$agent=User::where('id','=', $request->assignto)->first();
                $mailin = new MailinSms('ZVh5acRr7BjpyYXF');

                            $mailin->addTo($agent->phone)
                            ->setFrom('DiATP') 
                            ->setText('Nuevo informe : ASEGURADO :'.$request->asegurado.' Ref : '.$request->dia_id) 
                            ->setTag('DiATP')
                            ->setType(''); // Two possible values: marketing or transactional.
                            $res = $mailin->send();
                            var_dump($res);
		exit;
							 
                return Redirect::to('/tasks');
    }

 
    public function show($id)
    {
        //
    }

  
    public function edit($id)
    {

         $task = Task::find($id);
         $agents = User::where('typeid','!=', 1)->get();
 		  
         $comments = DB::select("select * from comments where task_id = '".$id."' order by id DESC", [1]);
          
		 $agents = User::where('typeid','!=', 1)->get();
		  
         $clients = Client::all();
         return view('tasks/edit',compact('task','agents','clients', 'comments'));
    }

 
    public function update(Request $request, $id)
    {
		  $this->validate($request, [
                'title' => 'required',
                'dia_id' => 'required',
                'comapnyid' => 'required',
                'reference_number' => 'required',
                'phone_number' => 'required',
                'task_price' => 'nullable|numeric',
                'assignto' => 'required',
                'duedate' => 'required|date',
                'status' => 'required',
           
                    ]);

                    $reference_number=$request->ref_select.$request->reference_number;
                    $Task = Task::find($id);
					$duedatevalue = explode("-",$request->duedate);
					$duedate = $duedatevalue[2]."-".$duedatevalue[1]."-".$duedatevalue[0];
                    if(isset($request->modified))
                    {
                        $this->validate($request, [
                            'modification' => 'required',
                            ],
                        ['modification.required' => 'Ingrese algo en Modifications Detalles',]
                        );
                        $email_title="Enmiendas a la tarea";
                    }
                    else
                    {
                        $email_title="Tarea modificada";
                    }
                    
                           
             if($request->status != "facturada")
                {
                    
                    $agent=User::where('id','=', $request->assignto)->first();
                    
                    $link=url('/team/login');
                    // To send HTML mail, the Content-type header must be set
                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    // Create email headers
                    $headers .= 
                    'X-Mailer: PHP/' . phpversion();
                    // Compose a simple HTML email message
                    $message = '<html><body>';
                    $message .= '<h1>'.$email_title.'</h1>';
                    $message .= '<p>
                    Task Title:'.$request->title.'<br/>'.
                    'Número de referencia:'.$reference_number.'<br/>'.
                    'Para más detalles Ingresar <br/>';
                    $message .= '
                    <a href="'.$link.'"  target="_blank">Iniciar sesión</a>
                    <p>';

                    $message .='</body></html>';
                    mail($agent->email,$email_title,$message,$headers);
                }
              
                    $Task->title = $request->title;
                    $Task->asegurado = $request->asegurado;
                    $Task->dia_id = $request->dia_id;
                    $Task->reference_number = $reference_number;
                    $Task->tramitador = $request->tramitador;
					$Task->phone_number = $request->phone_number;
					$Task->contact_person = $request->contact_person;
                    $Task->clients_id = $request->comapnyid;
                    /*$Task->attach_file = $request->attachdetails;*/
                    $Task->details = $request->details;
                    $Task->assign_to = $request->assignto;
                    $Task->due_date = $duedate;
                    $Task->status = $request->status;
                    $Task->task_price = $request->task_price;
        				if($request->status == "facturada")
                        {
                            
                            $completion_date_value=explode("-",$request->completion_date);
                            $completion_date=$completion_date_value[2]."-".$completion_date_value[1]."-".$completion_date_value[0];
        					$Task->completion_date=$completion_date;
                             $Task->kilometers=$request->kilometers;
                            /*$Task->number_of_images=$request->numberofimages;*/
        				}
                        if($request->status=="enproceso" && !isset($Task->task_startdate))
                        {
                            $Task->task_startdate=date('Y-m-d');
                            $Task->task_start_time=date('H:i:s');
                        }
                        
                        $Task->modification = $request->modification;

                    

                    if($request->status == "facturada")
                    {
                       
                        
                        $invoicedata = Invoice::where('task_id','=', $id)->first();
						if(isset($invoicedata->task_id))
						{
							$Invoice = Invoice::find($invoicedata->id);
                            if($request->kilometers > $Invoice->fixed_kilometers)
                            {
                                $requied_kilometers=$request->kilometers-$Invoice->fixed_kilometers;
                            }
                            else
                            {
                                $requied_kilometers=0;
                            }
                            $total_amount_withoutvat=$request->task_price+($requied_kilometers)*($Invoice->kiometers_price);
                            $vat=(($Invoice->vat)/100)*$total_amount_withoutvat;


                        }
						else
						{
                            $this->validate($request, [
                            'invoice_number' => 'required|unique:invoices',

                            ],['invoice_number.unique' => 'Ya asignado a Factura,cambie Factura el número',]);

                             $setting = Setting::first();
                             $Invoice = new Invoice;
                            $Invoice->task_id = $id;
                            $Invoice->fixed_kilometers  = $setting->fixed_kilometers;
                            $Invoice->kiometers_price  = $setting->kiometers_price;
                            $Invoice->vat  = $setting->vat;
                            
                            if($request->kilometers > $setting->fixed_kilometers)
                            {
                                $requied_kilometers=$request->kilometers-$setting->fixed_kilometers;
                            }
                            else
                            {
                                $requied_kilometers=0;
                            }
                            $total_amount_withoutvat=$request->task_price+($requied_kilometers)*($setting->kiometers_price);
                            $vat=(($setting->vat)/100)*$total_amount_withoutvat;
						}
                        
						$Invoice->invoice_number = $request->invoice_number;
						$Invoice->date_created = $completion_date;
						$total_amount = $total_amount_withoutvat+$vat;
                        
						$Invoice->total_amount  = $total_amount; 
                        $Task->save();   
                        $Invoice->save();
						return Redirect::to('/tasks/completed/all');
                    }

                $Task->save();
 
 				$dateetime = date("d-m-Y")." ".date("h:i:sa");
				$comentttid = time();
 				//print_r($_POST);
			 	DB::insert("INSERT INTO `comments` (`id`, `task_id`, `userid`, `comments`, `datetime`) VALUES ('".$comentttid."', '".$request->taskidd."','admin','".$request->message."','".$dateetime."')");
			 	 
                return Redirect::to('/tasks');
    }

	public function completed()
    {
		 $tasks = Task::where('status','=', "facturada")->get();
         $alert['novalue']=1;
      	 return view('tasks/tasks',compact('tasks','alert'));
	}

public function remember(Request $request)
{

        if(isset( $request->taskid) && $request->meetingfixed==1)
        {
            $Task = Task::find($request->taskid);
            $Task->meetingfixed = $request->meetingfixed;
            $Task->save();
            
        }
        elseif(isset( $request->taskid) && $request->meetingfixed==null)
        {
            $Task = Task::find($request->taskid);
            $Task->meetingfixed = $request->meetingfixed;
            $Task->save();
            
        }
        else
        {
            echo "not ok";
        }



}


    public function destroy($id)
    {
        $Task = Task::find($id);
        if($Task->attach_file && Storage::exists('public/details/'.$Task->attach_file) )
        {
         Storage::delete('public/details/'.$Task->attach_file);   
        }
        
        $Task->delete();
        return Redirect::back();
    }
}
