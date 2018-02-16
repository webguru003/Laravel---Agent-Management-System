<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Hash;
use Illuminate\Support\Facades\Redirect;
class Checkagent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        if(!session()->has('team_user_id'))
            {
             return redirect('/team/login');
            }
            else
            return $next($request);
       

        /*return redirect('dashboard')->with('fails', 'You are not Autherised');*/
    }
    
}
