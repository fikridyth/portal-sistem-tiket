<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        $title = 'Login Portal';
        return view('auth.login', compact('title'));
    }

    public function loginSubmit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('index');
        } else {
            return redirect()->back()->withInput()->withErrors(["Wrong Email or Password!"]);
        }
    }

    public function registerSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'role' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ];

        User::create($data);

        return Redirect::route('auth.login')
            ->with('alert.status', '00')
            ->with('alert.message', "Create User Success!");
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return Redirect(route('auth.login'));
    }
}
