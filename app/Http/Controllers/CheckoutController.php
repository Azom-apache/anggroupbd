<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Checkout;
use Illuminate\Http\Request;
use App\Models\CheckoutDetails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data= Session::get('cart');
       $productIds = collect($data)->pluck('product_id')->toArray();
       $carts = Product::whereIn('id', $productIds)->get();
       return view('frontend.website.checkout',compact('carts','data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (! $cart = Session::get('cart')) {
            return redirect()->back()->with(['error' => 'No product in cart']);
        }
      //return $request;
      try {
        DB::beginTransaction();
        $checkout= new Checkout();
        $checkout->name =  $request->name;
        $checkout->phone =  $request->phone;
        $checkout->shipping_address =  $request->shipping_address;
        $checkout->shipping_price =  $request->shipping_price;
        $checkout->total =  $request->total;
        $checkout->user_id =  auth()->user()->id ?? 1;
        $checkout->save();

        foreach($request->product_id as $productId => $quantity) {

        $saleDetails = new CheckoutDetails();
        $saleDetails->checkout_id =  $checkout->id;
        $saleDetails->product_id =  $request->product_id[$productId];
        $saleDetails->sale_price =  $request->sale_price[$productId];
        $saleDetails->quantity = $request->quantity[$productId];
        $saleDetails->user_id = auth()->user()->id ?? 1;
        $saleDetails->save();
        
        }

    DB::commit();
    Session::forget('cart');
    return redirect()->back()->with(['success' => 'Order Success']);
    } catch (\Exception $ex) {
        DB::rollBack();
        report($ex);
        throw $ex;
        return $ex;
    }
      //  $cart=  Session::get('cart');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
