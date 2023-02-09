<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;

class MainController extends Controller
{
    public function index()
    {
        //$menus = Role::where('role_code', 'LIKE', '%000')->get();
        $menus = App\Permission::getByUser(auth()->user()->user_npk);

    	return view('main', [
            'menus' => $menus
        ]);
    }
}
