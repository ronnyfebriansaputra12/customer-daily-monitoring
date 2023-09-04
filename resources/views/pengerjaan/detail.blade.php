@extends('layouts.master')

@section('title', 'Detail Pengerjaan')
{{-- @section('header', 'Pengeluaran') --}}
@section('breadcrumb', 'Detail Pengerjaan')
@section('container-fluid')

    <div class="container">

        <a href="/pengerjaan" class="btn btn-primary"><i class="fas fa-solid fa-arrow-left"></i></a>
        @foreach ($pengerjaan as $item)
            <div class="card mt-3">
                <div class="card-header">
                    Detail Proggress {{ $item->no_working_order }}
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Customer</th>
                            <td>:</td>
                            <td>{{ $item->user->name }}</td>
                        </tr>
                        <tr>
                            <th>Unit / Engine</th>
                            <td>:</td>
                            <td>{{ $item->unit_engine }}</td>
                        </tr>
                        <tr>
                            <th>Serial Number</th>
                            <td>:</td>
                            <td>{{ $item->serial_number }}</td>
                        </tr>
                        <tr>
                            <th>Teknisi</th>
                            <td>:</td>
                            <td>{{ $item->teknisi->nama_teknisi }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Masuk</th>
                            <td>:</td>
                            <td>{{ $item->tanggal_masuk }}</td>
                        </tr>
                        <tr>
                            <th>Estimasi Pengerjaan</th>
                            <td>:</td>
                            <td>{{ $item->estimasi_pengerjaan }}</td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                            <td>:</td>
                            <td>{{ $item->keterangan }}</td>
                        </tr>
                        <tr>
                            <th>Deskripsi Pekerjaan</th>
                            <td>:</td>
                            <td>{{ $item->deskripsi_pekerjaan }}</td>
                        </tr>
                        <tr>
                            @if ($item->status == 'Belum Konfirmasi')
                                <th>Status</th>
                                <td>:</td>
                                <td><span class="badge bg-danger">Belum Konfirmasi</span></td>
                            @elseif ($item->status == 'pending')
                                <th>Status</th>
                                <td>:</td>
                                <td><span class="badge bg-warning">Pending</span></td>
                            @elseif ($item->status == 'sedang dikerjakan')
                                <th>Status</th>
                                <td>:</td>
                                <td><span class="badge bg-info">On Proggress</span></td>
                            @elseif ($item->status == 'selesai')
                                <th>Status</th>
                                <td>:</td>
                                <td><span class="badge bg-success">Selesai</span></td>
                            @endif

                        </tr>
                    </table>
                </div>
            </div>
        @endforeach

    </div>

@endsection
