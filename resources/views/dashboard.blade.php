@extends('layouts.master')
@section('title', 'Dashboard')
@section('header', 'Dashboard')
@section('breadcrumb', 'Dashboard')
@section('container-fluid')
    {{-- <style>
        /* Gaya untuk timeline-item */
        .timeline-item {
            background-color: #f5f5f5;
            border-left: 2px solid #3498db;
            padding: 20px;
            margin: 20px 0;
            position: relative;
        }

        /* Gaya untuk time (ikon jam) */
        .time {
            color: #3498db;
            font-size: 16px;
            margin-bottom: 10px;
        }

        /* Gaya untuk header */
        .timeline-header {
            font-size: 24px;
            color: #333;
            margin: 10px 0;
        }

        /* Gaya untuk timeline-body */
        .timeline-body {
            font-size: 18px;
            color: #777;
            line-height: 1.4;
        }

        /* Gaya untuk ikon jam (fas fa-clock) */
        .fas.fa-clock {
            margin-right: 5px;
        }

        /* Gaya untuk status */
        .status {
            font-weight: bold;
            color: #e74c3c;
            /* warna merah misalnya untuk status buruk */
        }

        /* Gaya untuk warna status yang berbeda */
        .status.completed {
            color: #27ae60;
            /* warna hijau untuk status selesai */
        }

        /* Gaya untuk warna status yang berbeda */
        .status.in-progress {
            color: #f39c12;
            /* warna kuning untuk status sedang berlangsung */
        }

        /* Gaya untuk warna status yang berbeda */
        .status.pending {
            color: #3498db;
            /* warna biru untuk status tertunda */
        }
    </style>
    <div class="accordion accordion-flush rounded" id="accordionFlushExample">
        @foreach ($pengerjaanByWorkingOrder as $workingOrder => $value)
            @if (Auth::user()->role == 'user')
                <div class="accordion-item mb-2">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapse{{ $workingOrder }}" aria-expanded="false"
                            aria-controls="flush-collapse{{ $workingOrder }}">
                            Working Order: {{ $workingOrder }} Unit / Engine : 
                        </button>
                    </h2>
                    <div id="flush-collapse{{ $workingOrder }}" class="accordion-collapse collapse"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <div class="timeline">
                                @foreach ($deskripsiByWorkingOrder[$workingOrder] as $value)
                                    @php
                                        $created_at = $value->tanggal_update;
                                        $days_in_indonesian = [
                                            'Sunday' => 'Minggu',
                                            'Monday' => 'Senin',
                                            'Tuesday' => 'Selasa',
                                            'Wednesday' => 'Rabu',
                                            'Thursday' => 'Kamis',
                                            'Friday' => 'Jumat',
                                            'Saturday' => 'Sabtu',
                                        ];
                                        
                                        $months_in_indonesian = [
                                            'January' => 'Januari',
                                            'February' => 'Februari',
                                            'March' => 'Maret',
                                            'April' => 'April',
                                            'May' => 'Mei',
                                            'June' => 'Juni',
                                            'July' => 'Juli',
                                            'August' => 'Agustus',
                                            'September' => 'September',
                                            'October' => 'Oktober',
                                            'November' => 'November',
                                            'December' => 'Desember',
                                        ];
                                        
                                        $formatted_date = date('l, d F Y', strtotime($created_at));
                                        $formatted_date = strtr($formatted_date, $days_in_indonesian);
                                        $formatted_date = strtr($formatted_date, $months_in_indonesian);
                                    @endphp
                                    <div class="time-label">
                                        <span class="bg-blue">{{ $formatted_date }}</span>
                                    </div>
                                    <div>
                                        <i class="fas fa-comments bg-blue"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="fas fa-clock"></i>
                                                {{ $value->created_at->diffForHumans() }}</span>
                                            <span class="time">
                                                {{ $value->status }}
                                            </span>
                                            <h3 class="timeline-header">{{ $value->pengerjaan->teknisi->nama_teknisi }}
                                            </h3>
                                            <div class="timeline-body">
                                                <table class="table">
                                                    <tr>
                                                        <th>Customer</th>
                                                        <td>:</td>
                                                        <td>{{ $value->pengerjaan->user->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>No Working Order</th>
                                                        <td>:</td>
                                                        <td>{{ $value->pengerjaan->no_working_order }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Unit / Engine</th>
                                                        <td>:</td>
                                                        <td>{{ $value->pengerjaan->unit_engine }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Serial Number</th>
                                                        <td>:</td>
                                                        <td>{{ $value->pengerjaan->serial_number }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Tanggal Selesai</th>
                                                        <td>:</td>
                                                        <td>{{ strtoupper($value->tanggal_selesai_perpengerjaan) }}</td>
                                                    </tr>

                                                    <tr>
                                                        <th>Estimasi Pengerjaan</th>
                                                        <td>:</td>
                                                        <td>{{ $value->pengerjaan->estimasi_pengerjaan }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Keterangan</th>
                                                        <td>:</td>
                                                        <td>{{ $value->keterangan }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Deskripsi Pekerjaan</th>
                                                        <td>:</td>
                                                        <td>{{ $value->deskripsi_pekerjaan }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <div>
                                    <i class="fas fa-clock bg-gray"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div> --}}
    <div class="accordion" id="accordionExample">
        @foreach ($pekerjaan as $item)
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                        aria-expanded="true" aria-controls="collapseOne">
                        WO : {{ $item->no_working_order }} | Unit / Engine :
                        {{ $item->unit_engine }} | Serial Number :
                        {{ $item->serial_number }}

                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="timeline">
                            @foreach ($deskripsi_pekerjaan as $p)
                                @php
                                    $tanggal_mulai = $p->tanggal_mulai_pengerjaan;
                                    $days_in_indonesian = [
                                        'Sunday' => 'Minggu',
                                        'Monday' => 'Senin',
                                        'Tuesday' => 'Selasa',
                                        'Wednesday' => 'Rabu',
                                        'Thursday' => 'Kamis',
                                        'Friday' => 'Jumat',
                                        'Saturday' => 'Sabtu',
                                    ];
                                    
                                    $months_in_indonesian = [
                                        'January' => 'Januari',
                                        'February' => 'Februari',
                                        'March' => 'Maret',
                                        'April' => 'April',
                                        'May' => 'Mei',
                                        'June' => 'Juni',
                                        'July' => 'Juli',
                                        'August' => 'Agustus',
                                        'September' => 'September',
                                        'October' => 'Oktober',
                                        'November' => 'November',
                                        'December' => 'Desember',
                                    ];
                                    
                                    $formatted_date = date('l, d F Y', strtotime($tanggal_mulai));
                                    $formatted_date = strtr($formatted_date, $days_in_indonesian);
                                    $formatted_date = strtr($formatted_date, $months_in_indonesian);
                                @endphp
                                <!-- timeline time label -->
                                <div class="time-label">
                                    <span class="bg-red">{{ $formatted_date }}</span>
                                </div>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <div>
                                    <i class="fas fa-envelope bg-blue"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fas fa-clock"></i>
                                            {{ $p->created_at->diffForHumans() }}</span>
                                        <h3 class="timeline-header">{{ $p->pengerjaan->teknisi->nama_teknisi }}
                                        </h3>

                                        <div class="timeline-body">

                                            <table class="table">
                                                <tr>
                                                    <td>Deskripsi Pekerjaan</td>
                                                    <td> : </td>
                                                    <td>
                                                        <p>{{ $p->deskripsi_pekerjaan }}</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Keterangan</td>
                                                    <td> : </td>
                                                    <td>
                                                        <p>{{ $p->keterangan }}</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Tanggal Estimasi Selesai
                                                    </td>
                                                    <td> : </td>
                                                    <td>
                                                        <p>{{ $p->tanggal_selesai_perpengerjaan }}</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Status
                                                    </td>
                                                    <td> : </td>
                                                    <td>
                                                        @if ($p->status_perpengerjaan == 'sedang dikerjakan')
                                                            <span class="badge bg-warning">Sedang Dikerjakan</span>
                                                        @elseif ($p->status_perpengerjaan == 'selesai')
                                                            <span class="badge bg-success">Selesai</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Catatan
                                                    </td>
                                                    <td> : </td>
                                                    <td>
                                                        <p>{{ $p->catatan }}</p>
                                                    </td>
                                                </tr>
                                            </table>
                                            {{-- <div class="modal fade" id="exampleModal{{ $p->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title
                                                            </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="row"
                                                                action="/deskripsi/update/{{ $p->id }}"
                                                                method="post">
                                                                @csrf
                                                                @method('PUT')
                                                                <div id="deskripsi-container">
                                                                    <div class="col-md-12">
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
                                                                    </div>
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
                                                                            <select class="form-control"
                                                                                name="status_perpengerjaan">
                                                                                <option value="sedang dikerjakan"
                                                                                    {{ $p->status_perpengerjaan == 'sedang dikerjakan' ? 'selected' : '' }}>
                                                                                    Sedang di Kerjakan</option>
                                                                                <option value="selesai"
                                                                                    {{ $p->status_perpengerjaan == 'selesai' ? 'selected' : '' }}>
                                                                                    Selesai</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary m-2">Save</button>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>
                                        <div class="timeline-footer d-flex justify-content-end">
                                            {{-- <a href="deskripsi/edit/{{ $p->id }}"
                                                class="btn btn-primary btn-sm">Update</a> --}}
                                            {{-- <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal{{ $p->id }}">
                                                Update
                                            </button> --}}
                                        </div>
                                    </div>
                                </div>
                                <!-- END timeline item -->
                            @endforeach

                        </div>
                    </div>
                    {{-- <div class="d-flex justify-content-end mr-4">
                        <a href="deskripsi/edit/{{ $p->id }}" class="btn btn-primary btn-sm">Update</a>
                    </div> --}}
                </div>


            </div>
        @endforeach

    </div>

@endsection
