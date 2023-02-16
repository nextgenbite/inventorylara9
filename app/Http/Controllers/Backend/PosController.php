<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Category, Product, Customer,Sell};

class PosController extends Controller
{
    public function index()
    {
        //get last record
$sell = Sell::latest()->first();



        $customers =Customer::latest()->get();
        $products =Product::latest()->get();
        $categories =Category::with('product')->latest()->get();
       return view("backend.pos.index", compact('categories', 'products', 'customers', 'sell'));
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
        return view("backend.pos.miniinvoice
        ");
    }

    public function  paymentstore(Request $request){

        $data= $request->validate([
            'sell_date'=> '',
            'bill_type'=> 'required',
            'final_amount'=> 'required|numeric',
            'customer_id'=> 'required|numeric',
            'discount_amount'=> 'nullable|numeric',
            // 'tax_amount'=> 'nullable|numeric',
            // 'tax'=> 'nullable|numeric',
            // 'invoice_no'=> '',
        ]);


        $data["user_id"] = auth()->user()->id;
        $data["sell_date"] = date("Y-m-d");
        $data["invoice_no"] = $request->invoice_no;
        $sell =Sell::create($data);
        foreach($request->product_id as $key =>$product){
            $qty=$request->quantity[$key];
            $dataProducts = [
                'product_id'=>$product,
                'quantity'=>$qty,
                'unit_price'=>$request->unit_price[$key],
                'discount'=>$request->discount[$key],
            ];

            $sell->sellitem()->create($dataProducts);
        };
        return response()->json($sell, 200);

    }

}
