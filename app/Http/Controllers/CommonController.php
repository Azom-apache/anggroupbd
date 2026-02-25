<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Enum\ProductStatus;
use Illuminate\Http\Request;

class CommonController extends Controller
{

     public function submit(Request $request)
    {
    $validated = $request->validate([
        'the_name' => 'required|string|max:255',
        'the_email' => 'required|email',
        'the_message' => 'required|string',
    ]);

    Contact::create($validated);

    return back()->with('success', 'Thank you! Your message has been sent.');

    }


    public function sister(Request $request)
    {
        $sister = Client::find($request->id);
        $menus =Menu::where('client_id',$sister->id)->get();
        
        return view('frontend.sister',compact('sister','menus'));
    }
     public function products(Request $request)
    {
        $sister = Client::find($request->id);
        $menus =Menu::where('client_id',$sister->id)->get();
        $products =Product::where('sister_id',$sister->id)->get();
        
        return view('frontend.products',compact('sister','menus','products'));
    }
    public function search(Request $request)
    {
        $products = Product::where('name_en', 'like', '%' . $request->search . '%')
        ->where('status', ProductStatus::Active)
        ->get();
        return view('frontend.productsPage',compact('products'));
    }

    public function categoryproduct(Request $request)
    {
        $products = Product::where('category_id', $request->search)
        ->where('status', ProductStatus::Active)
        ->get();
        if ($products->isNotEmpty()) {
            return view('frontend.category', compact('products'));
        } else {
            $products = Category::where('id', $request->search)->get(); // Use `first()` to get a single category
            return view('frontend.categoryproduct', compact('products'));
        }
    
    }
}
