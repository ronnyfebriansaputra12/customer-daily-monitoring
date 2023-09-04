<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\User;
use App\Models\History;
use App\Models\Teknisi;
use App\Models\Pengerjaan;
use App\Models\WorkingOrder;
use Illuminate\Http\Request;
use App\Models\DeskirpsiPekerjaan;
use RealRashid\SweetAlert\Facades\Alert;

class PengerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengerjaans = Pengerjaan::all();
        return view('pengerjaan.index', compact('pengerjaans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pengerjaan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'no_working_order' => 'required',
            'unit_engine' => 'required',
            'serial_number' => 'required',
            'teknisi_id' => 'required|integer',
            'user_id' => 'required|integer',
            'user_admin_id' => 'required|integer',
            'tanggal_masuk' => 'required|date',
            'keterangan' => 'required|max:255',
            'status' => 'required|max:255',
            'estimasi_pengerjaan' => 'required',
            'deskripsi_pekerjaan' => 'max:255'
        ]);

        $no_working_order = $validatedData['no_working_order'];

        // Update the status of the related WorkingOrder
        WorkingOrder::where('no_working_order', $no_working_order)->update([
            'status' => 'proses'
        ]);

        // Create a new Pengerjaan and get its ID
        $pengerjaan = Pengerjaan::create($validatedData);
        $pengerjaan_id = $pengerjaan->id;

        $deskripsi_pekerjaan = [
            'deskripsi_pekerjaan' => $request->deskripsi_pekerjaan,
            'pengerjaan_id' => $pengerjaan_id, // Assign the pengerjaan_id
            'keterangan' => $request->keterangan
        ];

        DeskirpsiPekerjaan::create($deskripsi_pekerjaan);

        toast('Working Order Berhasil Ditambahkan', 'success');
        return redirect('/pengerjaan');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pengerjaan = Pengerjaan::where('id',$id)->get();
        return view('pengerjaan.detail',compact('pengerjaan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengerjaan $pengerjaan)
    {
        $pengerjaans = $pengerjaan;
        $alats = Alat::all();
        $teknisis = Teknisi::all();
        return view('pengerjaan.edit', compact('pengerjaans', 'alats', 'teknisis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'no_working_order' => 'required',
            'unit_engine' => 'required',
            'serial_number' => 'required',
            'teknisi_id' => 'required|integer',
            'user_id' => 'required|integer',
            'user_admin_id' => 'required|integer',
            'tanggal_masuk' => 'required|date',
            'tanggal_update' => 'required|date',
            'keterangan' => 'required|max:255',
            'status' => 'required|max:255',
            'estimasi_pengerjaan' => 'required',
            'deskripsi_pekerjaan' => 'max:255'
        ]);

        // Find the existing Pengerjaan by its ID
        $pengerjaan = Pengerjaan::findOrFail($id);

        // Update the Pengerjaan with the validated data
        $pengerjaan->update($validatedData);

        // Update the related DeskripsiPekerjaan
        $deskripsi_pekerjaan = [
            'deskripsi_pekerjaan' => $request->deskripsi_pekerjaan,
            'pengerjaan_id' => $pengerjaan->id,
            'tanggal_update' => $request->tanggal_update,
            'status' => $request->status,
            'keterangan' => $request->keterangan
        ];

        // Find or create DeskripsiPekerjaan based on pengerjaan_id
        DeskirpsiPekerjaan::create($deskripsi_pekerjaan);

        $history = [
            'pengerjaan_id' => $pengerjaan->id,
            'keterangan' => $request->keterangan,
        ];

        if ($request->status == 'selesai') {
            History::create($history);
            $no_working_order = $validatedData['no_working_order'];

            // Update the status of the related WorkingOrder
            WorkingOrder::where('no_working_order', $no_working_order)->update([
                'status' => 'selesai'
            ]);
        }

        toast('Working Order Berhasil Diperbarui', 'success');
        return redirect('/pengerjaan');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $pengerjaan = Pengerjaan::findOrFail($id);
            $pengerjaan->delete();
            Alert::toast('Data Berhasil dihapus', 'success');
            return redirect('/pengerjaan');
        } catch (\Exception $e) {
            Alert::toast('Gagal mengubah data', 'error');
            return back()->withErrors(['error' => 'Gagal menghapus data.']);
        }
    }
}
