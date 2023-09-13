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
        // dd($request->all());
        $validatedData = $request->validate([
            'no_working_order' => 'required',
            'unit_engine' => 'required',
            'serial_number' => 'required',
            'teknisi_id' => 'required|integer',
            'user_id' => 'required|integer',
            'user_admin_id' => 'required|integer',
            'tanggal_masuk' => 'required|date',
            'status' => 'required|max:255',
            'estimasi_pengerjaan' => 'required',

        ]);

        $no_working_order = $validatedData['no_working_order'];
        // $user_id = $validatedData['user_id'];
        Pengerjaan::create($validatedData);

        // Update the status of the related WorkingOrder
        WorkingOrder::where('no_working_order', $no_working_order)->update([
            'status' => 'proses'
        ]);

        // DeskirpsiPekerjaan::where('user_id', $user_id)->update([
        //     'status_perpengerjaan' => 'sedang dikerjakan'
        // ]);
        toast('Working Order Berhasil Ditambahkan', 'success');
        return redirect('/pengerjaan');
    }

    function insertDeskripsi($id)
    {
        $pengerjaan = Pengerjaan::find($id);
        return view('deskripsi-pekerjaan.create', [
            'pengerjaan' => $pengerjaan,
            'id' => $id,
        ]);
    }

    function insertDeskripsiProses(Request $request)
    {
        // dd($request->all());
        // Validasi data input
        $validatedData = $request->validate([
            'deskripsi_pekerjaan' => 'required',
            'keterangan' => 'required',
            'tanggal_selesai_perpengerjaan' => 'required|date',
            'pengerjaan_id' => 'required',
            'user_id' => 'required',
            'tanggal_mulai_pengerjaan' => 'required'
        ]);

        // Data yang akan disimpan dalam database
        $dataToInsert = [
            'deskripsi_pekerjaan' => $request->input('deskripsi_pekerjaan'),
            'keterangan' => $request->input('keterangan'),
            'tanggal_selesai_perpengerjaan' => $request->input('tanggal_selesai_perpengerjaan'),
            'pengerjaan_id' => $request->input('pengerjaan_id'),
            'user_id' => $request->input('user_id'),
            'tanggal_mulai_pengerjaan' => $request->input('tanggal_mulai_pengerjaan'),
        ];

        // Simpan data ke dalam database menggunakan model DeskripsiPekerjaan
        DeskirpsiPekerjaan::create($dataToInsert);

        // Redirect ke halaman yang sesuai setelah penyimpanan data
        return redirect('/deskripsi-pekerjaan');
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pengerjaan = Pengerjaan::where('id', $id)->get();
        return view('pengerjaan.detail', compact('pengerjaan'));
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
        // dd($request->all());
        $validatedData = $request->validate([
            'no_working_order' => 'required',
            'unit_engine' => 'required',
            'serial_number' => 'required',
            'teknisi_id' => 'required|integer',
            'user_id' => 'required|integer',
            'user_admin_id' => 'required|integer',
            'tanggal_masuk' => 'required|date',
            'status' => 'required|max:255',
            'keterangan' => 'required'
        ]);

        // Find the existing Pengerjaan by its ID
        $pengerjaan = Pengerjaan::findOrFail($id);

        // Update the Pengerjaan with the validated data
        $pengerjaan->update($validatedData);

        $history = [
            'pengerjaan_id' => $pengerjaan->id,
            'keterangan' => $request->keterangan
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
