<?php

namespace App\Http\Controllers\Admin;

use App\Models\Attribute;
use App\Enum\CommonStatus;
use App\Lib\Resource\Field;
use App\Lib\Resource\Column;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttributeController extends Controller
{
    static protected $heading = [
        'index' => 'Attribute',
        'create' => 'Create Attribute',
        'show' => 'Attribute Details',
        'edit' => 'Edit Attribute',
    ];
    public function index(Request $request)
    {
        
        if ($request->ajax()) {
            return datatables(Attribute::query())->toJson();
        }
        return view('admin.resource.index', [
            'name' => 'admin.attribute',
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
            'name'   => 'admin.attribute',
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
        return response()->report(Attribute::create($validated));

    }


    public function show(Attribute $attribute)
    {
        return view('admin.resource.show', [
            'name'             => 'admin.attribute',
            'skipPermission'=>false,
            'heading'          => [
                'index'  => 'Attribute',
                'show'   => 'Show attribute',
            ],
            'model'            => $attribute,
            'columns'          => ['name','status'],
        ]);
    }

    public function edit(Attribute $attribute)
    {
        return view('admin.resource.edit', [
            'model'            => $attribute,
            'skipPermission'=>false,
            'name'             => 'admin.attribute',
            'heading'          => [
                'index'  => 'Attribute',
                'edit'   => 'Edit attribute',
            ],
            'fields' => [
                Field::text('name')->required(),
                Field::select('status')->options(CommonStatus::asSelectArray())->required()
            ],
            'statusMap' => CommonStatus::class,
        ]);
    }

    public function update(Request $request, Attribute $attribute)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable',
        ]);
        return response()->report($attribute->update($validated), 'Attribute updated successfully');
    }

    public function destroy(Attribute $attribute)
    {
        try{
            $attribute->delete();
            return response()->success('Attribute deleted successfully');
        }catch(\Exception $ex){
            return response()->error('Something went wrong');
        }
    }
}
