<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{

    public function showLoginForm(){
        return view('auths.login');
    }

    public function login(Request $request)
{
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
        // Jika status bukan success, Anda dapat menangani kasus lain atau menampilkan pesan kesalahan
        return view('auths.login')->with('error', 'Login failed. Please check your credentials.');
    }

}

public function logout()
{

    // Lakukan tindakan logout yang diperlukan, misalnya membersihkan sesi
    session()->forget('token.access_token');

    // Redirect ke halaman login setelah logout
    return redirect()->route('login');
}
}
