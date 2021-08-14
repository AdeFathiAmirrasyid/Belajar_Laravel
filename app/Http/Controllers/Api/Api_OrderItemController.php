<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Environment\Console;

class Api_OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $data = DB::table('order_items')->where('order_id', $id)->get();
        return response()->json(['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|integer|exists:orders,id',
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer'
        ]);

        $data = $request->all();
        DB::table('order_items')->insert([
            'order_id' => $request->order_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity
        ]);
        $orderItem =  DB::table('order_items')
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->where('order_id', $data['order_id'])
            ->select(
                'order_items.id',
                'order_items.order_id',
                'order_items.quantity',
                'order_items.product_id',
                'users.nama',
                'products.product'
            )->get();

        return response()->json(['data' => $orderItem]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //139583
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {

        // return response()->json($request->all());

        DB::table('order_items')->where('id', $id)->update([
            "product_id" => $request->product_id,
            "quantity" => $request->quantity,
            "order_id" => $request->order_id
        ]);

        $order_item =  DB::table('order_items')->where('id', $id)->get();
        return response()->json(['data' => $order_item]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($order_id, $id)
    {
        DB::table('order_items')->where('order_id', $order_id)->where('id', $id)->delete();
        $orderitem = DB::table('order_items')
        ->join('products', 'products.id', '=', 'order_items.product_id')
        ->join('orders', 'orders.id', '=', 'order_items.order_id')
        ->join('users', 'users.id', '=', 'orders.user_id')
        ->where('order_id', $order_id)
        ->select(
            'order_items.id',
            'order_items.order_id',
            'order_items.quantity',
            'order_items.product_id',
            'users.nama',
            'products.product'
        )->get();

        return response()->json(['data' => $orderitem]);
    }

    public function search($product)
    {
        return Product::where('product', 'LIKE', '%' . $product . '%')->get();
    }
}
