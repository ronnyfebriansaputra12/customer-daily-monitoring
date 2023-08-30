<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\User;
use App\Models\Pengerjaan;
use App\Models\Teknisi;
use App\Models\WorkingOrder;
use Illuminate\Http\Request;

class WorkingOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $workingOrders = WorkingOrder::all();
        return view('workingOrder.index',[
            'workingOrders' => $workingOrders
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
        $validate = $request->validate([
            'no_working_order' => 'required|unique:working_orders|max:255',
            'user_id' => 'required|exists:users,id|integer'
        ]);

        WorkingOrder::create($validate);
        toast('Working Order Berhasil Ditambahkan', 'success');
        return redirect('/working-order');
    }

    function pengerjaan($id) {
        $workingOrder = WorkingOrder::find($id);
        $user = User::find($workingOrder->user_id);
        $pengkerjaan = Pengerjaan::find($id);
        $alat = Alat::all();
        $teknisi = Teknisi::all();
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
    public function destroy(WorkingOrder $workingOrder)
    {
        //
    }
}