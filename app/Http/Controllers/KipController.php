<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kip;
use Artisan;
use Auth;
use Session;
use Storage;

class KipController extends Controller
{
    public function listown()
    {
        $kiplist = Kip::where('kip_created_by', Auth::user()->user_npk)->get();

    	return view('kip.list_own', [
            'kips' => $kiplist
        ]);
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
            $kip_no = "SS".str_pad($kip_no, 5, '0', STR_PAD_LEFT);
        }
        else
        {
            $kip_no = "SS00001";
        }
        
        if ($request->hasFile('kip_foto_sebelum')) 
        {
            try
            {
                $kip_foto_sebelum = $kip_no.'-sebelum.'.$request->file('kip_foto_sebelum')->getClientOriginalExtension();
                    
                // delete if exists
                if (Storage::disk('public')->exists( 'kip/'.$kip_foto_sebelum )) Storage::delete('public/kip/'.$kip_foto_sebelum);
                $request->file('kip_foto_sebelum')->storeAs('public/kip', $kip_foto_sebelum);

                Artisan::call('cache:clear');
            } catch (\Illuminate\Database\QueryException $e) {
                Session::flash('error', 'Upload kip_foto_sebelum failed');
                return redirect()->back();
            }
        }
        
        if ($request->hasFile('kip_foto_sesudah')) 
        {
            try
            {
                $kip_foto_sesudah = $kip_no.'-sesudah.'.$request->file('kip_foto_sesudah')->getClientOriginalExtension();
                    
                // delete if exists
                if (Storage::disk('public')->exists( 'kip/'.$kip_foto_sesudah )) Storage::delete('public/kip/'.$kip_foto_sesudah);
                $request->file('kip_foto_sesudah')->storeAs('public/kip', $kip_foto_sesudah);

                Artisan::call('cache:clear');
            } catch (\Illuminate\Database\QueryException $e) {
                Session::flash('error', 'Upload kip_foto_sesudah failed');
                return redirect()->back();
            }
        }
        
        $kip = new Kip;
        $kip->kip_no                = $kip_no;
        $kip->kip_status            = $request->mode;
        $kip->kip_judul_tema        = $request->kip_judul_tema;
        $kip->kip_created_by        = Auth::user()->user_npk;
        $kip->kip_created_on        = date("Y-m-d H:i:s");
        $kip->kip_kategori          = $request->kip_kategori;
        $kip->kip_line              = ($request->kip_line!="") ? $request->kip_line : null;
        $kip->kip_proses            = ($request->kip_proses!="") ? $request->kip_proses : null;
        $kip->kip_masalah           = htmlspecialchars($request->kip_masalah);
        $kip->kip_perbaikan         = htmlspecialchars($request->kip_perbaikan);
        $kip->kip_foto_sebelum      = ($request->hasFile('kip_foto_sebelum')) ? $kip_foto_sebelum : null;
        $kip->kip_foto_sesudah      = ($request->hasFile('kip_foto_sesudah')) ? $kip_foto_sesudah : null;
        $kip->kip_eval_uraian       = htmlspecialchars($request->kip_eval_uraian);
        $kip->kip_eval_biaya        = htmlspecialchars($request->kip_eval_biaya);
        $kip->kip_eval_benefit_kuantitatif  = htmlspecialchars($request->kip_eval_benefit_kuantitatif);
        $kip->kip_eval_benefit_kualitatif   = htmlspecialchars($request->kip_eval_benefit_kualitatif);
        $kip->kip_pengontrolan      = htmlspecialchars($request->kip_pengontrolan);
        $simpankip = $kip->save();

        
        if($simpankip)
        {
            if($request->mode == "draft")
                Session::flash('success', 'KIP saved as draft');
            elseif($request->mode == "draft")
                Session::flash('success', 'KIP submitted succesfuly');

        } else {
            Session::flash('error', 'Menyimpan kegiatan gagal! Mohon hubungi admin MagangHub');
        }
        
        return redirect()->back();
    }
}
