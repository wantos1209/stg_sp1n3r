<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if (Auth::guest()) {
            return redirect('/p3dJu4N645'); // arahkan pengguna ke halaman login jika tidak terotentikasi
        }

        if (!($user->divisi === 'admin' || $user->divisi === 'superadmin')) {
            return abort(403, 'Forbidden');
        }

        return $next($request);
    }
}
