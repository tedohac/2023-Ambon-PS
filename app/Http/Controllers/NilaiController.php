<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kip;
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
                        ->where('user_dept', Auth::user()->user_dept)->get();

    	return view('nilai.list', [
            'kips' => $kips,
            'role' => 'SPV',
        ]);
    }
    
    public function view($id)
    {
        $kip = Kip::join('users', 'users.user_npk', '=', 'kips.kip_created_by')
                    ->where('kip_no', $id)->first();
        if(empty($kip)) abort(404);
        
        $statuses = Status::orderBy('status_order')->get();

    	return view('nilai.view', [
            'kip'       => $kip,
            'role'      => 'SPV',
            'statuses'  => $statuses
        ]);
    }
}