<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        //return Session::forget('cart');
          $data= Session::get('cart');
          $productIds = collect($data)->pluck('product_id')->toArray();
          $carts = Product::whereIn('id', $productIds)->get();
        return view('frontend.website.cart',compact('carts','data'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $newProduct = Product::find($request->product_id);
 
        if (Session::get('cart')) {
            foreach (Session::get('cart') as $cart_row) {
                $cartProduct = Product::find($cart_row['product_id']);
               
                // if ($newProduct->shop_id && $newProduct->shop_id != $cartProduct->shop_id) {
                // return redirect()->back()->with(['error' => 'Please add products from single shop']);
                // } elseif ($newProduct->express_shop_id && $newProduct->express_shop_id != $cartProduct->express_shop_id) {
                // return redirect()->back()->with(['error' => 'Please add products from single express']);
                // } elseif (! $newProduct->shop_id && ! $newProduct->express_shop_id) {
                //     if ($cartProduct->shop_id || $cartProduct->express_shop_id) {
                //     return redirect()->back()->with(['error' => 'Please add products from global in single order']);
                //     }
                // }
            }
        }

        if ($request->session()->has('cart')) {
            foreach (Session::get('cart') as $cart_row) {
                if ($cart_row['product_id'] == $request->product_id) {
                    return redirect()->back()->with(['error' => 'The product already in cart']);
                }
            }
            Session::push('cart', [
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);

            return redirect()->back()->with(['success' => 'The product added to cart']);
        } else {
            Session::push('cart', [
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);

            return redirect()->back()->with(['success' => 'The product added to cart']);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $item = Session::get('cart', []);
        
        foreach ($item as $key => $cart) {
            if ($cart['product_id'] == $id) {
                $item[$key]['quantity'] = $request->quantity;
            }
        }
    
        Session::put('cart', $item);
    
        // You can choose to return a JSON response or redirect back, not both.
        return response()->json(['message' => 'Are you want to update']);
        // OR
       return redirect()->back();
    }
    
    public function destroy($id)
    {
        Session::put('cart', array_filter(Session::get('cart', []), function ($item) use ($id) {
            return $item['product_id'] != $id;
        }));

        return redirect()->back()->with('success', 'The item deleted successfully');
    }
}
