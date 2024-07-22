<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller{
    
    public function create(): View{
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse{
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->first();
        if ($user && $user->role === 'doctor' && $user->status != 'active') {
            toastr()->warning('Your account is not activated yet. Please contact the admin for activation, or check your email for further instructions.');
            return redirect()->intended(RouteServiceProvider::HOME);
        }else{
            $request->authenticate();
            $request->session()->regenerate();
            $URL = RouteServiceProvider::HOME;
            if($request->user()->role === "admin"){
                $URL = RouteServiceProvider::ADMIN;
            }elseif($request->user()->role === "doctor"){
                $URL = RouteServiceProvider::DOCTOR;
            }
            toastr()->success('Welcome Back '.$request->user()->role.', You are now logged in successfully.');
            return redirect()->intended($URL);
        }
    }

    public function destroy(Request $request): RedirectResponse{
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        toastr()->info('You are logged out, See you soon!');
        return redirect('/');
    }
}