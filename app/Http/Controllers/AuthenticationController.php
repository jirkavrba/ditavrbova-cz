<?php

namespace App\Http\Controllers;

use App\Http\Requests\Authentication\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    /**
     * @return Response
     */
    public function gate(): Response
    {
        return response()->view('authentication.login');
    }

    /**
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        if (Auth::attempt($request->only('username', 'password'), true))
        {
            return redirect()->intended(route('administration.index'));
        }

        return redirect()->back()->withErrors('Bad credentials');
    }

    /**
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('application');
    }
}
