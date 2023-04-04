<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;

class Permission extends Model
{
    protected $table = 'permissions';
    public $timestamps = false;
    
    public static function getCountByUser($user_npk)
    {
        return Permission::where('permission_user_npk', $user_npk)
                                ->count();
    }
    
    public static function getByUser($user_npk)
    {

        $query = "
            select 
                r.role_code, max(r.role_desc) role_desc, max(r.role_icon) role_icon, max(r.role_url) role_url
            from 
                permissions p
                join rolelines l on p.permission_roleline_id=l.roleline_id
                join roles r on l.roleline_role_code=r.role_code
            where permission_user_npk='".$user_npk."'
            group by r.role_code
        ";
        
        return DB::select(
            DB::raw($query)
        );

        // return Permission::join('rolelines', 'rolelines.roleline_id', '=', 'permissions.permission_roleline_id')
        //                 ->join('roles', 'roles.role_code', '=', 'rolelines.roleline_role_code')
        //                 ->whereNotNull('role_icon')
        //                 ->where('permission_user_npk', $user_npk)
        //                 // ->where('permission_role_code', 'like', '%'.$role_base_code.'%')
        //                 ->get();
    }
    
    /**
     * Check the role of authenticated user.
     * @param $role_names
     * @return bool
     */
    public static function hasRoles($role_code)
    {
        $user = Permission::join('rolelines', 'rolelines.roleline_id', '=', 'permissions.permission_roleline_id')
                          ->where('permission_user_npk', Auth::User()->user_npk)
                          ->where('roleline_role_code', $role_code)->first();
        if(empty($user)) return false;
        else return true;
    }
    
    public static function hasRoleLine($user_deptline)
    {
        $user = Permission::join('rolelines', 'rolelines.roleline_id', '=', 'permissions.permission_roleline_id')
                          ->where('permission_user_npk', Auth::User()->user_npk)
                          ->where('roleline_deptline_id', $user_deptline)->first();
        if(empty($user)) return false;
        else return true;
    }
}
