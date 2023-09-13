<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\User;
use App\Models\Teknisi;
use App\Models\Pengerjaan;
use App\Models\WorkingOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class WorkingOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = Auth::user()->role;
        $user_id = Auth::user()->id;

        if ($role == 'admin') {
            $workingOrders = WorkingOrder::all();
            return view('workingOrder.index', [
                'workingOrders' => $workingOrders
            ]);
        } elseif ($role == 'user') {
            $workingOrders = WorkingOrder::where('user_id', $user_id)->get();
            return view('workingOrder.index', [
                'workingOrders' => $workingOrders
            ]);
        }
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
        $validate = $request->validate([
            'no_working_order' => 'required|unique:working_orders|max:255',
            'user_id' => 'required|exists:users,id|integer'
        ]);

        WorkingOrder::create($validate);
        toast('Working Order Berhasil Ditambahkan', 'success');
        return redirect('/working-order');
    }

    function pengerjaan($id)
    {
        $workingOrder = WorkingOrder::find($id);
        $user = User::find($workingOrder->user_id);
        $pengkerjaan = Pengerjaan::find($id);
        $alat = Alat::all();
        // Mengambil semua pengerjaan
        $pengerjaan = Pengerjaan::all();

        // Menyimpan ID teknisi yang sudah ada dalam semua pengerjaan
        $existingTeknisiIds = $pengerjaan->pluck('teknisi_id')->toArray();

        // Inisialisasi daftar teknisi yang akan ditampilkan
        $teknisi = Teknisi::whereNotIn('id', $existingTeknisiIds);

        // Membuat daftar ID pengerjaan yang memiliki status "selesai"
        $pengerjaanSelesaiIds = $pengerjaan->where('status', 'selesai')->pluck('id')->toArray();

        // Jika ada pengerjaan dengan status "selesai", maka teknisi yang sudah ada ditambahkan kembali ke daftar
        if (!empty($pengerjaanSelesaiIds)) {
            $teknisi->orWhereIn('id', $existingTeknisiIds);
        }

        $teknisi = $teknisi->get();



        return view('pengerjaan.create', [
            'workingOrder' => $workingOrder,
            'pengkerjaan' => $pengkerjaan,
            'id' => $id,
            'alat' => $alat,
            'teknisis' => $teknisi,
            'user' => $user
        ]);
    }





    /**
     * Display the specified resource.
     */
    public function show(WorkingOrder $workingOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WorkingOrder $workingOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WorkingOrder $workingOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $workingOrder = WorkingOrder::findOrFail($id);
            $workingOrder->delete();
            Alert::toast('Data Berhasil dihapus', 'success');
            return redirect('/working-order');
        } catch (\Exception $e) {
            Alert::toast('Gagal mengubah data', 'error');
            return back()->withErrors(['error' => 'Gagal menghapus data.']);
        }
    }
}
