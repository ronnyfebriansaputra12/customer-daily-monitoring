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
        $user_id = Auth::user()->id;

        // Mengambil data pengerjaans berdasarkan user_id
        $pengerjaans = Pengerjaan::where('user_id', $user_id)->get();

        // Mengambil data deskripsi_pekerjaan berdasarkan id_pengerjaan dari user yang login
        $deskripsi_pekerjaan = DeskirpsiPekerjaan::whereIn('pengerjaan_id', $pengerjaans->pluck('id'))->get();
        return view('dashboard', compact('pengerjaans', 'deskripsi_pekerjaan'));
    }
}
