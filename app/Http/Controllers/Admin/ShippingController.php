<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shipping;
use App\Enum\CommonStatus;
use App\Lib\Resource\Field;
use App\Lib\Resource\Column;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShippingController extends Controller
{
    static protected $heading = [ 
        'index' => 'Shipping',
        'create' => 'Create Shipping',
        'show' => 'Shipping Details',
        'edit' => 'Edit Shipping',
    ];
    public function index(Request $request)
    {
        
        if ($request->ajax()) {
            return datatables(Shipping::query())->toJson();
        }
        return view('admin.resource.index', [
            'name' => 'admin.shipping',
            'heading' => self::$heading,
            'skipPermission'=>false,
            'columns' => [
                Column::make('id'),
                Column::make('address'),
                Column::make('price'),
                Column::make('status'),
            ],
            'statusMap' => CommonStatus::class,
        ]);
    }


    public function create() {
        return view('admin.resource.create', [
            'skipPermission'=>false,
            'name'   => 'admin.shipping',
            'heading' => self::$heading,
            'fields' => [
                Field::text('address')->required(),
                Field::number('price')->required(),
                Field::select('status')->options(CommonStatus::asSelectArray())->required()
            ],
            'statusMap' => CommonStatus::class,
        ]);
        }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'address' => 'required',
            'price' => 'required',
            'status' => 'nullable',
        ]);
        $validated['created_by'] =auth()->user()->id; 
        return response()->report(Shipping::create($validated));

    }


    public function show(Shipping $shipping)
    {
        return view('admin.resource.show', [
            'name'             => 'admin.shipping',
            'skipPermission'=>false,
            'heading'          => [
                'index'  => 'Brands',
                'show'   => 'Show shipping',
            ],
            'model'            => $shipping,
            'columns'          => ['address','price','status'],
        ]);
    }

    public function edit(Shipping $shipping)
    {
        return view('admin.resource.edit', [
            'model'            => $shipping,
            'skipPermission'=>false,
            'name'             => 'admin.shipping',
            'heading'          => [
                'index'  => 'Shipping',
                'edit'   => 'Edit shipping',
            ],
            'fields' => [
                Field::text('address')->required(),
                Field::number('price')->required(),
                Field::select('status')->options(CommonStatus::asSelectArray())->required()
            ],
            'statusMap' => CommonStatus::class,
        ]);
    }

    public function update(Request $request, Shipping $shipping)
    {
        $validated = $request->validate([
            'address' => 'required',
            'price' => 'required',
            'status' => 'nullable',
        ]);
        return response()->report($shipping->update($validated), 'Shipping updated successfully');
    }

    public function destroy(Shipping $shipping)
    {
        try{
            $shipping->delete();
            return response()->success('Shipping deleted successfully');
        }catch(\Exception $ex){
            return response()->error('Something went wrong');
        }
    }
}
