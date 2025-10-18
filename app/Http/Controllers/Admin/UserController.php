<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        // only admin and super-admin can manage users
        $this->middleware('role:admin|super-admin');
    }

    public function index()
    {
        $users = User::with('role')->paginate(20);
        return view('backend.user.index', compact('users'));
    }

    public function create()
    {
        $roles = Roles::all();
        return view('backend.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string',
            'email'=>'required|email|unique:users',
            'phone'=>'required|string',
            'role_id'=>'required|exists:roles,id',
            'password'=>'nullable|min:8|confirmed',
        ]);

        $password = $request->password ? Hash::make($request->password) : Hash::make('password');

        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'role_id'=>$request->role_id,
            'password'=>$password,
        ]);

        return redirect()->route('admin.users.index')->with('success','User created.');
    }
}
