<?php
namespace TCG\Voyager\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Contracts\Auth\Factory as AuthFactory;

class VoyagerAdminMiddleware
{
    /**
     * The guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;


    public function __construct()
    {
        $this->auth = Auth::guard('admin');;
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
        if (!$this->auth->guest()) {
            $user = Voyager::model('User')->find($this->auth->id());
            return $user->hasPermission('browse_admin') ? $next($request) : redirect('/');
        }
        $urlLogin = route('voyager.login');
        $urlIntended = $request->url();
        if ($urlIntended == $urlLogin) {
            $urlIntended = null;
        }
        return redirect($urlLogin)->with('url.intended', $urlIntended);
    }
}