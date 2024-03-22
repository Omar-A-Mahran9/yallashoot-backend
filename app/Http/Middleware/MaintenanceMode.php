<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MaintenanceMode
{

    public function handle(Request $request, Closure $next)
    {

        if(settings()->getSettings('maintenance_mode') == 1)
        {
            if(!$request->is('maintenance'))
                return redirect('/maintenance');
        }
        else if($request->is('maintenance'))
            return redirect('/');

        return $next($request);
    }
}
