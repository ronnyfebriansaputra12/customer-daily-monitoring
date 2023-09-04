<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Pengerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        if (Auth::user()->role == 'admin') {
            // Jika pengguna memiliki peran admin, tampilkan seluruh data history
            $historys = History::all();
        } else {
            // Jika pengguna tidak memiliki peran admin, ambil data berdasarkan user_id
            $historys = History::whereHas('pengerjaan', function ($query) {
                $query->whereHas('user', function ($subQuery) {
                    $subQuery->where('users.id', auth()->user()->id);
                });
            })->get();
        }

        return view('history.index', compact('historys'));
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
    public function show(History $history)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(History $history)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, History $history)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(History $history)
    {
        //
    }
}
