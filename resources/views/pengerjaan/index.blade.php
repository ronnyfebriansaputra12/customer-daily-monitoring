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
                            <th>Unit / Engine</th>
                            <th>Tanggal Masuk</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>

                            @foreach ($pengerjaans as $p)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $p->no_working_order }}</td>
                                    <td>{{ $p->user->name }}</td>
                                    <td>{{ $p->unit_engine }}</td>
                                    <td>{{ $p->tanggal_masuk }}</td>
                                    <td>
                                        @if ($p->status == 'Belum Konfirmasi')
                                            <span class="badge bg-danger">Belum Konfirmasi</span>
                                        @elseif ($p->status == 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif ($p->status == 'sedang dikerjakan')
                                            <span class="badge bg-info">Sedang di kerjakan</span>
                                        @elseif ($p->status == 'selesai')
                                            <span class="badge bg-success">Selesai</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div >
                                            <a href="{{ url('pengerjaan', $p->id) }}" class="btn btn-info btn-sm btn-detail"
                                                title="Detail">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ url('/pengerjaan/edit', $p->id) }}" class="btn btn-warning btn-sm"
                                                title="Update">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="#" id="btn-hapus" class="btn btn-danger btn-sm" title="Hapus"
                                                data-id="{{ $p->id }}"><i class="fa-solid fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
                    window.location = "/pengerjaan" + "/delete/" + link;
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
               
            });
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
    </script>

@endsection
