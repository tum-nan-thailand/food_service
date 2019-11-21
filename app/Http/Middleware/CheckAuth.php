<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Session;
use Closure;
use Redirect;
use Illuminate\Support\Facades\DB;
class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

            if(Session::get('auth') == NULL ){
                 return Redirect::to('/auth/login');
            }else{
                $user = DB::table('st_users')
                ->where('user_id','=',''.Session::get('auth')['user_id'].'')
                ->first();
                if($user->status <> 'Y'){
                    return Redirect::to('/auth/login')->with('message','ข้อมูลผู้ใช้งาน ยังไม่ได้เปิดใช้ กรุณาติดต่อ Admin');
                }
                return $next($request);
            }

    }
}
