<?php

// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Cek apakah pengguna sedang login
        if (Auth::check()) {
            // Pengguna sedang login, dapatkan data pengguna
            $userData = Auth::user();

            // Tampilkan data pengguna pada halaman dashboard
            return view('dashboard', compact('userData'));
        } else {
            // Jika pengguna tidak login, redirect ke halaman login
            return redirect()->route('login');
        }
    }

}

