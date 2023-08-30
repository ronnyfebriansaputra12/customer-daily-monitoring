<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    function index() {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    public function insertUser(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:4|same:password',
            'role' => 'required|string',
        ]);

        $data = [
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'password_confirmation' => Hash::make($request->password_confirmation),
            'role' => $request->role,

        ];

        User::create($data);

        Alert::toast('Insert Data User Berhasil', 'success');
        return redirect('/user');
    }

    function updateUser(Request $request, User $user)
    {
        $id = User::find($user->id);
        $datas = $request->all();
        $datas['password'] = Hash::make($request->password);
        $datas['password_confirmation'] = Hash::make($request->password_confirmation);
        $user->update($datas);
        Alert::toast('Data Berhasil diubah', 'success');
        return redirect('/user');
    }

    function deleteUser(User $user)
    {
        User::destroy($user->id);
        return redirect('/user');
    }
}
