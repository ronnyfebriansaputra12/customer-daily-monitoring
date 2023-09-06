@extends('layouts.auth.login.main')
@section('title', 'Forgot Password')
@section('container')


    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="text-center">
            <img src="{{ asset('AdminLTE') }}/dist/img/poli.png" width="100px" height="100px" alt="">
        </div>

        <div class="text-center">
            <a href="{{ url('/') }}" class="h1"><b>Funsport</b>ID</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Reset Password</p>

            <form action="{{ url('reset_password_proses') }}" method="post">
                @csrf
                <input hidden type="text" name="token" value="{{ request()->token }}">
                <input hidden type="email" name="email" value="{{ request()->email }}">
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
                <div class="input-group mb-3">
                    <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror"
                        placeholder="Password_confirmation" value="{{ old('password_confirmation') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
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
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    @include('sweetalert::alert')

@endsection
