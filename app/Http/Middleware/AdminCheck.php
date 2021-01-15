<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\UserRole;
use Illuminate\Support\Facades\Auth;
class AdminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user_id = $request->user()->id;

        $role = DB::select("SELECT * FROM `user_role` WHERE `user_id` = $user_id AND `role_id` = 4");

        if ($role){
            return $next($request);

        }else {
            var_dump($user_id);
            return redirect('unauthorized');
        }


    }
}
