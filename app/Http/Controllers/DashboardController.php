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

        $KIPCount = DB::select(
                DB::raw("
                select 
                    a.status_code, 
                    (select count(*) from kips where kip_status=a.status_code) as jlh 
                from statuses a 
                order by a.status_order
                ")
                    );

        DB::statement("create TEMPORARY table bulan (bln varchar(2));");
        DB::statement("insert into bulan values ('01'),('02'),('03'),('04'),('05'),('06'),('07'),('08'),('09'),('10'),('11'),('12');");
        
        $KIPLevel = DB::select(
            DB::raw("
                SELECT
                    bulan.bln,
                    (select count(*) from kips where EXTRACT(YEAR FROM kip_created_on)='2023' AND EXTRACT(MONTH FROM kip_created_on)=bulan.bln AND kip_status in ('spv', 'depthead')) spvdepthead,
                    (select count(*) from kips where EXTRACT(YEAR FROM kip_created_on)='2023' AND EXTRACT(MONTH FROM kip_created_on)=bulan.bln AND kip_status='comitee') comitee
                FROM
                    bulan
            ")
       );
       
       $KIPRange = DB::select(
        DB::raw("
            SELECT
                bulan.bln,
                (select final from kips a LEFT JOIN vw_final final ON a.kip_no=final.kip_no WHERE EXTRACT(YEAR FROM a.kip_created_on)='2023' AND EXTRACT(MONTH FROM a.kip_created_on)=bulan.bln AND final > 0 AND final<=15) 0_15,
                (select final from kips a LEFT JOIN vw_final final ON a.kip_no=final.kip_no WHERE EXTRACT(YEAR FROM a.kip_created_on)='2023' AND EXTRACT(MONTH FROM a.kip_created_on)=bulan.bln AND final > 16 final<=25) 16_25,
                (select final from kips a LEFT JOIN vw_final final ON a.kip_no=final.kip_no WHERE EXTRACT(YEAR FROM a.kip_created_on)='2023' AND EXTRACT(MONTH FROM a.kip_created_on)=bulan.bln AND final > 26 final<=35) 26_35,
                (select final from kips a LEFT JOIN vw_final final ON a.kip_no=final.kip_no WHERE EXTRACT(YEAR FROM a.kip_created_on)='2023' AND EXTRACT(MONTH FROM a.kip_created_on)=bulan.bln AND final > 36 final<=45) 36_45,
                (select final from kips a LEFT JOIN vw_final final ON a.kip_no=final.kip_no WHERE EXTRACT(YEAR FROM a.kip_created_on)='2023' AND EXTRACT(MONTH FROM a.kip_created_on)=bulan.bln AND final > 46 final<=55) 46_55,
                (select final from kips a LEFT JOIN vw_final final ON a.kip_no=final.kip_no WHERE EXTRACT(YEAR FROM a.kip_created_on)='2023' AND EXTRACT(MONTH FROM a.kip_created_on)=bulan.bln AND final > 56 final<=60) 56_60,
                (select final from kips a LEFT JOIN vw_final final ON a.kip_no=final.kip_no WHERE EXTRACT(YEAR FROM a.kip_created_on)='2023' AND EXTRACT(MONTH FROM a.kip_created_on)=bulan.bln AND final > 61 final<=60) 61_70,
            FROM
                bulan
        ")
   );


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
            'KIPCount' => $KIPCount,
            'KIPLevel' => $KIPLevel,
            'KIPRange' => $KIPRange
            // 'kiplist' => $kiplist
        ]);
    }
}
