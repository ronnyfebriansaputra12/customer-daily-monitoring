<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeskirpsiPekerjaan;
use RealRashid\SweetAlert\Facades\Alert;

class DeskirpsiPekerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deskirpsiPekerjaans = DeskirpsiPekerjaan::all();
        return view('deskripsi-pekerjaan.index', compact('deskirpsiPekerjaans'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DeskirpsiPekerjaan $deskirpsiPekerjaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DeskirpsiPekerjaan $deskirpsiPekerjaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'deskripsi_pekerjaan' => 'required',
            'keterangan' => 'required',
            'status_perpengerjaan' => 'required',
            'catatan' => 'required'
        ]);
        try {
            $deskirpsiPekerjaan = DeskirpsiPekerjaan::findOrFail($id);
            $deskirpsiPekerjaan->update($validatedData);
            toast('Data berhasil diupdate','success');
            return redirect('/deskripsi-pekerjaan');
    
        } catch (\Exception $e) {
            Alert::toast('Gagal mengubah data', 'error');
            return back()->withErrors(['error' => 'Gagal mengubah data.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeskirpsiPekerjaan $deskirpsiPekerjaan)
    {
        //
    }
}
