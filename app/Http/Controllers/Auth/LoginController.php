<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    // Show Login Form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle Login Request
    public function login(Request $request)
    {
        // Validate the login form input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')
                             ->withErrors($validator)
                             ->withInput();
        }

        // Attempt to login the user
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect()->intended('dashboard'); // Redirect to the intended page (e.g. Dashboard)
        } else {
            return redirect()->route('login')
                             ->with('error', 'Invalid credentials provided.');
        }
    }

    // Logout User
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
