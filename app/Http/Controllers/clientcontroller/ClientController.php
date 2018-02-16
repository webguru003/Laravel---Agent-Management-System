<?php

namespace App\Http\Controllers\clientcontroller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
 use App\Client;
 use Crypt;
 use Hash;
 use Illuminate\Support\Facades\Redirect;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
      return view('clients/clients',compact('clients'));
    }

    
    public function create()
    {
        return view ('clients/add');
    }

   
    public function store(Request $request)
    {
         $this->validate($request, [
                'contactname' => 'required',
                'companyname' => 'required',
           
                    ]);

                $Client = new Client;
                $Client->contactname = $request->contactname;
                $Client->companyname = $request->companyname;
                $Client->save();
                return Redirect::to('/clients');
    }

   
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $client = Client::find($id);
        return view('clients/edit',compact('client'));
    }

  
    public function update(Request $request, $id)
    {
         $this->validate($request, [
                'contactname' => 'required',
                'companyname' => 'required',
           
                    ]);

                $Client = Client::find($id);
                $Client->contactname = $request->contactname;
                $Client->companyname = $request->companyname;
                $Client->save();
                return Redirect::to('/clients');
    }


    public function destroy($id)
    {
        $Client = Client::find($id);
        $Client->delete();
        return Redirect::back();
    }
}
