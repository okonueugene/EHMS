<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    public function redirectTo()
    {
        $role = Auth()->user()->user_type;
        if ($role == 'admin') {
            return 'admin/dashboard';
        } elseif ($role == 'doctor') {
            return 'doctor/dashboard';
        } elseif ($role == 'nurse') {
            return 'nurse/dashboard';
        } elseif ($role == 'receptionist') {
            return 'receptionist/dashboard';
        } else {
            return back();
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticated(Request $request, $user)
    {
        $user->update([
            'last_login_at' => Carbon::now()->toDateTimeString(),
            'last_login_ip' => $request->getClientIp()
        ]);
    }

    public function __invoke()
    {
        return view('auth.login');
    }

}
