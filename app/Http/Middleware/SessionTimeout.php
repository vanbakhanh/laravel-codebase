<?php

namespace App\Http\Middleware;

use Closure;
use Cookie;
use Auth;
use Illuminate\Session\Store;

/**
 * Class SessionTimeout.
 */
class SessionTimeout
{
    /**
     * @var Store
     */
    protected $session;

    /**
     * @param Store $session
     */
    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //Cookie Name for when 'remember me' is checked
        $rememberCookie = Auth::guard()->getRecallerName();

        if (!Cookie::has($rememberCookie) && config('session.timeout_status')) {
            $isLoggedIn = $request->path() != '/logout';

            if (!session('lastActivityTime')) {
                $this->session->put('lastActivityTime', time());

            } elseif (time() - $this->session->get('lastActivityTime') > config('session.timeout')) {
                $this->session->forget('lastActivityTime');
                $cookie = cookie('intend', $isLoggedIn ? url()->current() : 'admin/');

                Auth::logout();

                return redirect()->route('login')->with('warning', trans('notification.general.timeout', ['minutes' => config('session.timeout') / 60]))->withCookie($cookie);
            }

            $isLoggedIn ? $this->session->put('lastActivityTime', time()) : $this->session->forget('lastActivityTime');
        }

        return $next($request);
    }
}
