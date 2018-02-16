<?php

namespace App\Http\Controllers\themesetting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Setting;
use App\Invoice;
use App\Task;
use Illuminate\Support\Facades\Redirect;

class SettingController extends Controller
{
    public function index()
    {
    	 $setting = Setting::first();
    	return view('themesetting.index',compact('setting'));
    }

    public function setting(Request $request)
    {
    	$this->validate($request, [
                'site_title' => 'required',
                'footer_text' => 'required',
                 'header_color' => 'required',
                'footer_color' => 'required',
				'kiometers_price' => 'required|numeric',
                'fixed_kilometers' => 'required',
				'numberofimages_price' => 'required|numeric',
				'vat' => 'required|numeric',
                
			 ]);

    	$id=$request->id;
		$Setting = Setting::find($id);
		$Setting->stext=$request->site_title;
		$Setting->ftext=$request->footer_text;
		$Setting->hcolor=$request->header_color;
		$Setting->fcolor=$request->footer_color;
		$Setting->kiometers_price=$request->kiometers_price;
        $Setting->fixed_kilometers=$request->fixed_kilometers;
		/*$Setting->numberofimages_price=$request->numberofimages_price;*/
		$Setting->vat=$request->vat;
		$Setting->save();
		return Redirect::to('/theme/setting');

    }

     public function color(Request $request)
    {
    
    }
}
