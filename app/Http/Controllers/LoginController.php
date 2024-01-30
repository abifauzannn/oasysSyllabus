<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;


class LoginController extends Controller
{

    public function showLoginForm(){
        return view('auths.login');
    }

    public function login(Request $request)
{
    try {
        // Mengambil nilai email dan password dari form input
        $email = $request->input('email');
        $password = $request->input('password');

        // Membuat instance dari GuzzleHttp\Client
        $http = new \GuzzleHttp\Client;

        // Mengirim permintaan POST ke API login dengan menggunakan nilai email dan password dari form input
        $response = $http->post('https://be.brainys.oasys.id/api/login', [
            'form_params' => [
                'email' => $email,
                'password' => $password
            ]
        ]);

        // Mendekode respons JSON
        $result = json_decode((string) $response->getBody(), true);

        if ($result['status'] == 'success') {
            // Mendapatkan data dari respons
            $data = $result['data'];

            // Menyimpan token di dalam session jika diperlukan
            session()->put('token.access_token', $data['token']);
            // Menyimpan data pengguna di dalam session
            session()->put('user_data', $data['user']);

            // Mengembalikan hasil dan menyertakan data ke view
            return view('syllabusPages.dashboard', compact('data'));
        } else {
            // Jika status bukan success, menangani kasus lain atau menampilkan pesan kesalahan dari server
            $errorMessage = isset($result['message']) ? $result['message'] : 'Login failed. Please check your credentials.';

            // Menggunakan withErrors untuk menyimpan pesan kesalahan dalam sesi
            return redirect()->route('login')->withErrors(['error' => $errorMessage]);
        }
    } catch (\GuzzleHttp\Exception\ClientException $e) {
        $response = $e->getResponse();
        $errorMessage = json_decode((string) $response->getBody(), true)['message'] ?? 'An error occurred during login.';

        return redirect()->route('login')->withErrors(['error' => $errorMessage]);
    }
}

public function logout()
{

    // Lakukan tindakan logout yang diperlukan, misalnya membersihkan sesi
    session()->forget('token.access_token');

    // Redirect ke halaman login setelah logout
    return redirect()->route('login');
}

public function redirectToGoogle()
{
    // Mengarahkan pengguna langsung ke URL pilihan akun Google
    return redirect('https://be.brainys.oasys.id/api/login/google/');
}

public function handleGoogleCallback(Request $request)
{
    try {
        // Mendapatkan informasi pengguna dari respons Google
        $response = json_decode($request->getContent(), true);

        // Pastikan respons memiliki informasi yang diperlukan
        if (isset($response['id'], $response['email'], $response['token'])) {
            // Cari atau buat pengguna baru berdasarkan email dari Google
            $existingUser = User::where('email', $response['email'])->first();

            if ($existingUser) {
                // Jika pengguna sudah ada, login pengguna
                Auth::login($existingUser);
            } else {
                // Jika pengguna belum ada, buat pengguna baru
                $newUser = new User();
                $newUser->name = $response['name'] ?? null;
                $newUser->email = $response['email'];
                // Atur properti lain yang ingin Anda ambil dari respons Google
                $newUser->save();

                // Login pengguna baru
                Auth::login($newUser);
            }

            // Redirect pengguna ke halaman dashboard setelah login berhasil
            return redirect()->route('dashboard');
        }
    } catch (\Exception $e) {
        return redirect('/login')->with('error', 'Terjadi kesalahan saat login menggunakan Google.');
    }

    return redirect('/login')->with('error', 'Data respons tidak valid.');
}

public function showDashboard()
{
    // Mendapatkan data pengguna yang telah login
    $userData = Auth::user();

    // Tampilkan data di halaman dashboard
    return view('dashboard', compact('userData'));
}


}



