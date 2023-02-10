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
    
    public function edit($id)
    {
        $kip = Kip::join('users', 'users.user_npk', '=', 'kips.kip_created_by')
                    ->where('kip_no', $id)->first();
        if(empty($kip)) abort(404);

    	return view('kip.edit', [
            'kip' => $kip
        ]);
    }
    
    public function view($id)
    {
        $kip = Kip::join('users', 'users.user_npk', '=', 'kips.kip_created_by')
                    ->where('kip_no', $id)->first();
        if(empty($kip)) abort(404);

    	return view('kip.view', [
            'kip' => $kip
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
            {
                Session::flash('success', 'KIP saved as draft');
                return redirect()->back();   
            }
            elseif($request->mode == "draft")
            {
                Session::flash('success', 'KIP submitted succesfuly');
                return redirect()->route('kip.view', $kip->kip_no);   
            }
        } else {
            Session::flash('error', 'Menyimpan kegiatan gagal! Mohon hubungi admin MagangHub');
        }
        
    }
    // end of save
    
    public function update(Request $request)
    {    	
        $kip = Kip::join('users', 'users.user_npk', '=', 'kips.kip_created_by')
                    ->where('kip_no', $request->kip_no)->first();
        if(empty($kip)) abort(404);

        
        if ($request->hasFile('kip_foto_sebelum')) 
        {
            try
            {
                $kip_foto_sebelum = $kip->kip_no.'-sebelum.'.$request->file('kip_foto_sebelum')->getClientOriginalExtension();
                    
                // delete if exists
                if (Storage::disk('public')->exists( 'kip/'.$kip->kip_foto_sebelum )) Storage::delete('public/kip/'.$kip->kip_foto_sebelum);
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
                $kip_foto_sesudah = $kip->kip_no.'-sesudah.'.$request->file('kip_foto_sesudah')->getClientOriginalExtension();
                    
                // delete if exists
                if (Storage::disk('public')->exists( 'kip/'.$kip->kip_foto_sesudah )) Storage::delete('public/kip/'.$kip->kip_foto_sesudah);
                $request->file('kip_foto_sesudah')->storeAs('public/kip', $kip_foto_sesudah);

                Artisan::call('cache:clear');
            } catch (\Illuminate\Database\QueryException $e) {
                Session::flash('error', 'Upload kip_foto_sesudah failed');
                return redirect()->back();
            }
        }
        
        Kip::where('kip_no',$kip->kip_no)
            ->update([
                'kip_judul_tema'                => $request->kip_judul_tema,
                'kip_kategori'                  => $request->kip_kategori,
                'kip_line'                      => ($request->kip_line!="") ? $request->kip_line : null,
                'kip_proses'                    => ($request->kip_proses!="") ? $request->kip_proses : null,
                'kip_masalah'                   => htmlspecialchars($request->kip_masalah),
                'kip_perbaikan'                 => htmlspecialchars($request->kip_perbaikan),
                'kip_foto_sebelum'              => ($request->hasFile('kip_foto_sebelum')) ? $kip_foto_sebelum : $kip->kip_foto_sebelum,
                'kip_foto_sesudah'              => ($request->hasFile('kip_foto_sesudah')) ? $kip_foto_sesudah : $kip->kip_foto_sesudah,
                'kip_eval_uraian'               => htmlspecialchars($request->kip_eval_uraian),
                'kip_eval_biaya'                => htmlspecialchars($request->kip_eval_biaya),
                'kip_eval_benefit_kuantitatif'  => htmlspecialchars($request->kip_eval_benefit_kuantitatif),
                'kip_eval_benefit_kualitatif'   => htmlspecialchars($request->kip_eval_benefit_kualitatif),
                'kip_pengontrolan'              => htmlspecialchars($request->kip_pengontrolan)
            ]);

        if($request->mode == "draft")
        {
            Session::flash('success', 'KIP saved as draft');
            return redirect()->back();   
        }
        elseif($request->mode == "draft")
        {
            Session::flash('success', 'KIP submitted succesfuly');
            return redirect()->route('kip.view', $kip->kip_no);   
        }
    }
    // end of update
}