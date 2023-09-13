@extends('layouts.auth.login.main')
@section('title', 'Login')
@section('container')

    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="text-center">
            {{-- <img src="{{ asset('AdminLTE') }}/dist/img/poli.png" width="100px" height="100px" alt=""> --}}
            <img src="{{ asset('AdminLTE') }}/dist/img/logo-tab.png" width="150px" height="150px" alt="">
        </div>

        <div class="text-center mt-3">
            <a href="{{ url('/') }}" class="h4">Customer Daily Monitoring</a>
        </div>
        <div class="card-body">
            {{-- <p class="login-box-msg">Login</p> --}}

            <form action="/login" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" placeholder="Email">
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
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                        placeholder="Password" value="{{ old('password') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="row">

                    <!-- /.col -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </div>
                    <!-- /.col -->
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ url('/forgot_password') }}" class="text-center">Lupa Password</a>
                    </div>
                </div>
                <p class="mb-0">
                    <a href="/register" class="text-center">Register a new membership</a>
                  </p>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    @include('sweetalert::alert')


@endsection
