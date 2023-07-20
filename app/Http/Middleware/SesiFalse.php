<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class SesiFalse
{

    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            redirect('/login');
        } else {
            Alert::error('Gagal', 'Anda tidak dapat akses halaman ini');
            return redirect('/dashboard');
        }
        return $next($request);
    }
}
