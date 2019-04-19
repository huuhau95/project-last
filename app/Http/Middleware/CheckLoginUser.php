<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckLoginUser
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

            if ($user->active != 1) {
                Auth::logout();
                return redirect('login')->with('fail', __('message.fail.active'));
            }
            return $next($request);
        }

        return redirect('login')->with('fail', __('message.fail.check'));
    }
}
