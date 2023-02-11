<?php

namespace App\Http\Middleware;

use App\Permission;
use App\User;
use Auth;
use DB;
use Closure;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roles)
    {
        if (Auth::check())
        {
            if($roles!="")
            {
                $roles = explode("|",$roles);
                
                foreach($roles as $role)
                {
                    DB::enableQueryLog();
                    $permissions = Permission::where('permission_user_npk', Auth::User()->user_npk)
                                            ->where('permission_role_code', $role)->get();
                    // dd(DB::getQueryLog());
                    if(!$permissions->count()) return abort(403, 'Unauthorized');
                }
            }
            return $next($request);
        }
        return redirect()->route('login');
    }
}
