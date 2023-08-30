@extends('layouts.master')

@section('title', 'Proggress')
{{-- @section('header', 'Pengeluaran') --}}
@section('breadcrumb', 'Proggress')
@section('container-fluid')

    <div class="container">
        <!-- Button trigger modal Insert -->

        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">Proggress</h3>
                {{-- <a href="/pengerjaan-create" class="btn btn-primary float-right"><i class="fas fa-solid fa-plus"></i> Working
                    Order</a> --}}

            </div>
            <div class="card-body">
                <div id="example_wrapper">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <th>No</th>
                            <th>No Working Order</th>
                            <th>Nama Customer</th>
                            <th>Nama Alat</th>
                            <th>Nama Teknisi</th>
                            <th>Estimasi Pengerjaan</th>
                            <th>Tanggal Masuk</th>
                            <th>Tanggal Update</th>
                            <th>Tanggal Selesai</th>
                            <th>Status Pengerjaan</th>
                            <th>Keterangan</th>
                            <th>Deskripsi Pekerjaan</th>
                            <th>Action</th>
                        </thead>
                        <tbody>

                            @foreach ($pengerjaans as $p)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $p->no_working_order }}</td>
                                    <td>{{ $p->user->name }}</td>
                                    <td>{{ $p->alat->nama_alat }}</td>
                                    <td>{{ $p->teknisi->nama_teknisi }}</td>
                                    <td>{{ $p->estimasi_pengerjaan }}</td>
                                    <td>{{ $p->tanggal_masuk }}</td>
                                    <td>{{ $p->tanggal_update }}</td>
                                    <td>{{ $p->tanggal_selesai }}</td>
                                    <td>
                                        @if ($p->status == 'Belum Konfirmasi')
                                            <span class="badge bg-danger">Belum Konfirmasi</span>
                                        @elseif ($p->status == 'sedang dikerjakan')
                                            <span class="badge bg-warning">On Proggress</span>
                                        @elseif ($p->status == 'selesai')
                                            <span class="badge bg-success">Selesai</span>
                                        @endif
                                    </td>
                                    <td>{{ $p->keterangan }}</td>
                                    <td>{{ $p->deskripsi_pekerjaan }}</td>
                                    <td>
                                        <button type="button" id="{{ $p->id }}"
                                            class="btn btn-info btn-sm btn-detail"><svg xmlns="http://www.w3.org/2000/svg"
                                                width="16" height="16" fill="currentColor" class="bi bi-info-circle"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                <path
                                                    d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                            </svg> Detail</button>

                                        <a href="{{ url('/pengerjaan/edit', $p->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>

                                        <a href="#" id="btn-hapus" class="btn btn-danger btn-sm"
                                            data-id="{{ $p->id }}"><i class="fa-solid fas fa-trash"></i>
                                            Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal Detail Data Pengeluaran -->
        <div class="modal fade " id="detailModal" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
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
                                <th>Jumlah Pengeluaran</th>
                                <td>:</td>
                                <td id="jml"></td>
                            </tr>
                            <tr>
                                <th>Jenis Pengeluaran</th>
                                <td>:</td>
                                <td id="jen"></td>
                            </tr>
                            <tr>
                                <th>Keterangan</th>
                                <td>:</td>
                                <td id="ket"></td>
                            </tr>
                            <tr>
                                <th>Tanggal</th>
                                <td>:</td>
                                <td id="tanggal"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        // ----------------------btn hapus----------------------

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
                    window.location = "/pengeluaranluarpertandingan" + "/delete/" + link;
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        })
        // ----------------------btn hapus----------------------


        // ----------------------Data Table----------------------
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
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
        // ----------------------Data Table----------------------


        // ----------------------btn detail---------------------

        $(document).ready(function() {
            $('.btn-detail').click(function() {
                var id = $(this).attr('id');
                console.log(id);

                $.ajax({
                    url: 'pengeluaranluarpertandingan/' + id, // Ganti dengan URL yang sesuai
                    type: 'GET',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        console.log(response.data.jml_pengeluaran);
                        $('#detailContent').html(response);
                        $('#detailModal').modal('show');
                        $('#id').text(response.data.id);
                        $('#jml').text(response.data.jml_pengeluaran);
                        $('#jen').text(response.data.jenis);
                        $('#ket').text(response.data.keterangan);
                        $('#tanggal').text(new Date(response.data.created_at)
                            .toLocaleDateString('id-ID', {
                                day: 'numeric',
                                month: 'short',
                                year: 'numeric'
                            }));
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>

@endsection
