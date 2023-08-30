<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AlatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alat =  Alat::all();
        return view('alat.index',[
            'alats' => $alat
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
            'nama_alat' => 'required|max:255',
        ]);

        Alat::create($validate);
        toast('Data Berhasil Ditambahkan','success');
        return redirect('/alat');
    }

    /**
     * Display the specified resource.
     */
    public function show(Alat $alat)
    {
        $alat = Alat::find($alat->id);
        return response()->json([
            'status' => 200,
            'alat' => $alat
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alat $alat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alat $alat)
    {
        $validate = $request->validate([
            'nama_alat' => 'required|max:255',
        ]);

        toast('Data Berhasil Diupdate','success');
        Alat::where('id',$alat->id)->update($validate);
        return redirect('/alat');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alat $alat)
    {   
        Alat::destroy($alat->id);
        toast('Data Berhasil Dihapus','success');
        return redirect('/alat');
    }
}
