<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class SesiTrue
{

    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            redirect('/dashboard');
        } else {
            Alert::error('Gagal', 'Anda tidak dapat akses halaman ini');
            return redirect('/login');
        }
        return $next($request);
    }
}
