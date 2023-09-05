@extends('layouts.master')

@section('title', 'Profile')
@section('breadcrumb', 'Profile')

@section('container-fluid')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <!-- Profile Image -->
                    <div class="card card-warning card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                @if (Auth::user()->avatar == '')
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ asset('adminlte/dist/img/av1.jpg') }}" alt="User profile picture">
                                @else
                                    <img class="profile-user-img img-fluid img-circle" src="{{ Auth::user()->avatar }}"
                                        alt="User profile picture">
                                @endif
                            </div>

                            <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

                            <p class="text-muted text-center">{{ Auth::user()->role }}</p>

                            <form action="{{ url('/updateAvatar') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control @error('avatar') is-invalid @enderror"
                                        name="avatar" value="{{ old('avatar') }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                    @error('avatar')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-warning btn-block"><b>Edit Avatar</b></button>

                            </form>


                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->


                <div class="col-md-8">
                    <!-- About Me Box -->
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Profile</h3>
                            {{--                 
                <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#modaledit{{ Auth::user()->id }}">
                  <i class="fas fa-edit"></i> Edit Profile
                </button> --}}

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary btn-sm float-right" data-bs-toggle="modal"
                                data-bs-target="#modalEdit{{ Auth::user()->id }}">
                                <i class="fas fa-edit"></i> Edit Profile
                            </button>

                            <button type="button" class="btn btn-primary btn-sm float-right mr-3" data-bs-toggle="modal"
                                data-bs-target="#modalChangePassword{{ Auth::user()->id }}">
                                <i class="fas fa-key"></i> Change Password
                            </button>


                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="far fa-id-badge"></i> Nama</strong>

                            <p class="text-muted">
                                {{ Auth::user()->name }}
                            </p>

                            <hr>
                            <strong><i class="fas fa-envelope"></i> Email</strong>

                            <p class="text-muted mt-1">{{ Auth::user()->email }}</p>

                            <hr>

                            <strong><i class="fab fa-whatsapp"></i> Kontak</strong>

                            <p class="text-muted mt-1">{{ Auth::user()->kontak }}</p>

                            <hr>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->


    <!-- Modal -->
    <div class="modal fade" id="modalEdit{{ Auth::user()->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/profileUpdate') }}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name', Auth::user()->name) }}" placeholder="Full name">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <div class="input-group mb-3">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ @old('email', Auth::user()->email) }}" placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control @error('kontak') is-invalid @enderror" name="kontak"
                                value="{{ @old('kontak', Auth::user()->kontak) }}" placeholder="Kontak">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fab fa-whatsapp"></span>
                                </div>
                            </div>
                            @error('kontak')
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



    <div class="modal fade" id="modalChangePassword{{ Auth::user()->id }}" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Change Passowrd</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/changePassword') }}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                        <div class="input-group mb-3">
                            <input type="password" class="form-control @error('password_lama') is-invalid @enderror"
                                name="password_lama" value="{{ old('password_lama') }}" placeholder="New Password Lama">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-key"></span>
                                </div>
                            </div>
                            @error('password_lama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" value="{{ old('password') }}" placeholder="New Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-key"></span>
                                </div>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                        <div class="input-group mb-3">
                            <input type="password"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                name="password_confirmation" value="{{ old('password_confirmation') }}"
                                placeholder="New Password Confirmation">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-key"></span>
                                </div>
                            </div>
                            @error('passowrd_confirmation')
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
@endsection
