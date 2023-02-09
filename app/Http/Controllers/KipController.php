<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kip;

class KipController extends Controller
{
    public function listown()
    {
    	return view('kip.list_own');
    }
    
    public function new()
    {    	
        return view('kip.new', [
            'user' => auth()->user()
        ]);
    }
    
    public function save(Request $request)
    {    	
        $lastKip = Kip::orderBy('kip_no', 'DESC')->first();

        if(!empty($lastKip))
        {
            $kip_no = substr($lastKip->kip_no, 2);
            $kip_no = $kip_no + 1;
            $kip_no = "SS".str_pad($value, 5, '0', STR_PAD_LEFT);
        }
        else
        {
            $kip_no = "SS00001";
        }
        
        if ($request->hasFile('kip_foto_sebelum')) 
        {
            try
            {
                $kip_foto_sebelum = $kip_no.'.'.$request->file('kip_foto_sebelum')->getClientOriginalExtension();
                    
                // delete if exists
                if (Storage::disk('public')->exists( 'kip/'.$kip_foto_sebelum )) Storage::delete('public/kip/'.$kip_foto_sebelum);
                $request->file('kip_foto_sebelum')->storeAs('public/kip', $kip_foto_sebelum);

                Artisan::call('cache:clear');
            } catch (\Illuminate\Database\QueryException $e) {
                Session::flash('error', 'Upload kip_foto_sebelum failed');
                return redirect()->back();
            }
        }
    }
}
