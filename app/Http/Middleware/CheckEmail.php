<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckEmail
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
        // Verifica se user não está logado, se não estiver redireciona p/ page login
        if (!auth()->check()) {
            return redirect(route('login.form'));
        }
        
        // Se o user estiver autenticado o email dele será capturado
        $email = auth()->user()->email;
        // a string será dividida a partir do @
        $data = explode('@', $email);
        // recebe tudo que está depois do @
        $servidorEmail = $data[1];

        // 
        if ($servidorEmail != 'gmail.com') {
            # code...
            return redirect(route('login.form'));
        }

        return $next($request);
    }
}
