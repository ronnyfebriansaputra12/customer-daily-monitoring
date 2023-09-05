<?php

namespace App\Http\Controllers;

use App\Models\Teknisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class TeknisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teknisis = Teknisi::all();
        return view('teknisi.index', [
            'teknisis' => $teknisis
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validate = $request->validate([
                'nama_teknisi' => 'required',
                'email' => 'required|email',
                'kontak' => 'required',
            ]);
            Teknisi::create($validate);
            toast('Data Teknisi Berhasil di Tambahkan', 'success');
            return redirect('/teknisi');
        } catch (\Exception $e) {
            Alert::toast('Gagal Menambahkan Data', 'error');
            return back()->withErrors(['error' => 'Gagal menghapus data.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Teknisi $teknisi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teknisi $teknisi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $validation = $request->validate([
                'nama_teknisi' => 'required',
                'email' => 'required',
                'kontak' => 'required'
            ]);
            $teknisi = Teknisi::findOrFail($id);
            $teknisi->update($validation);
            toast('Data Teknisi Berhasil Diperbarui', 'success');
            return redirect('/teknisi');
        } catch (\Exception $e) {
            Alert::toast('Gagal mengubah data', 'error');
            return back()->withErrors(['error' => 'Gagal menghapus data.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $teknisi = Teknisi::findOrFail($id);
            $teknisi->delete();
            Alert::toast('Data Berhasil dihapus', 'success');
            return redirect('/teknisi');
        } catch (\Exception $e) {
            Alert::toast('Gagal mengubah data', 'error');
            return back()->withErrors(['error' => 'Gagal menghapus data.']);
        }
    }
}
