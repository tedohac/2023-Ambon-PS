<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

class MainController extends Controller
{
    public function index()
    {
        $modules = Role::where('role_code', 'LIKE', '%000')->get();

    	return view('main', [
            'modules' => $modules
        ]);
    }
}
