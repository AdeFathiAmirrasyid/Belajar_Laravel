<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EcommerceController extends Controller
{
    public function home()
    {
        $data = ["title" => "title : Home"];
        return view("e_commerce_template/home",$data);
    }

    public function product()
    {
        $data = ["title" => "title : product"];
        return view("e_commerce_template/product",$data);
    }

    public function category()
    {
        $data = ["title" => "title : category"];
        return view("e_commerce_template/category",$data);
    }

    public function cart()
    {
        $data = ["title" => "title : cart"];
        return view("e_commerce_template/cart",$data);
    }

    public function checkout()
    {
        $data = ["title" => "title : checkout"];
        return view("e_commerce_template/checkout",$data);
    }

    public function contact()
    {
        $data = ["title" => "title : contact"];
        return view("e_commerce_template/contact",$data);
    }
}
