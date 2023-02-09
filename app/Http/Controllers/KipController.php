<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kip;
use Artisan;
use Auth;
use Storage;

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
        echo "kip_line: ".$request->kip_line."<br />";
        echo "mode: ".$request->mode."<br />";
        // $lastKip = Kip::orderBy('kip_no', 'DESC')->first();

        // if(!empty($lastKip))
        // {
        //     $kip_no = substr($lastKip->kip_no, 2);
        //     $kip_no = $kip_no + 1;
        //     $kip_no = "SS".str_pad($value, 5, '0', STR_PAD_LEFT);
        // }
        // else
        // {
        //     $kip_no = "SS00001";
        // }
        
        // if ($request->hasFile('kip_foto_sebelum')) 
        // {
        //     try
        //     {
        //         $kip_foto_sebelum = $kip_no.'-sebelum.'.$request->file('kip_foto_sebelum')->getClientOriginalExtension();
                    
        //         // delete if exists
        //         if (Storage::disk('public')->exists( 'kip/'.$kip_foto_sebelum )) Storage::delete('public/kip/'.$kip_foto_sebelum);
        //         $request->file('kip_foto_sebelum')->storeAs('public/kip', $kip_foto_sebelum);

        //         Artisan::call('cache:clear');
        //     } catch (\Illuminate\Database\QueryException $e) {
        //         Session::flash('error', 'Upload kip_foto_sebelum failed');
        //         return redirect()->back();
        //     }
        // }
        
        // if ($request->hasFile('kip_foto_sesudah')) 
        // {
        //     try
        //     {
        //         $kip_foto_sesudah = $kip_no.'-sesudah.'.$request->file('kip_foto_sesudah')->getClientOriginalExtension();
                    
        //         // delete if exists
        //         if (Storage::disk('public')->exists( 'kip/'.$kip_foto_sesudah )) Storage::delete('public/kip/'.$kip_foto_sesudah);
        //         $request->file('kip_foto_sesudah')->storeAs('public/kip', $kip_foto_sesudah);

        //         Artisan::call('cache:clear');
        //     } catch (\Illuminate\Database\QueryException $e) {
        //         Session::flash('error', 'Upload kip_foto_sesudah failed');
        //         return redirect()->back();
        //     }
        // }
        
        
        // $kip = new Kip;
        // $kip->kip_no                = $kip_no;
        // $kip->kip_status            = $request->kip_judul_tema;
        // $kip->kip_judul_tema        = $request->kip_judul_tema;
        // $kip->kip_created_by        = Auth::user()->user_npk;
        // $kip->kip_created_on        = date("Y-m-d H:i:s");
        // $kegiatan->kegiatan_path    = ($request->hasFile('kegiatan_path')) ? $filename_kegiatan_path : null;
        // $kegiatan->kegiatan_desc        = htmlspecialchars($request->kegiatan_desc);
        // $simpankegiatan = $kegiatan->save();
    }
}
