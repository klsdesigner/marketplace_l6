<?php

namespace App\Http\Middleware;

use Closure;

class UserHasStoreMiddleware
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

        //Verifica se ja existe loja para usuario
        if (auth()->user()->store->count()) {

            flash('Já existe uma loja cadastrada para esse usuário!')->warning();
            return redirect()->route('admin.stores.index');
        }


        return $next($request);
    }
}
