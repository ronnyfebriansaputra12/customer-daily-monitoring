@extends('layouts.master')
@section('title', 'Dashboard')
@section('header', 'Dashboard')
@section('breadcrumb', 'Dashboard')
@section('container-fluid')
    <style>
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
                            Working Order: {{ $workingOrder }}
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
                                                        <th>Tanggal Masuk</th>
                                                        <td>:</td>
                                                        <td>{{ strtoupper($value->pengerjaan->tanggal_masuk) }}</td>
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


                                                {{-- <p><strong>Nama Alat:</strong> {{ $value->pengerjaan->unit_engine }}</p>
                                                <p><strong>Serial Number:</strong> {{ $value->pengerjaan->serial_number }}
                                                </p>
                                                <p><strong>Deskripsi:</strong> {{ $value->deskripsi_pekerjaan }}</p>
                                                <p><strong>Keterangan:</strong> {{ $value->keterangan }}</p>
                                                <p><strong>Tanggal Masuk:</strong> {{ $value->pengerjaan->tanggal_masuk }}
                                                </p> --}}
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
    </div>
@endsection
