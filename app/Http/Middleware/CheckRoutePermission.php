<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\URL;
use \Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\Route;

class CheckRoutePermission
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $previousUrl = URL::previous();

        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response()->json(
                    [
                        'status' => 0,
                        'code' => 401,
                        'message' => 'No permission to operate',
                    ]
                );
            } else {
                return redirect()->guest('auth/login');
            }
        }
        if (!Auth::user()->can(Route::currentRouteName())) {
            if ($request->ajax()) {
                return response()->json(
                    [
                        'status' => 0,
                        'code' => 401,
                        'message' => 'No permission to operate',
                    ]
                );
            } else {
                return redirect('admin/errors/401')->with('previousUrl', $previousUrl);
            }
        }
        return $next($request);
    }
}
