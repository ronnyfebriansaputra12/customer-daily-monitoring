@extends('layouts.master')

@section('title', 'Working Order')
@section('header', 'Working Order')
@section('breadcrumb', 'Working Order')
@section('container-fluid')



    @if (Auth::user()->role == 'admin')
        <button hidden type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fa-solid fas fa-plus"></i> Add Working Order
        </button>
    @else
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fa-solid fas fa-plus"></i> Add Working Order
        </button>
    @endif


    <div class="card mt-3">
        <div class="card-body">
            <div id="example_wrapper">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <th>No</th>
                        <th>User</th>
                        <th>Working Order</th>
                        <th>Status</th>

                    </thead>
                    <tbody>

                        @foreach ($workingOrders as $p)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $p->user->name }}</td>

                                @if (Auth::user()->role == 'admin')
                                    <td><a href="{{ url('working-order/pengerjaan/' . $p->no_working_order) }}"
                                            style="text-decoration: none;">{{ $p->no_working_order }}</a></td>
                                @else
                                    <td>{{ $p->no_working_order }}</a></td>
                                @endif


                                <td>
                                    @if ($p->status == 'pending')
                                        <span class="badge bg-danger">Belum Dikerjakan</span>
                                    @elseif ($p->status == 'proses')
                                        <span class="badge bg-warning">Sedang Dikerjakan</span>
                                    @elseif ($p->status == 'selesai')
                                        <span class="badge bg-success">Selesai</span>
                                    @endif
                                    {{-- <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-warning btn-sm mr-1" data-bs-toggle="modal"
                                            data-bs-target="#btn-edit{{ $p->no_working_order }}">
                                            <i class="fa fa-edit"></i> Edit
                                        </button>

                                        <a href="#" id="btn-hapus" class="btn btn-danger btn-sm"
                                            data-id="{{ $p->no_working_order }}">
                                            <i class="fa-solid fas fa-trash"></i> Delete
                                        </a>
                                    </div>
                                </td> --}}

                            </tr>

                            <!-- Modal Update Data -->
                            {{-- <div class="modal fade" id="btn-edit{{ $p->no_working_order }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-center" id="modalUpdateLabel">Working Order Update
                                            </h5>
                                        </div>
                                        <div class="modal-body">
                                            <form action="/alat/{{ $p->id }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="input-group mb-3">
                                                    <input type="text"
                                                        class="form-control @error('no_working_order') is-invalid @enderror"
                                                        name="no_working_order"
                                                        value="{{ old('no_working_order', $p->no_working_order) }}">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">
                                                            <span class="fas fa-user"></span>
                                                        </div>
                                                    </div>
                                                    @error('no_working_order')
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
                            </div> --}}
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
                    <h5 class="modal-title text-center" id="exampleModalLabel">Working Orders</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="{{ url('/working-order') }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            @php
                                // Mendapatkan tanggal bulan tahun saat ini dalam format dmy (ddmmyy)
                                $currentDate = now()->format('ymd');
                                
                                // Mendapatkan nomor terakhir dari database atau default ke 0 jika tidak ada
                                $lastNumber = intval(DB::table('working_orders')->max('no_working_order')) + 1;
                                
                                // Format nomor menjadi 3 digit dengan leading zeros
                                $formattedNumber = sprintf('%03d', $lastNumber);
                                
                                $proposedNoWorkingOrder = 'W' . $formattedNumber . $currentDate;
                                
                                // Memeriksa apakah nomor yang diusulkan sudah ada dalam basis data
                                $isUnique = false;
                                while (!$isUnique) {
                                    $existingOrder = DB::table('working_orders')
                                        ->where('no_working_order', $proposedNoWorkingOrder)
                                        ->first();
                                    if ($existingOrder) {
                                        $lastNumber++;
                                        $formattedNumber = sprintf('%03d', $lastNumber);
                                        $proposedNoWorkingOrder = 'W' . $formattedNumber . $currentDate;
                                    } else {
                                        $isUnique = true;
                                    }
                                }
                            @endphp
                            <input type="text" readonly
                                class="form-control @error('no_working_order') is-invalid @enderror" name="no_working_order"
                                value="{{ $proposedNoWorkingOrder }}" placeholder="No Working Order">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3" hidden>
                            @php
                                $user_id = Auth::user()->id;
                            @endphp
                            <input type="text" class="form-control @error('user_id') is-invalid @enderror" name="user_id"
                                value="{{ $user_id }}" placeholder="User ID">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                            @error('user_id')
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
                "buttons": ["pdf"],

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
                    window.location = "/working-order/delete/" + link;
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
