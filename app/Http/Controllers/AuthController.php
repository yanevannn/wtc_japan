<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function login()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    function doLogin(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($data)) {

            return redirect()->route('dashboard');
        } else {
            return redirect()->route('login')->withErrors('Email dan Password salah !');
        }
    }

    function register()
    {
        return view('auth.register');
    }

    function doRegister(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email|email:rfc,dns|unique:users,email',
                'password' => [
                    'required',
                    'string',
                    'min:8',
                    'regex:/[A-Z]/',       // Harus ada huruf besar
                    'regex:/[a-z]/',       // Harus ada huruf kecil
                    'regex:/[0-9]/',       // Harus ada angka
                    'regex:/[@$!%*?&#]/',  // Harus ada karakter spesial
                ],
            ]
        );

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'user'
        ];

        User::create($data);

        return redirect()->route('login')->withErrors('Registrasi berhasil, silahkan login !');

    }

    function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
