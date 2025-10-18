<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Public registration: no role selection (role default: salesman)
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|max:30',
            'password' => ['required','confirmed', Password::min(8)],
        ]);

        $salesmanRoleId = Roles::where('name','salesman')->first()->id ?? null;

        $user = User::create([
            'name' => $request->name,
            'email'=> $request->email,
            'phone'=> $request->phone,
            'password'=> Hash::make($request->password),
            'role_id' => $salesmanRoleId,
        ]);

        auth()->login($user);

        return redirect()->route('home');
    }
}
