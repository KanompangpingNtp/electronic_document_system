<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // ตรวจสอบว่าผู้ใช้ล็อกอินหรือไม่
        if (!Auth::check()) {
            return redirect()->route('showLoginForm')->with('error', 'คุณต้องเข้าสู่ระบบก่อน');
        }

        // ตรวจสอบว่าบทบาทของผู้ใช้ตรงกับบทบาทที่ร้องขอหรือไม่
        if (Auth::user()->role !== $role) {
            return redirect()->route('userForms')->with('error', 'คุณไม่มีสิทธิ์เข้าถึงหน้านี้');
        }

        return $next($request);
    }
}
