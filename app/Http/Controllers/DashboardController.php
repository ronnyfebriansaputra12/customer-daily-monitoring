<?php

namespace App\Http\Controllers;

use App\Models\DeskirpsiPekerjaan;
use App\Models\Pengerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Mendapatkan ID user yang sedang login
        $user_id = Auth::user()->id;

        $pekerjaan = Pengerjaan::where('user_id',$user_id)->get();
        $deskripsi_pekerjaan = DeskirpsiPekerjaan::where('user_id',$user_id)->get();

        // Kirim data ke view
        return view('dashboard', compact('deskripsi_pekerjaan','pekerjaan'));
    }
}
