<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $url = '';
        if ($request->user()->user_type === 'super admin'){
            $url = '/superAdmin/dashboard';

        }elseif($request->user()->user_type === 'company employee'){

            if($request->user()->status === 'active'){
                $url = 'companyEmployee/dashboard';
            }else{
                Auth::guard('web')->logout();

                $request->session()->invalidate();

                $request->session()->regenerateToken();

                $url ='/user/inactive';
            }


        }elseif($request->user()->user_type === 'administrator'){

            if($request->user()->status === 'active'){
                $url = 'administrator/dashboard';
            }else{
                Auth::guard('web')->logout();

                $request->session()->invalidate();

                $request->session()->regenerateToken();

                $url ='/user/inactive';
            }



        }elseif($request->user()->user_type === 'user'){

            if($request->user()->status === 'active'){
                $url = '/user/dashboard';
            }else{
                Auth::guard('web')->logout();

                $request->session()->invalidate();

                $request->session()->regenerateToken();

                $url ='/user/inactive';
            }
        }


        return redirect()->intended( $url );
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

