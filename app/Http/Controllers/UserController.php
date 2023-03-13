<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Deptline;
use App\Permission;
use App\Role;
use App\Roleline;
use App\User;
use Hash;
use Session;

class UserController extends Controller
{
    public function list()
    {
        $users = User::join('deptlines', 'deptlines.line_id', '=', 'users.user_deptline')->get();

    	return view('user.list', [
            'users' => $users
        ]);
    }

    public function new()
    {    	
        $rolelines = Roleline::join('roles', 'roles.role_code', '=', 'rolelines.roleline_role_code')
                             ->join('deptlines', 'deptlines.line_id', '=', 'rolelines.roleline_deptline_id')
                             ->orderBy('roleline_id')
                             ->get();
        $deptlines = Deptline::get();

        return view('user.new', [
            'rolelines' => $rolelines,
            'deptlines' => $deptlines
        ]);
    }
    
    public function edit($id)
    {
        $user       = User::where('user_npk', $id)->first();
        $rolelines  = Roleline::join('roles', 'roles.role_code', '=', 'rolelines.roleline_role_code')
                              ->join('deptlines', 'deptlines.line_id', '=', 'rolelines.roleline_deptline_id')
                              ->orderBy('roleline_id')
                              ->get();
        $deptlines  = Deptline::get();
        $permissions= Permission::where('permission_user_npk', $id)->pluck('permission_roleline_id')->toArray();

    	return view('user.edit', [
            'user'          => $user,
            'rolelines'     => $rolelines,
            'permissions'   => $permissions,
            'deptlines' => $deptlines
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
        $user->user_deptline= $request->user_deptline;
        $user->user_status  = (isset($request->user_status)) ? '1' : '0';
        $user->user_password= Hash::make($request->user_password);
        $simpanuser = $user->save();
        
        if($simpanuser)
        {
            // save biaya
            if(isset($request->user_permissions))
            {
                foreach ($request->user_permissions as $permissionReq) {
                    $permissionArr = explode ("-", $permissionReq);

                    $permission = new Permission;
                    $permission->permission_user_npk    = $request->user_npk;
                    $permission->permission_roleline_id = $permissionArr[0];
                    $simpanpermission = $permission->save();   
    
                    if(!$simpanpermission)
                    {
                        Session::flash('error', 'Menyimpan permission gagal! Mohon hubungi admin');
                        return redirect()->back();   
                    }       
                }
            }

            Session::flash('success', 'Berhasil menyimpan user');
            return redirect()->route('user.list');   
        
        } else {
            Session::flash('error', 'Menyimpan user gagal! Mohon hubungi admin');
            return redirect()->back();   
        }
    }
    
    public function update(Request $request)
    {    	
        $user = User::where('user_npk', $request->user_npk)->first();
        if(empty($user)) abort(404);

        $datas = [
            'user_name'     => $request->user_name,
            'user_deptline' => $request->user_deptline,
            'user_status'   => (isset($request->user_status)) ? '1' : '0'
        ];

        if($request->user_password!="")
        {
            $datas['user_password'] = Hash::make($request->user_password);
        }

        User::where('user_npk',$request->user_npk)
            ->update($datas);

            
        // delete Permissions before insert
        Permission::where('permission_user_npk', $request->user_npk)->delete();

        print_r($user_permissions);

        // // save Permissions
        // if(isset($request->user_permissions))
        // {
        //     foreach ($request->user_permissions as $permissionReq) {
        //         $permissionArr = explode ("-", $permissionReq);

        //         $permission = new Permission;
        //         $permission->permission_user_npk    = $request->user_npk;
        //         $permission->permission_roleline_id = $permissionArr[0];
        //         $simpanpermission = $permission->save();   

        //         if(!$simpanpermission)
        //         {
        //             Session::flash('error', 'Menyimpan permission gagal! Mohon hubungi admin');
        //             return redirect()->back();   
        //         }       
        //     }
        // }

        // Session::flash('success', 'Berhasil mengubah user');
        // return redirect()->route('user.list');  
    }
    
    public function changepass()
    {    	
        return view('user.changepass');
    }

    public function changepasssave(Request $request)
    {
        if(!Hash::check($request->current_password, auth()->user()->user_password))
        {
            Session::flash('error', 'Current password salah!');
            return redirect()->back();   
        }

        User::where('user_npk', auth()->user()->user_npk)
            ->update([
                'user_password'     => Hash::make($request->user_password)
            ]);

            
        Session::flash('success', 'Berhasil mengubah password');
        return redirect()->back();   
    }
}
