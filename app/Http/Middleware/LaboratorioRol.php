<?php

namespace App\Http\Middleware;

use Closure;

class LaboratorioRol
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
        if (!isset(Auth::user()->nombreUsuario)) {
            return redirect('/login');
        }
        $user_actual=\Auth::user();
        if($user_actual->tipoUsuario!='laboratorio'){
            return redirect('/home');
        }
        return $next($request);   
    }
}
