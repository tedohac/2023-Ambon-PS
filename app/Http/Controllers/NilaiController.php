<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kip;
use App\Nilai;
use App\Permission;
use App\Status;
use Artisan;
use Auth;
use DB;
use Session;
use Storage;

class NilaiController extends Controller
{
    public function getListByDept()
    {
        return DB::select(
            DB::raw("
            select 
                a.kip_created_on, 
                a.kip_no, 
                a.kip_judul_tema, 
                a.kip_status, 
                IFNULL(spv.vw_total, 0) as 'spv', 
                IFNULL(depthead.vw_total, 0) as 'depthead', 
                IFNULL(comitee.vw_total, 0) as 'comitee',
                IFNULL(spv.vw_total, 0)+IFNULL(depthead.vw_total, 0)+IFNULL(comitee.vw_total, 0) as 'final',
                s.status_desc, 
                s.status_color
            FROM 
                kips a 
                LEFT JOIN vw_sum_nilai spv ON a.kip_no=spv.vw_kip_no AND spv.vw_level='spv' 
                LEFT JOIN vw_sum_nilai depthead ON a.kip_no=depthead.vw_kip_no AND depthead.vw_level='depthead' 
                LEFT JOIN vw_sum_nilai comitee ON a.kip_no=comitee.vw_kip_no AND comitee.vw_level='comitee'
                LEFT JOIN statuses s ON a.kip_status=s.status_code
                LEFT JOIN users u ON a.kip_created_by=u.user_npk
            WHERE
                u.user_dept='".Auth::user()->user_dept."'
            ")
        );
    }
    
    public function getViewById($id)
    {
        return Kip::join('users', 'users.user_npk', '=', 'kips.kip_created_by')
                    ->where('kip_no', $id)
                    ->where('user_dept', Auth::user()->user_dept)
                    ->first();
    }

    public function getNilaiById($id)
    {
        return Nilai::join('vw_sum_nilai', 'vw_sum_nilai.vw_kip_no', '=', 'nilais.nilai_kip_no')
                    ->join('users', 'users.user_npk', '=', 'nilais.nilai_created_by')
                    ->where('nilai_kip_no', $id)->get();
    }

    public function listspv()
    {
        $kips = NilaiController::getListByDept();
    
    	return view('nilai.list', [
            'kips' => $kips,
            'role' => 'spv',
        ]);
    }
    
    public function listdepthead()
    {
        $kips = NilaiController::getListByDept();
    
    	return view('nilai.list', [
            'kips' => $kips,
            'role' => 'spv',
        ]);
    }
    
    public function viewspv($id)
    {
        $kip = NilaiController::getViewById($id);
        if(empty($kip)) abort(404);
        
        $statuses   = Status::orderBy('status_order')->get();
        $nilais     = NilaiController::getNilaiById($id);

    	return view('nilai.view', [
            'kip'       => $kip,
            'nilais'    => $nilais,
            'role'      => 'spv',
            'statuses'  => $statuses,
            'showForm'  => ($kip->kip_status=='submit' && Permission::hasRoles('SPV'))
        ]);
    }
    
    public function viewdepthead($id)
    {
        $kip = NilaiController::getViewById($id);
        if(empty($kip)) abort(404);
        
        $statuses   = Status::orderBy('status_order')->get();
        $nilais     = NilaiController::getNilaiById($id);

    	return view('nilai.view', [
            'kip'       => $kip,
            'nilais'    => $nilais,
            'role'      => 'depthead',
            'statuses'  => $statuses,
            'showForm'  => ($kip->kip_status=='submit' && Permission::hasRoles('Dept Head'))
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