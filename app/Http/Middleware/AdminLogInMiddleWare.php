<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class AdminLogInMiddleWare
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
        if(Auth::check()){
            $user = Auth::user();
            if($user->level == 1){
                return $next($request);
            }else{
                return redirect('admin/dangnhap')->with('alert', 'Bạn không có quyền đăng nhập vào trang nè!');
            }
        }else{
            return redirect('admin/dangnhap');
        }
    }
}
