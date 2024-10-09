<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminRegistation extends Controller
{
    public function AdminRegistation(Request $request)
{
    $request->validate([
        'user_name' => 'required|string|max:255',
        'user_email' => 'required|email|unique:users,email',
        'user_password' => 'required|string|min:8',
    ]);

    $user = new User;
    $user->name = $request->user_name;
    $user->email = $request->user_email;
    $user->password = Hash::make($request->user_password); // Hash the password

    $user->save();

    return back()->with('success', 'Admin registered successfully!');
}
}
