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

        // Mengambil data pengerjaan berdasarkan user_id dengan status "sedang dikerjakan" atau "pending"
        $pengerjaans = Pengerjaan::where('user_id', $user_id)
            ->whereIn('status', ['sedang dikerjakan', 'pending'])
            ->get();

        // Mengambil data deskripsi_pekerjaan berdasarkan id_pengerjaan dari user yang login
        $deskripsi_pekerjaan = DeskirpsiPekerjaan::whereIn('pengerjaan_id', $pengerjaans->pluck('id'))
            ->get();

        // Mengelompokkan pengerjaan dan deskripsi pengerjaan berdasarkan nomor working order
        $pengerjaanByWorkingOrder = [];
        foreach ($pengerjaans as $pengerjaan) {
            $pengerjaanByWorkingOrder[$pengerjaan->no_working_order][] = $pengerjaan;
        }


        $deskripsiByWorkingOrder = [];
        foreach ($deskripsi_pekerjaan as $deskripsi) {
            $deskripsiByWorkingOrder[$deskripsi->pengerjaan->no_working_order][] = $deskripsi;
        }


        // Kirim data ke view
        return view('dashboard', compact('pengerjaanByWorkingOrder', 'deskripsiByWorkingOrder'));
    }
}
