<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        // Check if the user exists
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Invalid credentials.');
        }

        // Log the user in
        Auth::login($user);

        // Redirect to the Super Admin dashboard or any protected route
        return redirect()->route('clientDetails');
    }

    // Logout function
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
