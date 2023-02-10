<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kip;
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

    	return view('kip.list_spv', [
            'kips' => $kips
        ]);
    }
}