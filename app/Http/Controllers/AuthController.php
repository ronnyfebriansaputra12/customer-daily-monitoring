<?php

namespace App\Http\Controllers;

use App\Models\Teknisi;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Password;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Auth\Events\PasswordReset;

class AuthController extends Controller
{
    function login()
    {
        return view('auth.login.login');
    }

    function register()
    {
        return view('auth.register.index');
    }

    function loginProses(Request $request){
        $request->validate([
            'email' => 'required|email|max:100|exists:users',
            'password' => 'required'
        ]);

        $cek = $request->only('email', 'password');
        if (Auth::attempt($cek)) {
            $request->session()->regenerate();
            Alert::toast('Login Berhasil', 'success');
            return redirect('/dashboard');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
            'password' => 'The provided credentials do not match our records.',
        ]);
    }

    // function loginProses(Request $request)
    // {
        
        // $validasiTeknisi = $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'required'
        // ]);

        // $validasiUser = $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'required'
        // ]);
        // $teknisi = Teknisi::where('email', $validasiTeknisi['email'])->first();
        // $user = User::where('email', $validasiUser['email'])->first();
        
        // if (Auth::guard('teknisis')->attempt($validasiTeknisi)) {
        //     $request->session()->regenerate();
        //     // Simpan data ke dalam session
        //     $request->session()->put('teknisi', $teknisi);

        //     Alert::toast('Login Berhasil', 'success');
        //     return redirect('/dashboard');
        // }

        // if (Auth::guard('web')->attempt($validasiUser)) {
        //     $request->session()->regenerate();
        //     // Simpan data ke dalam session
        //     $request->session()->put('user', $user);

        //     Alert::toast('Login Berhasil', 'success');
        //     return redirect('/dashboard');
        // }
        // Alert::toast('Login Gagal', 'error');
        // return back()->withErrors([
        //     'email' => 'Email salah Atau Belum Terdaftar Silahkan Periksa Kembali',
        //     'password' => 'Password Salah Silahkan Periksa Kembali'
        // ]);
    // }


    function forgotPassword()
    {
        return view('auth.forgotPassword.forgotPassword');
    }

    function forgotPasswordProses(Request $request)
    {
        $request->validate([
            'email' => 'required|email|string|exists:users',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    function resetPassword($token)
    {
        return view('auth.forgotPassword.resetPassword', ['token' => $token]);
    }

    function resetPasswordProses(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|string|exists:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:4|same:password',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        Alert::toast('Reset Password Success', 'success');
        return $status === Password::PASSWORD_RESET
            ? redirect('/')->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }


    function registerProses(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|max:100|unique:users',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required|min:4|same:password',

        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'password_confirmation' => bcrypt($request->password_confirmation),
        ]);

        // event(new Registered($user));
        toast('Register Berhasil', 'success');
        Auth::login($user);
        return redirect('/');
    }

    function Logout()
    {
        toast('Logout Berhasil', 'success');
        Auth::logout();
        return redirect('/');
    }
}
