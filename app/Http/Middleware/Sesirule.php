<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class Sesirule
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    public function handle(Request $request, Closure $next)
    {

        if (Auth::check()) {
            if (Auth::user()->role != "admin") {
                Alert::error('Gagal', 'Anda tidak dapat akses halaman ini');
                return redirect('/');
            }
        }else {
            Alert::error('Gagal', 'Anda tidak dapat akses halaman ini');
                return redirect('/login');
        }
        return $next($request);
    }
}
