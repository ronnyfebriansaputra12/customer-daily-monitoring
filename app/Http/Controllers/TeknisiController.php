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
        return view('teknisi.index',[
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
        $validate = $request->validate([
            'nama_teknisi' => 'required',
            'email' => 'required|email',
            'kontak' => 'required',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:4|same:password',
        ]);

        $validate['password'] = Hash::make($request->password);
        $validate['password_confirmation'] = Hash::make($request->password_confirmation);
        

        Teknisi::create($validate);
        toast('Data Teknisi Berhasil di Tambahkan','success');
        return redirect('/teknisi');
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
    public function update(Request $request, Teknisi $teknisi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teknisi $teknisi)
    {
        //
    }
}
