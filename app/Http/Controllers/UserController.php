<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\User;

class UserController extends Controller
{
    public function list()
    {
        $users = User::get();

    	return view('user.list', [
            'users' => $users
        ]);
    }

    public function new()
    {    	
        $roles = Role::get();

        return view('user.new', [
            'roles' => $roles
        ]);
    }
    
    public function edit($id)
    {
        $user = User::where('user_npk', $id)->first();

    	return view('user.edit', [
            'user' => $user
        ]);
    }
}
