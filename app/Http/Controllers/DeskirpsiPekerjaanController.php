<?php

namespace App\Http\Controllers;

use App\Models\DeskirpsiPekerjaan;
use Illuminate\Http\Request;

class DeskirpsiPekerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deskirpsiPekerjaans = DeskirpsiPekerjaan::all();
        return view('deskripsi-pekerjaan.index',compact('deskirpsiPekerjaans'));
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
    public function update(Request $request, DeskirpsiPekerjaan $deskirpsiPekerjaan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeskirpsiPekerjaan $deskirpsiPekerjaan)
    {
        //
    }
}
