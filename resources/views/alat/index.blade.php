@extends('layouts.master')

@section('title', 'Alat')
{{-- @section('header', 'Alat') --}}
@section('breadcrumb', 'Alat')
@section('container-fluid')



    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <i class="fa-solid fas fa-plus"></i> Add Alat
    </button>
    <div class="card mt-3">
        <div class="card-body">
            <div id="example_wrapper">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <th>No</th>
                        <th>Nama Alat</th>
                        <th>Action</th>
                    </thead>
                    <tbody>

                        @foreach ($alats as $p)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $p->nama_alat }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-warning btn-sm mr-1" data-bs-toggle="modal"
                                            data-bs-target="#btn-edit{{ $p->id }}">
                                            <i class="fa fa-edit"></i> Edit
                                        </button>

                                        <a href="#" id="btn-hapus" class="btn btn-danger btn-sm"
                                            data-id="{{ $p->id }}">
                                            <i class="fa-solid fas fa-trash"></i> Delete
                                        </a>
                                    </div>
                                </td>

                            </tr>

                            <!-- Modal Update Data -->
                            <div class="modal fade" id="btn-edit{{ $p->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-center" id="modalUpdateLabel">Alat Update</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form action="/alat/{{ $p->id }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="input-group mb-3">
                                                    <input type="text"
                                                        class="form-control @error('nama_alat') is-invalid @enderror"
                                                        name="nama_alat" value="{{ old('nama_alat', $p->nama_alat) }}">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-user"></span>
                                                        </div>
                                                    </div>
                                                    @error('nama_alat')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror

                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save</button>
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
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel">Alat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="{{ url('/alat') }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" class="form-control @error('nama_alat') is-invalid @enderror" name="nama_alat"
                                value="{{ old('nama_alat') }}" placeholder="Nama Alat">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                            @error('nama_alat')
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
    </div>

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
                    window.location = "/alat/delete/" + link;
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
