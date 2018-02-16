<?php

namespace App\Http\Controllers\invoicecontroller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Task;
use App\Client;
use App\User;
use App\Invoice;
use App\Agentinvoice;
use App\Setting;
use DB;
use DateTime;
use Illuminate\Support\Facades\Redirect;
class AgentinvoiceController extends Controller
{
 
 	public function index()
    {
     	return view('agentinvoices.index');
    }
     public function create()
    {
      echo "create";
    }

    
 public function print(Request $request)
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

	   	return view('agentinvoices.print',compact('task_id'));

       
    }

    public function sendemail(Request $request)
    {
    			
					$dia_ids=rtrim( $request->dia_ids,',');
					$dia_ids=explode(",",$dia_ids);

					foreach ($dia_ids as $dia_id) 
					{
						if(!$dia_id)
						{
							echo "no hay registro seleccionado";exit;
						}
						$task_assign_to[] = Task::where([
						['dia_id','=', $dia_id],
						])->pluck('assign_to')[0];



					}
					$task_assign_to=array_unique($task_assign_to);
					$totalcount=count($task_assign_to);
    				$totalcount=count($task_assign_to);
    				for ($i = 0; $i < $totalcount ; $i++) 
    				{
    					
	    				$agent = User::where('id','=', $task_assign_to[$i])->first();
	    				$dateandtime= date('d-m-Y');
	                    $link=url('/invoices/'.$dateandtime.'/download/agent/'.$request->dia_ids);
	                    $headers =  'X-Mailer: PHP/' . phpversion();
	                    $headers .= "X-Priority: 3\n";
	                    $headers .= 'MIME-Version: 1.0' . "\r\n";
	                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	                    // Compose a simple HTML email message
	                    $message = '<html><body>';
	                    $message .= '<h1> Factura</h1>';
	                    $message .= '<h2>'.$dateandtime.'</h2>';
	                    $message .= '<h2> Querido:'.ucfirst($agent->fname).'</h2>';
	                    $message .= '<a href="'.$link.'"  target="_blank" rel="nofollow"><button style="padding: 16px 80px;background-color: #4890D7;;font-size: 20px;color: #FFFFFF;cursor:pointer;">Descargar</button></a>';

	                    $message .='</body></html>';
	                    mail($agent->email,"Factura",$message,$headers);

    				
    				}
    				
                    $returnmessage="Se ha enviado un enlace a perito  ";
                    return  $returnmessage;


    }

    public function download(Request $request)
    {
			$date[]=$request->date;
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

			return view('agentinvoices.download',compact('task_id','date')); 
    }
    
    public function downloadpdf(Request $request)
    {
    	$date[]=$request->date;
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

			return view('agentinvoices.downloadpdf',compact('task_id','date')); 
    }

}