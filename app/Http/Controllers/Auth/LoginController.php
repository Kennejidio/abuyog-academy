<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectTo()
    {
        $role = "";
        if (Auth::user()->hasRole(["Student"])) {
            $role = "Student";
        }  else if (Auth::user()->hasRole(["Semi-admin"])) {
            $role = "Semi-admin";
        } else if (Auth::user()->hasRole(["Admin"])) {
            $role = "Admin";
        }
        // dd($role);
        switch ($role) {
            case 'Admin':
                $id = Auth::user()->id;
                return '/admin/' . $id . '/dashboard';
                break;
            case 'Semi-admin':
                $id = Auth::user()->id;
                return '/admin/' . $id . '/dashboard';
                break;
            case 'Student':
                $id = Auth::user()->id;
                return '/students/' . $id . '/dashboard';
                break;

            default:
                return '/home';
                break;
        }
    }
}
