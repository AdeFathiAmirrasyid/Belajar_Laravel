<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Facade\FlareClient\Http\Response;

class ProductController extends Controller
{
    public function insert()
    {
        $categories = Category::get();
        return view('admin_template/order/insert_products', compact('categories'));
    }
    public function insertAction(Request $request)
    {
        // $product = new Product;
        // $product->category_id = $request->input('category_id');
        // $product->code = $request->input('code');
        // $product->nama = $request->input('nama');
        // $product->stock = $request->input('stock');
        // $product->varian = $request->input('varian');
        // $product->keterangan = $request->input('keterangan');
        // $product->image = $request->input('varian');
        // $product->save();

        $request->validate([
            'code' => 'required|integer',
            'product' => 'required',
            'stock' => 'required|integer',
            'varian' => 'required',
            'keterangan' => 'required',
        ]);
        Product::create($request->all());
        return Redirect('/dashboard/product')->with('status', 'Product Berhasil Ditambahkan');
    }
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::get();
        return view("admin_template.order.edit_products", compact("product", "categories"));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'code' => 'required|integer',
            'product' => 'required',
            'stock' => 'required|integer',
            'varian' => 'required',
            'keterangan' => 'required',
        ]);
        Product::where('id', $product->id)->update([
            "category_id" => $request->category_id,
            "code" => $request->code,
            "product" => $request->product,
            "stock" => $request->stock,
            "varian" => $request->varian,
            "keterangan" => $request->keterangan
        ]);
        return Redirect('/dashboard/product')->with('status', 'Product Berhasil Di ubah');
    }
    public function destroy(Product $product)
    {
        Product::destroy($product->id);
        return Redirect('/dashboard/product')->with('status', 'Product Berhasil Dihapus');
    }

    public function search(Request $request)
    {
        $order_items = $request->get('search');
        $orderItem = Product::where('product', 'like', "%" . $order_items . "%")->get();
        return json_encode($orderItem);
    }
}
