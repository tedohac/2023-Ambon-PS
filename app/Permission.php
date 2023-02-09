<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
        return Permission::join('roles', 'roles.role_code', '=', 'permissions.permission_role_code')
                        ->whereNotNull('role_icon')
                        ->where('permission_user_npk', $user_npk)
                        // ->where('permission_role_code', 'like', '%'.$role_base_code.'%')
                                ->get();
    }
    
    /**
     * Check the role of authenticated user.
     * @param $role_names
     * @return bool
     */
    public static function hasRoles($role_code)
    {
        if (Auth::check())
        {
            $user = Permission::where('user_npk', Auth::User()->user_npk)->where('role_code', $role_code)->first();
            if(empty($user)) return false;
            else return true;
        }
        else return false;
    }
}
