<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;
use App\Role;
use App\User;
use Hash;
use Session;

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

    public function save(Request $request)
    {    	
        $userCheck = User::where('user_npk', $request->user_npk)->first();

        if(!empty($userCheck))
        {
            Session::flash('error', 'NPK Already exists');
            return redirect()->back();
        }

        $user = new User;
        $user->user_npk     = $request->user_npk;
        $user->user_name    = $request->user_name;
        $user->user_dept    = $request->user_dept;
        $user->user_line    = $request->user_line;
        $user->user_status  = (isset($request->user_status)) ? '1' : '0';
        $user->user_password= Hash::make($request->user_password);
        $simpanuser = $user->save();
        
        if($simpanuser)
        {
            // save biaya
            if(count($request->user_permissions) > 0)
            {
                foreach ($request->user_permissions as $permissionReq) {
                    $permission = new Permission;
                    $permission->permission_user_npk    = $request->user_npk;
                    $permission->permission_role_code   = $permissionReq;
                    $simpanpermission = $permission->save();   
    
                    if(!$simpanpermission)
                    {
                        Session::flash('error', 'Menyimpan permission gagal! Mohon hubungi admin');
                        return redirect()->back();   
                    }       
                }
            }

            Session::flash('success', 'User saved succesfuly');
            return redirect()->route('user.list');   
        
        } else {
            Session::flash('error', 'Menyimpan user gagal! Mohon hubungi admin');
            return redirect()->back();   
        }
    }
}
