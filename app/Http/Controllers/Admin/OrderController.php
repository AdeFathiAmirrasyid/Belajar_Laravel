<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    public function index()
    {
        $data = DB::table('orders')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->select('orders.id', 'orders.tanggal_order', 'users.nama')
            ->orderBy('id', 'asc')->get();
        return view("admin_template/order/order", compact('data'));
    }
    public function insert()
    {
        $user = DB::table('users')->get();
        return view('admin_template/order/insert_order', compact('user'));
    }
    public function insertAction(Request $request)
    {
        $request->validate([
            'pembeli' => 'required',
            'tanggal_order' => 'required|date'
        ]);

        $order = DB::table('orders')->insertGetId([
            'user_id' =>  $request->pembeli, 'tanggal_order' => $request->tanggal_order
        ]);
        return Redirect('/dashboard/orderitems/' . $order);
    }
    public function edit_order($order)
    {
        $order = DB::table('orders')->find($order);
        $user = DB::table('users')->get();
        return view('admin_template/order/edit_order', compact('user', 'order'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_order' => 'required|date'
        ]);

        $order = DB::table('orders')->find($id);
        DB::table('orders')->where('id', $order->id)->update([
            "user_id" => $request->pembeli,
            "tanggal_order" => $request->tanggal_order,
        ]);
    return Redirect('/dashboard/order')->with('status', 'Orders Berhasil Di ubah');
    }
    public function destroy($id)
    {
        DB::table('order_items')->where('order_id', $id)->delete();
        DB::table('orders')->where('id', $id)->delete();
        return Redirect('/dashboard/order')->with('status', 'Product Berhasil Dihapus');
    }
}
