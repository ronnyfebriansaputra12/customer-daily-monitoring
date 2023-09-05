<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class UserController extends Controller
{
    function index()
    {
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

    public function profile()
    {
        $profile = User::find(Auth::user()->id)->first();
        return view('profile.index', compact('profile'));
    }

    function profileUpdate(Request $request)
    {

        $id = Auth::user()->id;
        $validate = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|string',
            'kontak' => 'required|numeric',
        ]);

        User::where('id', $id)->update($validate);
        Alert::toast('Update Profile Berhasil', 'success');
        return redirect('/profile');
    }

    function updateAvatar(Request $request)
    {
        $id = Auth::user()->id;
        $validate = request()->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            $imagePath = $request->file('avatar')->getRealPath();
            $result = Cloudinary::upload($imagePath, [
                'folder' => 'avatar',
                'transformation' => [
                    'width' => 320,
                    'height' => 320,
                    'crop' => 'limit',
                ],
            ]);
            $imageUrl = $result->getSecurePath();
            $validate['avatar'] = $imageUrl;
        }

        User::where('id', $id)->update($validate);
        Alert::toast('Update Data Avatar', 'success');
        return redirect('/profile');
    }

    function changePassword(Request $request)
    {
        $id = Auth::user()->id;
        $validate = $request->validate([
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:4|same:password',
        ]);

        $pass_lama = Auth::user()->password;

        if (Hash::check($request->password_lama, $pass_lama)) {
            $validate['password'] = Hash::make($request->password);
            $validate['password_confirmation'] = Hash::make($request->password_confirmation);
            User::where('id', $id)->update($validate);
            Alert::toast('Update Data Berhasil', 'success');
            return redirect('/profile');
        } else {
            Alert::toast('Password Lama Tidak Sesuai', 'error');
            return redirect('/profile');
        }
    }


    function deleteUser(User $user)
    {
        User::destroy($user->id);
        return redirect('/user');
    }
}
