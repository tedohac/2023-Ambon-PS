<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artisan;
use Storage;
use DB;
use Auth;
use App\Kip;
use App\Nilai;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function list(){

        $KIPdraft = DB::table('kips')
        ->where('kip_created_by', Auth::user()->user_npk)
        ->where('kip_status', 'draft')
        ->count();
        $KIPsubmit = DB::table('kips')
        ->where('kip_created_by', Auth::user()->user_npk)
        ->where('kip_status', 'submit')
        ->count();
        $KIPcomitee = DB::table('kips')
        ->where('kip_created_by', Auth::user()->user_npk)
        ->where('kip_status', 'comitee')
        ->count();
        $KIPspv = DB::table('kips')
        ->where('kip_created_by', Auth::user()->user_npk)
        ->where('kip_status', 'spv')
        ->count();
        $KIPdepthead = DB::table('kips')
        ->where('kip_created_by', Auth::user()->user_npk)
        ->where('kip_status', 'depthead')
        ->count();
        $KIPrevision = DB::table('kips')
        ->where('kip_created_by', Auth::user()->user_npk)
        ->where('kip_status', 'revision')
        ->count();

        //Get data where SPV/MGR
        $getJan = DB::table('kips')
        ->where('kip_created_by', Auth::user()->user_npk)
        ->whereYear('kip_created_on', date('Y'))
        ->whereMonth('kip_created_on', 01)
        ->where('kip_status', ['spv,depthead'])
        ->count();
        $getFeb = DB::table('kips')
        ->where('kip_created_by', Auth::user()->user_npk)
        ->whereYear('kip_created_on', date('Y'))
        ->whereMonth('kip_created_on', 02)
        ->where('kip_status', ['spv,depthead'])
        ->count();
        $getMar = DB::table('kips')
        ->where('kip_created_by', Auth::user()->user_npk)
        ->whereYear('kip_created_on', date('Y'))
        ->whereMonth('kip_created_on', 03)
        ->where('kip_status', ['spv,depthead'])
        ->count();
        $getApr = DB::table('kips')
        ->where('kip_created_by', Auth::user()->user_npk)
        ->whereYear('kip_created_on', date('Y'))
        ->whereMonth('kip_created_on', 04)
        ->where('kip_status', ['spv,depthead'])
        ->count();
        $getMei = DB::table('kips')
        ->where('kip_created_by', Auth::user()->user_npk)
        ->whereYear('kip_created_on', date('Y'))
        ->whereMonth('kip_created_on', 05)
        ->where('kip_status', ['spv,depthead'])
        ->count();
        $getJun = DB::table('kips')
        ->where('kip_created_by', Auth::user()->user_npk)
        ->whereYear('kip_created_on', date('Y'))
        ->whereMonth('kip_created_on', 06)
        ->where('kip_status', ['spv,depthead'])
        ->count();
        $getJul = DB::table('kips')
        ->where('kip_created_by', Auth::user()->user_npk)
        ->whereYear('kip_created_on', date('Y'))
        ->whereMonth('kip_created_on', 07)
        ->where('kip_status', ['spv,depthead'])
        ->count();
        $getAgu = DB::table('kips')
        ->where('kip_created_by', Auth::user()->user_npk)
        ->whereYear('kip_created_on', date('Y'))
        ->whereMonth('kip_created_on', 8)
        ->where('kip_status', ['spv,depthead'])
        ->count();
        $getSep = DB::table('kips')
        ->where('kip_created_by', Auth::user()->user_npk)
        ->whereYear('kip_created_on', date('Y'))
        ->whereMonth('kip_created_on', 9)
        ->where('kip_status', ['spv,depthead'])
        ->count();
        $getOkt = DB::table('kips')
        ->where('kip_created_by', Auth::user()->user_npk)
        ->whereYear('kip_created_on', date('Y'))
        ->whereMonth('kip_created_on', 10)
        ->where('kip_status', ['spv,depthead'])
        ->count();
        $getNov = DB::table('kips')
        ->where('kip_created_by', Auth::user()->user_npk)
        ->whereYear('kip_created_on', date('Y'))
        ->whereMonth('kip_created_on', 11)
        ->where('kip_status', ['spv,depthead'])
        ->count();
        $getDes = DB::table('kips')
        ->where('kip_created_by', Auth::user()->user_npk)
        ->whereYear('kip_created_on', date('Y'))
        ->whereMonth('kip_created_on', 12)
        ->where('kip_status', ['spv,depthead'])
        ->count();

        //Get data where comitee
        $getComiteeJan = DB::table('kips')
        ->where('kip_created_by', Auth::user()->user_npk)
        ->whereYear('kip_created_on', date('Y'))
        ->whereMonth('kip_created_on', 01)
        ->where('kip_status', 'comitee')
        ->count();
        $getComiteeFeb = DB::table('kips')
        ->where('kip_created_by', Auth::user()->user_npk)
        ->whereYear('kip_created_on', date('Y'))
        ->whereMonth('kip_created_on', 02)
        ->where('kip_status', 'comitee')
        ->count();
        $getComiteeMar = DB::table('kips')
        ->where('kip_created_by', Auth::user()->user_npk)
        ->whereYear('kip_created_on', date('Y'))
        ->whereMonth('kip_created_on', 03)
        ->where('kip_status', 'comitee')
        ->count();
        $getComiteeApr = DB::table('kips')
        ->where('kip_created_by', Auth::user()->user_npk)
        ->whereYear('kip_created_on', date('Y'))
        ->whereMonth('kip_created_on', 04)
        ->where('kip_status', 'comitee')
        ->count();
        $getComiteeMei = DB::table('kips')
        ->where('kip_created_by', Auth::user()->user_npk)
        ->whereYear('kip_created_on', date('Y'))
        ->whereMonth('kip_created_on', 05)
        ->where('kip_status', 'comitee')
        ->count();
        $getComiteeJun = DB::table('kips')
        ->where('kip_created_by', Auth::user()->user_npk)
        ->whereYear('kip_created_on', date('Y'))
        ->whereMonth('kip_created_on', 06)
        ->where('kip_status', 'comitee')
        ->count();
        $getComiteeJul = DB::table('kips')
        ->where('kip_created_by', Auth::user()->user_npk)
        ->whereYear('kip_created_on', date('Y'))
        ->whereMonth('kip_created_on', 07)
        ->where('kip_status', 'comitee')
        ->count();
        $getComiteeAgu = DB::table('kips')
        ->where('kip_created_by', Auth::user()->user_npk)
        ->whereYear('kip_created_on', date('Y'))
        ->whereMonth('kip_created_on', 8)
        ->where('kip_status', 'comitee')
        ->count();
        $getComiteeSep = DB::table('kips')
        ->where('kip_created_by', Auth::user()->user_npk)
        ->whereYear('kip_created_on', date('Y'))
        ->whereMonth('kip_created_on', 9)
        ->where('kip_status', 'comitee')
        ->count();
        $getComiteeOkt = DB::table('kips')
        ->where('kip_created_by', Auth::user()->user_npk)
        ->whereYear('kip_created_on', date('Y'))
        ->whereMonth('kip_created_on', 10)
        ->where('kip_status', 'comitee')
        ->count();
        $getComiteeNov = DB::table('kips')
        ->where('kip_created_by', Auth::user()->user_npk)
        ->whereYear('kip_created_on', date('Y'))
        ->whereMonth('kip_created_on', 11)
        ->where('kip_status', 'comitee')
        ->count();
        $getComiteeDes = DB::table('kips')
        ->where('kip_created_by', Auth::user()->user_npk)
        ->whereYear('kip_created_on', date('Y'))
        ->whereMonth('kip_created_on', 12)
        ->where('kip_status', 'comitee')
        ->count();

        $sumSpvMgr = $getJan+$getFeb+$getMar+$getApr+$getMei+$getJun+$getJul+$getAgu+$getSep+$getOkt+$getNov+$getDes;
        $sumComitee = $getComiteeJan+$getComiteeFeb+$getComiteeMar+$getComiteeApr+$getComiteeMei+$getComiteeJun+$getComiteeJul+$getComiteeAgu+$getComiteeSep+$getComiteeOkt+$getComiteeNov+$getComiteeDes;
        $totalJan = $getJan+$getComiteeJan;
        $totalFeb = $getFeb+$getComiteeFeb;
        $totalMar = $getMar+$getComiteeMar;
        $totalApr = $getApr+$getComiteeApr;
        $totalMei = $getMei+$getComiteeMei;
        $totalJun = $getJun+$getComiteeJun;
        $totalJul = $getJul+$getComiteeJul;
        $totalAgu = $getAgu+$getComiteeAgu;
        $totalSep = $getSep+$getComiteeSep;
        $totalOkt = $getOkt+$getComiteeOkt;
        $totalNov = $getNov+$getComiteeNov;
        $totalDes = $getDes+$getComiteeDes;

        // $kiplist = DB::select(
        //             DB::raw("
        //             select
        //             a.kip_created_on, 
        //                 CASE
        //                     WHEN IFNULL(spv.vw_total, 0) >= 35 THEN
        //                         TRUNCATE((((IFNULL(spv.vw_total, 0)+IFNULL(depthead.vw_total, 0))/2)*40/100)+(IFNULL(comitee.vw_total, 0)*60/100), 2)
        //                     ELSE
        //                         TRUNCATE((IFNULL(spv.vw_total, 0)*40/100)+(IFNULL(comitee.vw_total, 0)*60/100), 2)
        //                 END as 'final'
        //             FROM 
        //                 kips a 
        //                 LEFT JOIN vw_sum_nilai spv ON a.kip_no=spv.vw_kip_no AND spv.vw_level='spv' 
        //                 LEFT JOIN vw_sum_nilai depthead ON a.kip_no=depthead.vw_kip_no AND depthead.vw_level='depthead' 
        //                 LEFT JOIN vw_sum_nilai comitee ON a.kip_no=comitee.vw_kip_no AND comitee.vw_level='comitee'
        //                 LEFT JOIN statuses s ON a.kip_status=s.status_code
        //             WHERE
        //                 a.kip_created_by='".Auth::user()->user_npk."'
        //             ")
        //         );

        // $count_man = count($kiplist);
        // dd($count_man);

        return view('dashboard', [
            'KIPdraft' => $KIPdraft,
            'KIPsubmit' => $KIPsubmit,
            'KIPcomitee' => $KIPcomitee,
            'KIPspv' => $KIPspv,
            'KIPdepthead' => $KIPdepthead,
            'KIPrevision' => $KIPrevision,
            'getJan' => $getJan,
            'getFeb' => $getFeb,
            'getMar' => $getMar,
            'getApr' => $getApr,
            'getMei' => $getMei,
            'getJun' => $getJun,
            'getJul' => $getJul,
            'getAgu' => $getAgu,
            'getSep' => $getSep,
            'getOkt' => $getOkt,
            'getNov' => $getNov,
            'getDes' => $getDes,
            'getComiteeJan' => $getComiteeJan,
            'getComiteeFeb' => $getComiteeFeb,
            'getComiteeMar' => $getComiteeMar,
            'getComiteeApr' => $getComiteeApr,
            'getComiteeMei' => $getComiteeMei,
            'getComiteeJun' => $getComiteeJun,
            'getComiteeJul' => $getComiteeJul,
            'getComiteeAgu' => $getComiteeAgu,
            'getComiteeSep' => $getComiteeSep,
            'getComiteeOkt' => $getComiteeOkt,
            'getComiteeNov' => $getComiteeNov,
            'getComiteeDes' => $getComiteeDes,
            'sumSpvMgr' => $sumSpvMgr,
            'sumComitee' => $sumComitee,
            'totalJan' => $totalJan,
            'totalFeb' => $totalFeb,
            'totalMar' => $totalMar,
            'totalApr' => $totalApr,
            'totalMei' => $totalMei,
            'totalJun' => $totalJun,
            'totalJul' => $totalJul,
            'totalAgu' => $totalAgu,
            'totalSep' => $totalSep,
            'totalOkt' => $totalOkt,
            'totalNov' => $totalNov,
            'totalDes' => $totalDes
            // 'kiplist' => $kiplist
        ]);
    }
}
