<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Users;

class DashboardController extends Controller
{
    public function index()
    {
        return view("admin_template/halaman_admin/index");
    }
    public function product()
    {
        $products = Product::paginate(10);
        return view('admin_template/products/products', compact('products'));
    }
    public function users()
    {
        $users = Users::paginate(20);
        return view('admin_template/user/users', compact('users'));
    }

    public function insert()
    {
        $insert = Users::paginate(20);
        return view('admin_template/order/insert', compact('insert'));
    }

    // Controller Untuk USER
    public function dashboard()
    {
        return view("admin_template/halaman_admin/index");
    }
}
