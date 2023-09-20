@extends('layouts.master')

@section('title', 'Create Pengerjaan')
{{-- @section('header', 'Pengeluaran') --}}
@section('breadcrumb', 'Create Pengerjaan')
@section('container-fluid')

    <div class="container">

        <div class="row">
            {{-- <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center font-weight-bold mt-3">Detail</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="text-center" style="font-family: cursive">
                            <b> Unit / Engine</b>
                            <h5 class="text-center">{{ $pengerjaan->unit_engine }} - {{ $pengerjaan->serial_number }}</h5>
                        </h5>
                        <br>
                        <table>
                            <tr>
                                <td>
                                    <h6 style="font-family: cursive">Nama Customer</h6>
                                </td>
                                <td> : </td>
                                <td>
                                    <h6><i class="fas fa-person">{{ $pengerjaan->user->name }}</i></h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h6 style="font-family: cursive">Tanggal Masuk</h6>
                                </td>
                                <td> : </td>
                                <td>
                                    <h6><i class="fas fa-person"> {{ $pengerjaan->tanggal_masuk }}</i></h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h6 style="font-family: cursive">Estimasi Pengerjaan</h6>
                                </td>
                                <td> : </td>
                                <td>
                                    <h6><i class="fas fa-person"> {{ $pengerjaan->estimasi_pengerjaan }}</i></h6>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div> --}}
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-dark">
                        <h4 class="text-center font-weight-bold mt-3">Detail</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="text-center">
                            <b>Unit / Engine:</b>
                            <p>{{ $pengerjaan->unit_engine }} - {{ $pengerjaan->serial_number }}</p>
                        </h5>
                        <hr>
                        <h6>Keterangan : </h6>
                        <p>{{ $pengerjaan->keterangan }}</p>
                        <hr>
                        <h6 >Nama Customer:</h6>
                        <p><i class="fas fa-person">{{ $pengerjaan->user->name }}</i></p>
            
                        <h6>Tanggal Masuk:</h6>
                        <p><i class="fas fa-person"> {{ $pengerjaan->tanggal_masuk }}</i></p>
            
                        <h6>Estimasi Pengerjaan:</h6>
                        <p><i class="fas fa-person"> {{ $pengerjaan->estimasi_pengerjaan }}</i></p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header bg-dark">

                        <h4 class="text-center font-weight-bold mt-3">Deskripsi Pekerjaan</h4>
                    </div>
                   
                    <div class="card-body">
                        <div class="row">
                            {{-- <div class="col-md-4 mt-4">
                                <button type="button" class="btn btn-primary"
                                    onclick="tambahInputDeskripsi()">Tambah</button>
                            </div> --}}
                            <form class="row" action="/pengerjaan/deskripsi/insert" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div id="deskripsi-container">
                                    <div class="col-md-12">
                                        <!-- Tanggal Masuk Input -->
                                        <label for="tanggal_mulai_pengerjaan">Tanggal Mulai Pengerjaan</label>
                                        <div class="input-group mb-3">
                                            <input type="date" class="form-control"
                                                name="tanggal_mulai_pengerjaan">
                                        </div>
                                    </div>
                                    <div class="col-md-6"hidden>
                                        <label for="user_id">Customer</label>
                                        <div class="input-group mb-3">

                                            <input type="text"
                                                class="form-control @error('user_id') is-invalid @enderror" name="user_id"
                                                value="{{ old('user_id', $pengerjaan->user_id) }}" readonly
                                                placeholder="No Working Order">
                                            @error('user_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12" hidden>
                                        <div class="form-floating">
                                            <input type="number" name="pengerjaan_id"
                                                class="form-control @error('pengerjaan_id') is-invalid @enderror"
                                                id="pengerjaan_id" placeholder="Kode Barang"
                                                value="{{ old('pengerjaan_id', $id) }}" autofocus>
                                            @error('pengerjaan_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <!-- Deskripsi Pengerjaan Input -->
                                        <label for="deskripsi_pekerjaan">Deskripsi Pengerjaan</label>
                                        <div class="input-group mb-3">
                                            <textarea class="form-control @error('deskripsi_pekerjaan') is-invalid @enderror" name="deskripsi_pekerjaan"
                                                rows="4" placeholder="Deskripsi Pengerjaan"></textarea>
                                            @error('deskripsi_pekerjaan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <!-- Tanggal Masuk Input -->
                                        <label for="tanggal_selesai_perpengerjaan">Estimasi Tanggal Selesai</label>
                                        <div class="input-group mb-3">
                                            <input type="date" class="form-control"
                                                name="tanggal_selesai_perpengerjaan">
                                        </div>
                                    </div>
                                    <hr>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary m-2">Save</button>
                                </div>
                            </form><!-- End floating Labels Form -->
                        </div>
                    </div>


                </div>
            </div>

        </div>
    </div>
    <!-- JavaScript -->
    <script>
        // Fungsi untuk menambahkan inputan baru
        // Fungsi untuk menambahkan inputan baru
        function tambahInputDeskripsi() {
            var container = document.getElementById("deskripsi-container"); // Dapatkan div container
            var newInput = container.cloneNode(true); // Salin elemen input yang ada
            var inputs = newInput.getElementsByTagName("input"); // Dapatkan semua elemen input dalam salinan
            var textareas = newInput.getElementsByTagName("textarea"); // Dapatkan semua elemen textarea dalam salinan

            // Kosongkan nilai input dan textarea
            for (var i = 0; i < inputs.length; i++) {
                inputs[i].value = "";

                // // Check if the input name is "pengerjaan_id" or "user_id" and set the value accordingly
                // if (inputs[i].name === "pengerjaan_id") {
                //     inputs[i].value = document.querySelector("input[name='pengerjaan_id']").value;
                // } else if (inputs[i].name === "user_id") {
                //     inputs[i].value = document.querySelector("input[name='user_id']").value;
                // }
            }

            for (var i = 0; i < textareas.length; i++) {
                textareas[i].value = "";
            }

            container.parentNode.appendChild(newInput); // Tambahkan salinan input ke dalam container
        }


        // Fungsi untuk menghapus inputan
        function hapusInputDeskripsi(inputElement) {
            inputElement.parentNode.remove(); // Hapus elemen input yang dipilih
        }
    </script>

    <!-- Tambahkan pustaka Bootstrap JavaScript jika diperlukan -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection
