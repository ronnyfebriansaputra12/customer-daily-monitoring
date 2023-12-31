@extends('layouts.master')

@section('title', 'Deksripsi Pekerjaan')
@section('header', 'Deksripsi Pekerjaan')
@section('breadcrumb', 'Deksripsi Pekerjaan')
@section('container-fluid')


    {{-- 
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <i class="fa-solid fas fa-plus"></i> Add Deksripsi Pekerjaan
    </button> --}}
    <div class="card mt-3">
        <div class="card-body">
            <div id="example_wrapper">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <th>No</th>
                        <th>Pekerjaan</th>
                        <th>Deksripsi Pekerjaan</th>
                        <th>Catatan</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>

                        @foreach ($deskirpsiPekerjaans as $p)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $p->pengerjaan->no_working_order }}</td>
                                <td>{{ $p->deskripsi_pekerjaan ?? '-' }}</td>
                                <td>{{ $p->catatan }}</td>
                                <td>{{ $p->status_perpengerjaan }}</td>

                                <td>
                                    <div class="btn-group">

                                        <button type="button" class="btn btn-primary btn-sm mr-1" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal{{ $p->id }}"><i class="fa fa-edit"></i>
                                        </button>

                                        <a href="#" id="btn-hapus" class="btn btn-danger btn-sm"
                                            data-id="{{ $p->id }}">
                                            <i class="fa-solid fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>

                            </tr>

                            <!-- Modal Update Data -->
                            <div class="modal fade" id="exampleModal{{ $p->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Update Deskripsi Pekerjaan
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="row" action="/deskripsi/update/{{ $p->id }}"
                                                method="post">
                                                @csrf
                                                @method('PUT')
                                                <div id="deskripsi-container">
                                                    {{-- <div class="col-md-12">
                                                        <!-- Keterangan Input -->
                                                        <label for="keterangan">Keterangan</label>
                                                        <div class="input-group mb-3">
                                                            <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" rows="4"
                                                                placeholder="Keterangan">{{ $p->keterangan }}</textarea>
                                                            @error('keterangan')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div> --}}
                                                    <div class="col-md-12">
                                                        <!-- Deskripsi Pengerjaan Input -->
                                                        <label for="deskripsi_pekerjaan">Deskripsi
                                                            Pengerjaan</label>
                                                        <div class="input-group mb-3">
                                                            <textarea class="form-control @error('deskripsi_pekerjaan') is-invalid @enderror" name="deskripsi_pekerjaan"
                                                                rows="4" placeholder="Deskripsi Pengerjaan">{{ $p->deskripsi_pekerjaan }}</textarea>
                                                            @error('deskripsi_pekerjaan')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <!-- Catatan Input -->
                                                        <label for="catatan">Catatan</label>
                                                        <div class="input-group mb-3">
                                                            <textarea class="form-control @error('catatan') is-invalid @enderror" name="catatan" rows="4"
                                                                placeholder="Catatan">{{ $p->catatan }}</textarea>
                                                            @error('catatan')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <!-- Status Input -->
                                                        <label for="status">Status</label>
                                                        <div class="input-group mb-3">
                                                            <select class="form-control" name="status_perpengerjaan">
                                                                <option value="sedang dikerjakan"
                                                                    {{ $p->status_perpengerjaan == 'sedang dikerjakan' ? 'selected' : '' }}>
                                                                    Sedang di Kerjakan</option>
                                                                <option value="selesai"
                                                                    {{ $p->status_perpengerjaan == 'selesai' ? 'selected' : '' }}>
                                                                    Selesai</option>
                                                                <option value="belum dikerjakan"
                                                                    {{ $p->status_perpengerjaan == 'belum dikerjakan' ? 'selected' : '' }}>
                                                                    Belum Dikerjakan</option>
                                                                <option value="pending"
                                                                    {{ $p->status_perpengerjaan == 'pending' ? 'selected' : '' }}>
                                                                    Pending</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary m-2">Save</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Insert Data -->
    {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel">Teknisi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/teknisi') }}" method="post">
                        @csrf
                        <div class="input-group mb-3" >
                            <input type="text" class="form-control @error('nama_teknisi') is-invalid @enderror" name="nama_teknisi"
                                value="{{ old('nama_teknisi') }}" placeholder="Nama Teknisi">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                            @error('nama_teknisi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="input-group mb-3" >
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="input-group mb-3" >
                            <input type="text" class="form-control @error('kontak') is-invalid @enderror" name="kontak"
                                value="{{ old('kontak') }}" placeholder="Kontak">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                            @error('kontak')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="input-group mb-3" >
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                                value="{{ old('password') }}" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="input-group mb-3" >
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"
                                value="{{ old('password_confirmation') }}" placeholder="Password Konfirmation">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                            @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Save</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div> --}}

    <!-- Modal Detail Data Pengeluaran -->
    {{-- <div class="modal fade " id="detailModal" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="modalDetailLabel">Pengeluaran Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <table class="table">
                        <tr>
                            <th>Nama</th>
                            <td>:</td>
                            <td id="nama"></td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td>:</td>
                            <td id="username"></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>:</td>
                            <td id="email"></td>
                        </tr>
                        <tr>
                            <th>No Hp</th>
                            <td>:</td>
                            <td id="hp"></td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td>:</td>
                            <td id="role"></td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </div> --}}


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });

        // --------------DELETE USER----------------
        $(document).on('click', '#btn-hapus', function(e) {
            e.preventDefault();
            var link = $(this).attr('data-id');
            console.log(link);

            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Data Akan di Hapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "/deskripsi-pekerjaan/delete/" + link;
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        })

        // ----------------------btn detail---------------------

        $(document).ready(function() {
            $('.btn-detail').click(function() {
                var id = $(this).attr('id');
                console.log(id);

                $.ajax({
                    url: 'user/detail/' + id, // Ganti dengan URL yang sesuai
                    type: 'GET',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        console.log(response.data.jml_pengeluaran);
                        $('#detailContent').html(response);
                        $('#detailModal').modal('show');
                        $('#id').text(response.data.id);
                        $('#nama').text(response.data.name);
                        $('#username').text(response.data.username);
                        $('#email').text(response.data.email);
                        $('#hp').text(response.data.phone);
                        $('#role').text(response.data.role);
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>

@endsection
