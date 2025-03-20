<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserVerify;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
            if (Auth::user()->email_verified_at == null) {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Akun belum diverifikasi, silahkan cek email untuk verifikasi akun !');
            } else {
                return redirect()->route('dashboard');
            }
        } else {
            return redirect()->route('login')->withErrors('Email dan Password salah !');
        }
    }

    function register()
    {
        return view('auth.register');
    }

    function generateToken()
    {
        $number = '1234567890';
        return substr(str_shuffle($number), 0, 4);
    }

    function doRegister(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                // 'email' => 'required|email|email:rfc,dns|unique:users,email',
                'email' => 'required|email|unique:users,email',
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

        $token = $this->generateToken();

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'user'
        ];

        User::create($data);

        $cekToken = UserVerify::where('email', $request->email)->first();
        if ($cekToken) {
            UserVerify::where('email', $request->email)->delete();
        }

        $data = [
            'email' => $request->email,
            'token' => $token
        ];

        UserVerify::create($data);

        Mail::send(
            'auth.email-verification',
            ['token' => $token],
            function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Verifikasi Email');
            }
        );

        return redirect()->route('register')->with('success', 'Registrasi berhasil, silahkan cek email untuk verifikasi akun !')->withInput();
    }

    function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    function verifyAccount($token)
    {
        $cekToken = UserVerify::where('token', $token)->first();
        if (!is_null($cekToken)) {
            $email = $cekToken->email;
            $dataUser = User::where('email', $email)->first();

            if ($dataUser->email_verified_at =! null) {
                return redirect()->route('login')->with('info', 'Akun sudah diverifikasi sebelumnya!');
            } else {
                $data = [
                    'email_verified_at' => Carbon::now()
                ];
                User::where('email', $email)->update($data);
                UserVerify::where('email', $email)->delete();
            }
            return redirect()->route('login')->with('success', 'Akun berhasil diverifikasi, silahkan login !');
        } else {
            return redirect()->route('login')->with('info', 'Akun sudah diverifikasi sebelumnya!');
        }
    }
}
