<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
class PosController extends Controller
{
    public function index()
    {
       return view("backend.pos.index");
    }
    public function searchProduct()
    {
        if (request()->ajax()) {

            $data = Product::where("product_name", "Like" ,"%".request()->search. "%")->first();
           return  response()->json(["data" =>$data], 200);
        }
    }


}
