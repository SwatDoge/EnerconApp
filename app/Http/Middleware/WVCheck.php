<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WVCheck
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

        $role = DB::select("SELECT * FROM `user_role` WHERE `user_id` = $user_id AND `role_id` = 1");

        if ($role){
            return $next($request);

        }else {
            var_dump($user_id);
            return response()->json('Geen bevoegdheid', 401);
        }
    }
}
