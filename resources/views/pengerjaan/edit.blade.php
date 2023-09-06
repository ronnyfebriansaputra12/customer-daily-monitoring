@extends('layouts.master')

@section('title', 'Update Pengerjaan')
{{-- @section('header', 'Pengeluaran') --}}
@section('breadcrumb', 'Update Pengerjaan')
@section('container-fluid')

    <div class="container">
        <a href="/pengerjaan" class="btn btn-primary"><i class="fas fa-solid fa-arrow-left"></i></a>

        <div class="card border-primary mt-3 mb-3">
            <div class="card-header">Update Proggress Pekerjaan</div>
            <div class="card-body">
                <form action="/pengerjaan/{{ $pengerjaans->id }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="input-group mb-3" hidden>
                        @php
                            $user_admin_id = Auth::user()->id;
                        @endphp
                        <input type="text" class="form-control @error('user_admin_id') is-invalid @enderror"
                            name="user_admin_id" value="{{ $user_admin_id }}" placeholder="User ID">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @error('user_admin_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="no_working_order">No Working Order
                            </label>
                            <div class="input-group mb-3">

                                <input type="text" class="form-control @error('no_working_order') is-invalid @enderror"
                                    name="no_working_order"
                                    value="{{ old('no_working_order', $pengerjaans->no_working_order) }}" readonly
                                    placeholder="No Working Order">
                                @error('no_working_order')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6" hidden>
                            <label for="user_id">Customer</label>
                            <div class="input-group mb-3">

                                <input type="text" class="form-control @error('user_id') is-invalid @enderror"
                                    name="user_id" value="{{ old('user_id', $pengerjaans->user_id) }}" readonly
                                    placeholder="No Working Order">
                                @error('user_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Alat ID Input -->
                            <label for="unit_engine">Unit / Engine</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control @error('unit_engine') is-invalid @enderror"
                                    name="unit_engine" value="{{ old('unit_engine', $pengerjaans->unit_engine) }}"
                                    placeholder="Unit / Engine">
                                @error('unit_engine')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Serial Number -->
                            <label for="serial_number">Serial Number</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control @error('serial_number') is-invalid @enderror"
                                    name="serial_number" value="{{ old('serial_number', $pengerjaans->serial_number) }}"
                                    placeholder="Serial Number">
                                @error('serial_number')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Tanggal Masuk Input -->
                            <label for="tanggal_masuk">Tanggal Masuk</label>
                            <div class="input-group mb-3">
                                <input type="date" class="form-control" name="tanggal_masuk"
                                    value="{{ old('tanggal_masuk', $pengerjaans->tanggal_masuk) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Status Input -->
                            <label for="status">Status</label>
                            <div class="input-group mb-3">
                                <select class="form-control" name="status">
                                    <option value="belum konfirmasi" @if ($pengerjaans->status == 'belum konfirmasi ' ? 'selected' : '') selected @endif>Belum
                                        Konfirmasi</option>
                                    <option value="sedang dikerjakan" @if ($pengerjaans->status == 'sedang dikerjakan'? 'selected' : '') selected @endif>
                                        Sedang di Kerjakan</option>
                                    <option value="pending" @if ($pengerjaans->status == 'pending'? 'selected' : '') selected @endif>
                                        Pending</option>
                                    <option value="selesai" @if ($pengerjaans->status == 'selesai'? 'selected' : '') selected @endif>Selesai
                                    </option>
                                </select>

                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <!-- Tanggal Update Input -->
                            <label for="tanggal_update">Tanggal Update</label>
                            <div class="input-group mb-3">
                                <input type="date" class="form-control" name="tanggal_update"
                                    value="{{ old('tanggal_update', $pengerjaans->tanggal_update) }}">
                            </div>
                        </div>
                        <!-- Tambahkan ini di bawah elemen "select" -->
                        {{-- <div id="tanggal_selesai_div" class="col-md-12" style="display: none;">
                            <label for="tanggal_selesai">Tanggal Selesai</label>
                            <div class="input-group mb-3">
                                <input type="date" class="form-control" name="tanggal_selesai"
                                    value="{{ old('tanggal_selesai', $pengerjaans->tanggal_selesai) }}">
                            </div>
                        </div> --}}
                        <div class="col-md-6">
                            <!-- Alat ID Input -->
                            <label for="teknisi_id">Teknisi</label>
                            <div class="input-group mb-3">
                                <select class="form-control @error('teknisi_id') is-invalid @enderror" name="teknisi_id">
                                    <option value="">Pilih Teknisi</option>
                                    @foreach ($teknisis as $p)
                                        <option value="{{ $p->id }}"
                                            {{ old('teknisi_id', $pengerjaans->teknisi_id) == $p->id ? 'selected' : '' }}>
                                            {{ $p->nama_teknisi }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('teknisi_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                       
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Keterangan Input -->
                            <label for="keterangan">Keterangan</label>
                            <div class="input-group mb-3">
                                <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan"
                                    rows="4" placeholder="Deskripsi Pengerjaan">{{ old('keterangan', $pengerjaans->keterangan) }}</textarea>
                                @error('keterangan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Estimasi Pengerjaan Input -->
                            <label for="estimasi_pengerjaan">Estimasi Pengerjaan</label>
                            <div class="input-group mb-3">
                                <input type="text"
                                    class="form-control @error('estimasi_pengerjaan') is-invalid @enderror"
                                    name="estimasi_pengerjaan"
                                    value="{{ old('estimasi_pengerjaan', $pengerjaans->estimasi_pengerjaan) }}"
                                    placeholder="Estimasi Pengerjaan">
                                @error('estimasi_pengerjaan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        

                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Deskripsi Pengerjaan Input -->
                            <label for="deskripsi_pekerjaan">Deskripsi Pengerjaan</label>
                            <div class="input-group mb-3">
                                <!-- Display the value of deskripsi_pekerjaan using a textarea -->
                                <textarea class="form-control @error('deskripsi_pekerjaan') is-invalid @enderror" name="deskripsi_pekerjaan"
                                    rows="4" placeholder="Deskripsi Pengerjaan">{{ old('deskripsi_pekerjaan', $pengerjaans->deskripsi_pekerjaan) }}</textarea>
                                @error('deskripsi_pekerjaan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <a href="/working-order" class="btn btn-danger mr-2"><i class="fas fa-times"></i> Batal</a>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>


        </div>
        </form>
    </div>

    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // Mengamati perubahan pada elemen "select" dengan nama "status"
            $('select[name="status"]').on('change', function() {
                var selectedValue = $(this).val();
                if (selectedValue === 'selesai') {
                    // Jika yang dipilih adalah "selesai", tampilkan input "Tanggal Update"
                    $('#tanggal_selesai_div').show();
                } else {
                    // Jika yang dipilih bukan "selesai", sembunyikan input "Tanggal Update"
                    $('#tanggal_selesai_div').hide();
                }
            });

            // Set status awal saat halaman dimuat
            var initialStatus = $('select[name="status"]').val();
            if (initialStatus === 'selesai') {
                $('#tanggal_selesai_div').show();
            } else {
                $('#tanggal_selesai_div').hide();
            }
        });
    </script> --}}

@endsection
