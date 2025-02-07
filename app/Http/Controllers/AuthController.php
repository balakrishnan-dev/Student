<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // Show Registration Form
    public function showRegister()
    {
        return view('auth.register');
    }

    // Send OTP
    public function sendOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required|numeric|digits:10|unique:users,phone',
        ]);

        $otp = rand(100000, 999999);
        Session::put('otp', $otp);
        Session::put('phone', $request->phone);

        // Here, you should integrate an SMS API to send OTP to the user's phone.

        return response()->json(['message' => 'OTP sent successfully!', 'otp' => $otp]);
    }

    // Register User
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|numeric|digits:10|unique:users,phone',
            'otp' => 'required|digits:6',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($request->otp != Session::get('otp') || $request->phone != Session::get('phone')) {
            return back()->withErrors(['otp' => 'Invalid OTP!']);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'otp' => null, // OTP is verified, so we reset it
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registration successful!');
    }
}
