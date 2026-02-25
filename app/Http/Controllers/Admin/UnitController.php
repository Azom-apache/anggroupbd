<?php

namespace App\Http\Controllers\Admin;

use App\Models\Unit;
use App\Enum\CommonStatus;
use App\Lib\Resource\Field;
use App\Lib\Resource\Column;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UnitController extends Controller
{
    static protected $heading = [
        'index' => 'Unit',
        'create' => 'Create Unit',
        'show' => 'Unit Details',
        'edit' => 'Edit Unit',
    ];
    public function index(Request $request)
    {
        
        if ($request->ajax()) {
            return datatables(Unit::query())->toJson();
        }
        return view('admin.resource.index', [
            'name' => 'admin.unit',
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
            'name'   => 'admin.unit',
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
        return response()->report(Unit::create($validated));

    }


    public function show(Unit $unit)
    {
        return view('admin.resource.show', [
            'name'             => 'admin.unit',
            'skipPermission'=>false,
            'heading'          => [
                'index'  => 'Units',
                'show'   => 'Show unit',
            ],
            'model'            => $unit,
            'columns'          => ['name','status'],
        ]);
    }

    public function edit(Unit $unit)
    {
        return view('admin.resource.edit', [
            'model'            => $unit,
            'skipPermission'=>false,
            'name'             => 'admin.unit',
            'heading'          => [
                'index'  => 'Units',
                'edit'   => 'Edit unit',
            ],
            'fields' => [
                Field::text('name')->required(),
                Field::select('status')->options(CommonStatus::asSelectArray())->required()
            ],
            'statusMap' => CommonStatus::class,
        ]);
    }

    public function update(Request $request, Unit $unit)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable',
        ]);
        return response()->report($unit->update($validated), 'Unit updated successfully');
    }

    public function destroy(Unit $unit)
    {
        try{
            $unit->delete();
            return response()->success('Unit deleted successfully');
        }catch(\Exception $ex){
            return response()->error('Something went wrong');
        }
    }
}
