<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Benefit;
use App\Biaya;
use App\Kip;
use App\Nilai;
use App\Permission;
use App\Ratio;
use App\Status;
use Artisan;
use Auth;
use DB;
use Session;
use Storage;

class NilaiController extends Controller
{
    public function getList($role_code)
    {
        $ratio   = Ratio::orderBy('ratio_created_at', 'desc')->first();

        $query = "
        select 
            a.kip_created_on, 
            a.kip_no, 
            a.kip_judul_tema, 
            a.kip_status, 
            IFNULL(spv.vw_total, 0) as 'spv', 
            IFNULL(depthead.vw_total, 0) as 'depthead', 
            IFNULL(comitee.vw_total, 0) as 'comitee',
            CASE
                WHEN IFNULL(spv.vw_total, 0) >= 35 THEN
                    TRUNCATE((((IFNULL(spv.vw_total, 0)+IFNULL(depthead.vw_total, 0))/2)*".$ratio->ratio_spvdepthead."/100)+(IFNULL(comitee.vw_total, 0)*".$ratio->ratio_comitee."/100), 2)
                ELSE
                    TRUNCATE((IFNULL(spv.vw_total, 0)*".$ratio->ratio_spvdepthead."/100)+(IFNULL(comitee.vw_total, 0)*".$ratio->ratio_comitee."/100), 2)
            END as 'final',
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
            a.kip_status != 'draft'
            AND u.user_deptline in (
                SELECT l.roleline_deptline_id
                FROM
                    permissions p
                    JOIN rolelines l ON p.permission_roleline_id=l.roleline_id
                WHERE
                    p.permission_user_npk='".Auth::user()->user_npk."'
                    AND l.roleline_role_code='".$role_code."'
            )
        ";
        

        return DB::select(
            DB::raw($query)
        );
    }
    
    public function getViewById($id, $isComitee)
    {
        // if(!$isComitee)
        // {
        //     return Kip::join('users', 'users.user_npk', '=', 'kips.kip_created_by')
        //                 ->join('statuses', 'statuses.status_code', '=', 'kips.kip_status')
        //                 ->where('kip_no', $id)
        //                 ->where('user_dept', Auth::user()->user_dept)
        //                 ->first();
        // }
        // else
        // {
            return Kip::join('users', 'users.user_npk', '=', 'kips.kip_created_by')
                        ->join('statuses', 'statuses.status_code', '=', 'kips.kip_status')
                        ->join('deptlines', 'deptlines.line_id', '=', 'users.user_deptline')
                        ->where('kip_no', $id)
                        ->first();

        // }
    }
    
    public function getTotalNilaiById($id)
    {
        $ratio   = Ratio::orderBy('ratio_created_at', 'desc')->first();

        return DB::select(
            DB::raw("
            select 
                a.kip_no, 
                IFNULL(spv.vw_total, 0) as 'spv', 
                IFNULL(depthead.vw_total, 0) as 'depthead', 
                IFNULL(comitee.vw_total, 0) as 'comitee',
                CASE
                    WHEN IFNULL(spv.vw_total, 0) >= 35 THEN
                        TRUNCATE((((IFNULL(spv.vw_total, 0)+IFNULL(depthead.vw_total, 0))/2)*".$ratio->ratio_spvdepthead."/100)+(IFNULL(comitee.vw_total, 0)*".$ratio->ratio_comitee."/100), 2)
                    ELSE
                        TRUNCATE((IFNULL(spv.vw_total, 0)*".$ratio->ratio_spvdepthead."/100)+(IFNULL(comitee.vw_total, 0)*".$ratio->ratio_comitee."/100), 2)
                END as 'final'
            FROM 
                kips a 
                LEFT JOIN vw_sum_nilai spv ON a.kip_no=spv.vw_kip_no AND spv.vw_level='spv' 
                LEFT JOIN vw_sum_nilai depthead ON a.kip_no=depthead.vw_kip_no AND depthead.vw_level='depthead' 
                LEFT JOIN vw_sum_nilai comitee ON a.kip_no=comitee.vw_kip_no AND comitee.vw_level='comitee'
            WHERE
                a.kip_no='".$id."'
            ")
        );
    }

    public function getNilaiById($id)
    {
        // return Nilai::join('vw_sum_nilai', function($join)
        //             {
        //                 $join->on('vw_sum_nilai.vw_kip_no', '=', 'nilais.nilai_kip_no');
        //                 $join->on('vw_sum_nilai.vw_level', '=', 'nilais.nilai_level');
        //             })
        //             ->join('users', 'users.user_npk', '=', 'nilais.nilai_created_by')
        //             ->where('nilai_kip_no', $id)->get();

        return Nilai::join('users', 'users.user_npk', '=', 'nilais.nilai_created_by')
                    ->where('nilai_kip_no', $id)->get();
    }

    public function listspv()
    {
        $kips = NilaiController::getList("SPV");
    
    	return view('nilai.list', [
            'kips' => $kips,
            'role' => 'spv',
        ]);
    }
    
    public function listdepthead()
    {
        $kips = NilaiController::getList("Dept Head");
    
    	return view('nilai.list', [
            'kips' => $kips,
            'role' => 'depthead',
        ]);
    }
    
    public function listcomitee()
    {
        $kips = NilaiController::getList("Comitee");
    
    	return view('nilai.list', [
            'kips' => $kips,
            'role' => 'comitee',
        ]);
    }

    public function viewspv($id)
    {
        $kip = NilaiController::getViewById($id, false);
        if(empty($kip)) abort(404);
        
        $statuses   = Status::orderBy('status_order')->get();
        $nilais     = NilaiController::getNilaiById($id);
        $totalNilai = NilaiController::getTotalNilaiById($id);
        $biayas     = Biaya::where('biaya_kip_no', $id)->get();
        $benefits   = Benefit::where('benefit_kip_no', $id)->get();

    	return view('nilai.view', [
            'kip'       => $kip,
            'nilais'    => $nilais,
            'biayas'    => $biayas,
            'benefits'  => $benefits,
            'role'      => 'spv',
            'statuses'  => $statuses,
            'totalNilai'=> $totalNilai[0],
            'showForm'  => ($kip->kip_status=='submit' && Permission::hasRoleLine($kip->user_deptline)),
            'showRevisi'=> $kip->kip_status=='submit'
        ]);
    }
    
    public function viewdepthead($id)
    {
        $kip = NilaiController::getViewById($id, false);
        if(empty($kip)) abort(404);
        
        $statuses   = Status::orderBy('status_order')->get();
        $nilais     = NilaiController::getNilaiById($id);
        $totalNilai = NilaiController::getTotalNilaiById($id);
        $biayas     = Biaya::where('biaya_kip_no', $id)->get();
        $benefits   = Benefit::where('benefit_kip_no', $id)->get();

    	return view('nilai.view', [
            'kip'       => $kip,
            'nilais'    => $nilais,
            'biayas'    => $biayas,
            'benefits'  => $benefits,
            'role'      => 'depthead',
            'statuses'  => $statuses,
            'totalNilai'=> $totalNilai[0],
            'showForm'  => ($kip->kip_status=='spv' && $totalNilai[0]->spv >= 35 && Permission::hasRoles('Dept Head')),
            'showRevisi'=> FALSE
        ]);
    }
    
    public function viewcomitee($id)
    {
        $kip = NilaiController::getViewById($id, true);
        if(empty($kip)) abort(404);
        
        $statuses   = Status::orderBy('status_order')->get();
        $nilais     = NilaiController::getNilaiById($id);
        $totalNilai = NilaiController::getTotalNilaiById($id);
        $biayas     = Biaya::where('biaya_kip_no', $id)->get();
        $benefits   = Benefit::where('benefit_kip_no', $id)->get();

    	return view('nilai.view', [
            'kip'       => $kip,
            'nilais'    => $nilais,
            'biayas'    => $biayas,
            'benefits'  => $benefits,
            'role'      => 'comitee',
            'statuses'  => $statuses,
            'totalNilai'=> $totalNilai[0],
            'showForm'  => ((($kip->kip_status=='spv' && $totalNilai[0]->spv < 35) || ($kip->kip_status=='depthead' && $totalNilai[0]->spv >= 35)) && Permission::hasRoles('Comitee')),
            'showRevisi'=> FALSE
        ]);
    }
    
    public function save(Request $request)
    {
        // validation with kip_no & user_dept
        $kip = Kip::where('kip_no', $request->nilai_kip_no)
                    ->first();
        if(empty($kip)) abort(404);

        if($request->mode=='submit')
        {
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
        } // if submit
        else if($request->mode=='revisi')
        {
            Kip::where('kip_no', $request->nilai_kip_no)
                ->update([
                    'kip_status' => '6',
                    'kip_revision' => $request->kip_revision
                ]);
    
            Session::flash('success', 'Berhasil mengirim revisi');
        }
        
        return redirect()->back();   
    }

    public function ratiomgmt()
    {
        $ratio   = Ratio::orderBy('ratio_created_at', 'desc')->first();

    	return view('nilai.ratio', [
            'ratio' => $ratio
        ]);
    }
    
    public function ratiomgmtsave(Request $request)
    {
        $ratio = new Ratio;
        $ratio->ratio_spvdepthead= $request->ratio_spvdepthead;
        $ratio->ratio_comitee    = $request->ratio_comitee;
        $ratio->ratio_created_at = date("Y-m-d H:i:s");
        $ratio->ratio_created_by = Auth::user()->user_npk;

        $rationilai = $ratio->save();

        
        if(!$rationilai)
        {
            Session::flash('error', 'Menyimpan ratio gagal! Mohon hubungi admin');
        }
        
        Kip::where('kip_no', $request->nilai_kip_no)
            ->update([
                'kip_status' => $request->nilai_level
            ]);

        Session::flash('success', 'Berhasil menyimpan ratio');
        return redirect()->back();   

    }
}