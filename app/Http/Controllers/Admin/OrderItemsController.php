<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderItemsController extends Controller
{
    public function item_orders($order_id)
    {
        $products = DB::table('products')->get();
        $order_items = DB::table('order_items')
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->where('order_items.order_id', $order_id)
            ->select('order_items.id', 'users.nama', 'order_items.order_id', 'order_items.quantity', 'products.product')
            ->orderBy('id', 'asc')->get();
        return view('admin_template/order/item_order', compact('order_items', 'products', 'order_id'));
    }
    public function item_order_action(Request $request, $order_id)
    {
        // dd($request->all(), $order_id);
        $request->validate([
            // 'order_id' => 'required|integer|exists:orders,id',
            'product' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer'
        ]);
        DB::table('order_items')->insertGetId([
            'order_id' => $order_id, 'product_id' => $request->product, 'quantity' => $request->quantity
        ]);
        return Redirect('/dashboard/orderitems/' . $order_id)->with('status', 'Order Berhasil Ditambahkan');;
    }
    public function edit_orderItems($id)
    {
        $orders = DB::table('orders')->find($id);
        $order_items = DB::table('order_items')->find($id);
        $products = DB::table('products')->get();
        return view('admin_template/order/edit_itemOrder', compact('products', 'order_items', 'orders'));
    }
    public function update_orderItems(Request $request, $id)
    {
        $request->validate([
            'product' => 'required',
            'quantity' => 'required|integer'
        ]);
        $order_items = DB::table('order_items')->find($id);
        DB::table('order_items')->where('id', $order_items->id)->update([
            "product_id" => $request->product,
            "quantity" => $request->quantity,
            "order_id" => $request->order_id
        ]);
        return Redirect('/dashboard/orderitems/' . $request->order_id)->with('status', 'Items Order Berhasil Diedit');
    }
    public function destroyOrderItems($order_id)
    {
        $order_items = DB::table('order_items')->find($order_id);
        DB::table('order_items')->where('id', $order_items->id)->delete();
        return Redirect('/dashboard/orderitems/' . $order_items->order_id)->with('status', 'Product Order Item Berhasil Dihapus');
    }
}
