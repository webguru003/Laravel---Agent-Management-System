<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\User;
use App\Passwordreset;
use Auth;
 use Illuminate\Support\Facades\Redirect;
class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    
    public function passwordreset(Request $request)
    {
      $passswordemail = Passwordreset::where('email', $request->email)->first();
			if($passswordemail->token==$request->token)
			{
				$data['email']=$request->email;
				$data['token']=$request->token;
				return view('auth.passwords.reset',compact('data'));
			}
			else
			{
				return redirect('/team/login');
			}
    }


    public function resetcommit(Request $request)
    {
        $this->validate($request, [
                'password' => 'required|confirmed',
                'password_confirmation' => 'required',
                    ]);



      $passswordemail = Passwordreset::where('email', $request->email)->first();
			if($passswordemail)
			{
				if($passswordemail->token==$request->emailtoken)
				{
					$user_id = User::where('email', $request->email)->first();
					$User = User::find($user_id->id);
					$password = bcrypt($request->password);
					$User->password = $password;
					$User->save();
					$url=url('/team/login');
					return redirect()->back()->with('message', 'Password Reset Go to Login Page'); 
				}
				else
				{
					return redirect()->back()->with('message', 'Email Token invlaid'); 
				}
			}

			else
			{
				return redirect('/team/login');
			}
			

			
    }

	public function sendemail(Request $request)
    {
        
		 $this->validate($request, [
            'email' => 'required|exists:users|email',
            ]);

 $token = md5($request->email. time());
 
$url=url('').'/passwordresetlink/'.$token.'/'.$request->email;
$passwordtoken = Passwordreset::where('email', $request->email)->first();

     
if($passwordtoken)
{
 Passwordreset::where('email', $request->email)->delete();
		$passwordreset = new Passwordreset;

		$passwordreset->email = $request->email;
		$passwordreset->token = $token;

		$passwordreset->save();
}
else
{
		$passwordreset = new Passwordreset;

		$passwordreset->email = $request->email;
		$passwordreset->token = $token;

		$passwordreset->save();
}

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Create email headers
$headers .= 
'X-Mailer: PHP/' . phpversion();
// Compose a simple HTML email message
$message = '<html><body>';
$message .= '<p><h1>Click Below Link to reset password</h1><a href="'.$url.'">Click Here</a></p></body></html>';
mail($request->email,"Password Resset",$message,$headers);
        return redirect()->back()->with('message', 'Email has been sent please check password rest link'); 
       
    }
}
