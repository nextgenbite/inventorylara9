<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Customer;
class PosController extends Controller
{
    public function index()
    {
        $customers =Customer::latest()->get();
        $products =Product::latest()->get();
        $categories =Category::with('product')->latest()->get();
       return view("backend.pos.index", compact('categories', 'products', 'customers'));
    }
    public function searchProduct()
    {
        if (request()->ajax()) {

            $data = Product::where("product_name", "Like" ,"%".request()->search. "%")->first();
           return  response()->json(["data" =>$data], 200);
        }
    }
    public function searchCustomer()
    {
        if (request()->ajax()) {

            $data = Customer::where("name", "Like" ,"%".request()->search. "%")->first();
           return  response()->json(["data" =>$data], 200);
        }
    }
    public function productShow($id)
    {
        if (request()->ajax()) {

            $data = Product::findOrFail($id);
           return  response()->json(["data" =>$data], 200);
        }
    }

    public function Posinvoice($id){
        return view("backend.pos.invoice");
    }


}
