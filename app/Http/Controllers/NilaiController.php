<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kip;
use App\Nilai;
use App\Permission;
use App\Status;
use Artisan;
use Auth;
use Session;
use Storage;

class NilaiController extends Controller
{
    public function listspv()
    {
        // $kips = Kip::join('users', 'users.user_npk', '=', 'kips.kip_created_by')
        //             ->join('statuses', 'statuses.status_code', '=', 'kips.kip_status')
        //             ->where('user_dept', Auth::user()->user_dept)
        //             ->get();

        $kips = DB::select(
            DB::raw("
            select 
                a.kip_created_on, 
                a.kip_no, 
                a.kip_judul_tema, 
                a.kip_status, 
                IFNULL(spv.total, 0) as 'spv', 
                IFNULL(depthead.total, 0) as 'depthead', 
                IFNULL(comitee.total, 0) as 'comitee',
                IFNULL(spv.total, 0)+IFNULL(depthead.total, 0)+IFNULL(comitee.total, 0) as 'final',
                s.status_desc, 
                s.status_color
            FROM 
                kips a 
                LEFT JOIN vw_sum_nilai spv ON a.kip_no=spv.nilai_kip_no AND spv.nilai_level='spv' 
                LEFT JOIN vw_sum_nilai depthead ON a.kip_no=spv.nilai_kip_no AND depthead.nilai_level='depthead' 
                LEFT JOIN vw_sum_nilai comitee ON a.kip_no=spv.nilai_kip_no AND comitee.nilai_level='comitee'
                LEFT JOIN statuses s ON a.kip_status=s.status_code;
            ")
        );
    
    	return view('nilai.list', [
            'kips' => $kips,
            'role' => 'spv',
        ]);
    }
    
    public function viewspv($id)
    {
        $kip = Kip::join('users', 'users.user_npk', '=', 'kips.kip_created_by')
                    ->where('kip_no', $id)
                    ->where('user_dept', Auth::user()->user_dept)
                    ->first();
        if(empty($kip)) abort(404);
        
        $statuses = Status::orderBy('status_order')->get();

    	return view('nilai.view', [
            'kip'       => $kip,
            'role'      => 'spv',
            'statuses'  => $statuses,
            'showForm'  => ($kip->kip_status=='submit' && Permission::hasRoles('SPV'))
        ]);
    }
    
    public function save(Request $request)
    {
        // validation with kip_no & user_dept
        $kip = Kip::join('users', 'users.user_npk', '=', 'kips.kip_created_by')
                    ->where('kip_no', $request->nilai_kip_no)
                    ->where('user_dept', Auth::user()->user_dept)
                    ->first();
        if(empty($kip)) abort(404);
        
        $nilai = new Nilai;
        $nilai->nilai_kip_no        = $request->nilai_kip_no;
        $nilai->nilai_created_by    = Auth::user()->user_npk;
        $nilai->nilai_level         = $request->nilai_level;
        $nilai->nilai_penghematan   = $request->nilai_penghematan;
        $nilai->nilai_quality       = $request->nilai_quality;
        $nilai->nilai_safety        = $request->nilai_safety;
        $nilai->nilai_ergonomi      = $request->nilai_ergonomi;
        $nilai->nilai_manfaat       = $request->nilai_manfaat;
        $nilai->nilai_kepekaan      = $request->nilai_kepekaan;
        $nilai->nilai_keaslian      = $request->nilai_keaslian;
        $nilai->nilai_usaha         = $request->nilai_usaha;
        $nilai->nilai_usaha         = $request->nilai_usaha;
        $simpannilai = $nilai->save();

        
        if(!$simpannilai)
        {
            Session::flash('error', 'Menyimpan nilai gagal! Mohon hubungi admin');
        }
        
        Kip::where('kip_no', $request->nilai_kip_no)
            ->update([
                'kip_status' => $request->nilai_level
            ]);

        Session::flash('success', 'Berhasil memberikan penilaian');
        return redirect()->back();   
    }
}