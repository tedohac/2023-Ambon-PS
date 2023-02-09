<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KipController extends Controller
{
    public function listown()
    {
    	return view('kip.list_own');
    }
}
