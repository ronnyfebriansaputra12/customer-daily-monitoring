@extends('layouts.master')

@section('title', 'Dashboard')
@section('header', 'Dashboard')
@section('breadcrumb', 'Dashboard')

@section('container-fluid')

    <style>
        /* CSS untuk timeline-item */
        .timeline-item {
            background-color: #f5f5f5;
            border-left: 2px solid #3498db;
            padding: 20px;
            margin: 20px 0;
            position: relative;
        }

        /* CSS untuk time (ikon jam) */
        .time {
            color: #3498db;
            font-size: 16px;
            margin-bottom: 10px;
        }

        /* CSS untuk header */
        .timeline-header {
            font-size: 24px;
            color: #333;
            margin: 10px 0;
        }

        /* CSS untuk timeline-body */
        .timeline-body {
            font-size: 18px;
            color: #777;
            line-height: 1.4;
        }

        /* CSS untuk ikon jam (fas fa-clock) */
        .fas.fa-clock {
            margin-right: 5px;
        }

        /* CSS untuk status */
        .status {
            font-weight: bold;
            color: #e74c3c;
            /* warna merah misalnya untuk status buruk */
        }

        /* CSS untuk warna status yang berbeda */
        .status.completed {
            color: #27ae60;
            /* warna hijau untuk status selesai */
        }

        /* CSS untuk warna status yang berbeda */
        .status.in-progress {
            color: #f39c12;
            /* warna kuning untuk status sedang berlangsung */
        }

        /* CSS untuk warna status yang berbeda */
        .status.pending {
            color: #3498db;
            /* warna biru untuk status tertunda */
        }
    </style>
    <div class="card mb-3">
        @foreach ($pengerjaanByWorkingOrder as $workingOrder => $item)
            @if (Auth::user()->role = 'user')
                <section class="content mt-3">
                    <div class="container-fluid">

                        <!-- Timelime example  -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="timeline">
                                    @foreach ($deskripsiByWorkingOrder[$workingOrder] as $value)
                                        @php
                                            $created_at = $value->created_at;
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
                                                    {{ $value->deskripsi_pekerjaan }}
                                                    {{ $value->pengerjaan->no_working_order }}
                                                    {{ $value->keterangan }}
                                                    {{ $value->pengerjaan->tanggal_masuk }}
                                                    {{ $value->tanggal_update }}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div>
                                        <i class="fas fa-clock bg-gray"></i>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <!-- /.col -->
                        </div>

                    </div>
                    <!-- /.timeline -->

                </section>
            @else
                <section class="content" hidden>
                    <div class="container-fluid">

                        <!-- Timelime example  -->
                        <div class="row">
                            <div class="col-md-12">
                                <!-- The time line -->
                                <div class="timeline">
                                    <!-- timeline time label -->
                                    <div class="time-label">
                                        <span class="bg-red">10 Feb. 2014</span>
                                    </div>
                                    <!-- /.timeline-label -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-envelope bg-blue"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="fas fa-clock"></i> 12:05</span>
                                            <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email
                                            </h3>

                                            <div class="timeline-body">
                                                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                                weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                                jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                                quora plaxo ideeli hulu weebly balihoo...
                                            </div>
                                            <div class="timeline-footer">
                                                <a class="btn btn-primary btn-sm">Read more</a>
                                                <a class="btn btn-danger btn-sm">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-user bg-green"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="fas fa-clock"></i> 5 mins ago</span>
                                            <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted
                                                your
                                                friend
                                                request</h3>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-comments bg-blue"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="fas fa-clock"></i> 27 mins ago</span>
                                            <h3 class="timeline-header"><a href="#">Jay White</a> commented on your
                                                post
                                            </h3>
                                            <div class="timeline-body">
                                                Take me to your leader!
                                                Switzerland is small and neutral!
                                                We are more like Germany, ambitious and misunderstood!
                                            </div>
                                            <div class="timeline-footer">
                                                <a class="btn btn-warning btn-sm">View comment</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                    <!-- timeline time label -->
                                    <div class="time-label">
                                        <span class="bg-green">3 Jan. 2014</span>
                                    </div>
                                    <!-- /.timeline-label -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fa fa-camera bg-purple"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="fas fa-clock"></i> 2 days ago</span>
                                            <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos
                                            </h3>
                                            <div class="timeline-body">
                                                <img src="https://placehold.it/150x100" alt="...">
                                                <img src="https://placehold.it/150x100" alt="...">
                                                <img src="https://placehold.it/150x100" alt="...">
                                                <img src="https://placehold.it/150x100" alt="...">
                                                <img src="https://placehold.it/150x100" alt="...">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-video bg-maroon"></i>

                                        <div class="timeline-item">
                                            <span class="time"><i class="fas fa-clock"></i> 5 days ago</span>

                                            <h3 class="timeline-header"><a href="#">Mr. Doe</a> shared a video</h3>

                                            <div class="timeline-body">
                                                <div class="embed-responsive embed-responsive-16by9">
                                                    <iframe class="embed-responsive-item"
                                                        src="https://www.youtube.com/embed/tMWkeBIohBs"
                                                        allowfullscreen></iframe>
                                                </div>
                                            </div>
                                            <div class="timeline-footer">
                                                <a href="#" class="btn btn-sm bg-maroon">See comments</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                    <div>
                                        <i class="fas fa-clock bg-gray"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                    </div>
                    <!-- /.timeline -->
            @endif
        @endforeach

        </section>
    </div>
@endsection
