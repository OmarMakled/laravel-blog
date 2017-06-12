<?php

/*
 * This file is part of Minimum Blog Project for AqarMap 2017.
 *
 * @author Omar Makled <omar.makled@gmail.com>
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show login form
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth/login');
    }

    public function postLogin(Request $request)
    {
        return $this->attemptLogin($request)
            ? $this->sendLoginResponse($request)
            : $this->sendFailedLoginResponse($request);
    }

    protected function attemptLogin(Request $request)
    {
        return Auth::guard()->attempt(
            $request->only('email', 'password'), $request->has('remember')
        );
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();
        return redirect()->intended('/');
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = ['email' => trans('auth.failed')];

        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }

        return redirect()->back()
            ->withInput($request->only('email', 'remember'))
            ->withErrors($errors);
    }

    public function getLogout(Request $request)
    {
        Auth::guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect('/');
    }
}
