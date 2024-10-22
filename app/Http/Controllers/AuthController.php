<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function register(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'nullable|string|max:15',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Create new user
        $user = User::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role' => 'user',
        ]);

        // Redirect to login page after registration
        return redirect()->route('showLoginForm')->with('success', 'Registration successful. Please login.');
    }

    // Login function
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('showinformationIndex');
            } else {
                return redirect()->route('userAccount')->with('success', 'เข้าสู่ระบบสำเร็จแล้ว');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    // Logout function
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('userForms')->with('success', 'คุณออกจากระบบแล้ว');
    }
}
