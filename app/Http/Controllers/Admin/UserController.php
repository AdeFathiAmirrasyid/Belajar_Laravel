<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Users;

class UserController extends Controller
{
    public function insert()
    {
        $users = Users::get();
        return view('admin_template/order/insert_users', compact('users'));

    }
    public function insertAction(Request $request)
    {

        $request->validate([
            'nama' => 'required',
            'email' => 'required|email'
        ]);


        Users::create($request->all());
        return Redirect('/dashboard/user')->with('status', 'User Berhasil Ditambahkan');
    }

    public function edit(User $user)
    {
        return view('admin_template/order/edit_users', compact('user'));
    }
    public function update(Request $request,User $user)
    {
        User::where('id',$user->id)->update([
            "nama" => $request->nama,
            "email" => $request->email,
            "password" => $request->password
        ]);
        return Redirect('/dashboard/user')->with('status', 'User Berhasil Di ubah');
    }


    public function destroy(User $user)
    {
        User::destroy($user->id);
        return Redirect('/dashboard/user')->with('status', 'Product Berhasil Dihapus');
    }
}
