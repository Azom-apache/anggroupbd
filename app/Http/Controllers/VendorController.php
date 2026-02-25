<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Admin;
use App\Models\Role;
use App\Lib\Resource\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('frontend.vendor.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
      
        $validated = $request->validate([
            'name'    => 'required',
            'email'   => 'required',
            'phone'   => 'required',
            'shop_name'   => 'required',
            'address'   => 'nullable',
            'password' => 'required|confirmed',
            'image'   => 'nullable',
            'trade_licence'   => 'nullable',
            'status'  => 'nullable',
        ]);
        if (!empty($validated['image'])) {
            $validated['image'] = Image::store('image', 'upload/product');
        }
        if (!empty($validated['trade_licence'])) {
            $validated['trade_licence'] = Image::store('trade_licence', 'upload/vendor');
        }
        if ($validated['password']) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }
       // Admin::create($validated);
       // example:
       
       


       try {
        return response()->report(DB::transaction(function () use ($validated) {
            $admin = Admin::create($validated);
           $admin->vendor()->create($validated);
            $admin->addRole('vendor');
            return redirect()->back()->with(['success' => 'Vendor create successfully']);
        }));
       
    } catch (\Exception $e) {
        return $e;
    }
       
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
