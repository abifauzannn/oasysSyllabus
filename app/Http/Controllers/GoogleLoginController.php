<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle()
    {
        // URL untuk melakukan redirect ke Google untuk otentikasi
        $googleAuthUrl = "https://be.brainys.oasys.id/api/login/google";

        // Lakukan redirect
        return redirect()->away($googleAuthUrl);
    }

    // Metode ini akan dipanggil oleh Google setelah pengguna berhasil melakukan otentikasi
    public function handleGoogleCallback(Request $request)
    {
        // Tangani callback dari Google setelah otentikasi berhasil
        // $code = $request->input('code');
        // Lakukan yang diperlukan dengan kode yang diterima dari Google
    }
}
