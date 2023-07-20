<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class DataUser extends Controller
{
    public function user()
    {
        $data = User::all();
        return view('user.user', ["data" => $data]);
    }

    public function editUser($id_user)
    {
        $data = DB::table('users')->where('id_user',$id_user)->get();
        return view('user.edit', ["data" => $data]);
    }

    public function simpanEdit(FormUser $request)
    {
        $data = array(
            "id_user"   => $request->id_user,
            "name"      => $request->name,
            "email"     => $request->email,
            "role"      => $request->role,
            "password"  => bcrypt($request->password)
        );
        $model = User::where('id_user', $request->id_user)
                ->update($data);
        if ($model) {
            Alert::success('Success', 'Data Berhasil Di Update!');
            return redirect('/user');
        }
    }

    public function hapusUser($id_user)
    {
        if (DB::table('users')->where('id_user', $id_user)->delete()) {
            Alert::success('Success', 'Data Berhasil Di Hapus!');
            return redirect('/user');
        }
    }

    // profile
    public function profile($id_user)
    {
        dd("ok");
    }

    public function profileEdit()
    {
        # code...
    }


}
