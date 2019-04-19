<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckLoginAdmin
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
        if (Auth::check()) {

            $user = Auth::user();

            if ($user->role_id == 3) {
                Auth::logout();
                return redirect('login')->with('fail', __('message.fail.permission'));
            } else {
                if ($user->active != 1) {
                    Auth::logout();
                    return redirect('login')->with('fail', __('message.fail.approval'));
                }

                return $next($request);
            }
        }

        return redirect('login')->with('fail', __('message.fail.check'));
    }
}
