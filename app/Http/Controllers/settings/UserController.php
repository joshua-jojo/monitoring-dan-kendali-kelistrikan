<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();

        $data = [
            'user' => $user
        ];
        return inertia()->render('settings/UserPage', $data);
    }
    public function post(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:3',
            'username' => 'required|min:3|unique:users,username',
            'role' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        $user = new User();
        $user->nama = $request->nama;
        $user->username = $request->username;
        $user->role = $request->role;
        $user->password = bcrypt($request->password);
        $user->save();
    }
    public function edit(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:users,id',
            'nama' => 'required|min:3',
            'username' => 'required|min:3',
            'role' => 'required',
        ]);

        $user = User::find($request->id);
        $cek_username = $request->username == $user->name;

        $user->nama = $request->nama;
        if ($cek_username) {
            $request->validate([
                'username' => 'unique:users,username'
            ]);
            $user->username = $request->username;
        }

        if (!empty($request->password)) {

            $request->validate([
                'password' => 'confirmed'
            ]);
            $user->password = bcrypt($request->password);
        }

        $user->role = $request->role;
        $user->save();
    }

    public function hapus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:users,id'
        ]);

        $user = User::find($request->id);
        $user->delete();
    }
}
