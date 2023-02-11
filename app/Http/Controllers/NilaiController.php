<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kip;
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
        $kips = Kip::join('users', 'users.user_npk', '=', 'kips.kip_created_by')
                    ->join('statuses', 'statuses.status_code', '=', 'kips.kip_status')
                        ->where('user_dept', Auth::user()->user_dept)->get();

    	return view('nilai.list', [
            'kips' => $kips,
            'role' => 'spv',
        ]);
    }
    
    public function viewspv($id)
    {
        $kip = Kip::join('users', 'users.user_npk', '=', 'kips.kip_created_by')
                    ->where('kip_no', $id)->first();
        if(empty($kip)) abort(404);
        
        $statuses = Status::orderBy('status_order')->get();

    	return view('nilai.view', [
            'kip'       => $kip,
            'role'      => 'spv',
            'statuses'  => $statuses,
            'showForm'  => ($kip->kip_status=='submit' && Permission::hasRoles('SPV'))
        ]);
    }
}