<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Repositories\SecurityRepository;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Cache;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    protected $auth;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function postLogin(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if ($this->auth->attempt($credentials, $request->has('remember'))) {
            $securityRepository = new SecurityRepository();

            $user = Auth::user();

            $securityRepository->makeCachePermissions($user->id);
            $role = $securityRepository->getRole($user->id);

            // Authentication passed...
            if($role->name == 'Admin'){
                return redirect()->intended('/user'); //Redirect to adm index
            } else {
                return redirect()->intended('/index'); //Redirect to user index
            }
        }
    }

    public function getLogout()
    {
        if (Auth::check()) {
            $user = Auth::user();

            $this->auth->logout();

            Cache::forget('PERMISSIONS_'.$user->id);
        }

        return redirect()->route('login');
    }

}
