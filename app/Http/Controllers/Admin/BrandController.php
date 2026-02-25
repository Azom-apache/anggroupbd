<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Enum\CommonStatus;
use App\Lib\Resource\Field;
use App\Lib\Resource\Column;
use Illuminate\Http\Request;
use App\Traits\ChecksPermission;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
  
    static protected $heading = [
        'index' => 'Brand',
        'create' => 'Create Brand',
        'show' => 'Brand Details',
        'edit' => 'Edit Brand',
    ];
    public function index(Request $request)
    {
        
        if ($request->ajax()) {
            return datatables(Brand::query())->toJson();
        }
        return view('admin.resource.index', [
            'name' => 'admin.brand',
            'heading' => self::$heading,
            'skipPermission'=>false,
            'columns' => [
                Column::make('id'),
                Column::make('name'),
                Column::make('status'),
            ],
            'statusMap' => CommonStatus::class,
        ]);
    }


    public function create() {
        return view('admin.resource.create', [
            'skipPermission'=>false,
            'name'   => 'admin.brand',
            'heading' => self::$heading,
            'fields' => [
                Field::text('name')->required(),
                Field::select('status')->options(CommonStatus::asSelectArray())->required()
            ],
            'statusMap' => CommonStatus::class,
        ]);
        }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable',
        ]);
        $validated['created_by'] =auth()->user()->id; 
        return response()->report(Brand::create($validated));

    }


    public function show(Brand $brand)
    {
        return view('admin.resource.show', [
            'name'             => 'admin.brand',
            'skipPermission'=>false,
            'heading'          => [
                'index'  => 'Brands',
                'show'   => 'Show brand',
            ],
            'model'            => $brand,
            'columns'          => ['name','status'],
        ]);
    }

    public function edit(Brand $brand)
    {
        return view('admin.resource.edit', [
            'model'            => $brand,
            'skipPermission'=>false,
            'name'             => 'admin.brand',
            'heading'          => [
                'index'  => 'Brands',
                'edit'   => 'Edit brand',
            ],
            'fields' => [
                Field::text('name')->required(),
                Field::select('status')->options(CommonStatus::asSelectArray())->required()
            ],
            'statusMap' => CommonStatus::class,
        ]);
    }

    public function update(Request $request, Brand $brand)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable',
        ]);
        return response()->report($brand->update($validated), 'Brand updated successfully');
    }

    public function destroy(Brand $brand)
    {
        try{
            $brand->delete();
            return response()->success('Brand deleted successfully');
        }catch(\Exception $ex){
            return response()->error('Something went wrong');
        }
    }
}
