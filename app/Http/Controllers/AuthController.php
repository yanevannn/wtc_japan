<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Pengumuman;
use App\Models\UserVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    function login()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('main.auth.login');
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
                return redirect()->route('login')->withInput()->with('warning', 'Akun belum diverifikasi, silahkan cek email untuk verifikasi akun !');
            } else {
                return redirect()->route('dashboard');
            }
        } else {
            return redirect()->route('login')->withInput()->with('error', 'Email dan Password salah !');
        }
    }

    function register()
    {
        return view('main.auth.register');
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
                'fname' => 'required|string|max:255',
                'lname' => 'required|string|max:255',
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
            ],
            [
                'email.email' => 'Format email tidak valid !',
                'email.unique' => 'Email sudah terdaftar !',
                'email.email' => 'Format email tidak valid !',
                'password.required' => 'Password tidak boleh kosong !',
                'password.min' => 'Password minimal 8 karakter !',
                'password.regex' => 'Password harus mengandung huruf besar, huruf kecil, angka, dan karakter spesial !'
            ]
        );

        $token = $this->generateToken();
        // Data untuk menyimpan user
        $userData = [
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'user'
        ];

        // Mulai transaksi untuk menjaga konsistensi data
        DB::transaction(function () use ($userData, $request, $token) {
            // Membuat user
            $user = User::create($userData);

            // Membuat record untuk verifikasi email
            UserVerify::create([
                'email' => $request->email,
                'token' => $token
            ]);

            // Membuat relasi siswa langsung dengan status_pendaftaran_id = 1
            $user->siswa()->create([
                'status_siswa_id' => 1,
                'status_pendaftaran_id' => 1,
            ]);
        });

        Mail::send(
            'main.auth.email-verification',
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

            if ($dataUser->email_verified_at != null) {
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

    function profile()
    {
        $user = Auth::user();
        if ($user->role === 'user' && $user->siswa->no_ktp === null) {
            return redirect()->route('form.personal.index')
                ->with('info', 'Silakan lengkapi data diri Anda terlebih dahulu.');
        }
        return view('main.users.profile', compact('user'));
    }

    public function index()
    {
        if (Auth::user()->role != 'admin') {
            $announcements = Pengumuman::where('is_published', true)
                ->orderBy('created_at', 'desc')
                ->get();
            return view('main.users.dashboard-users', compact('announcements'));
        }
        $data = Siswa::where('status_siswa_id', 1)->count();
        return view('main.admin.dashboard-admin', compact('data',));
    }
}
