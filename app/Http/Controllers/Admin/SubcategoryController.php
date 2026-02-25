<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Enum\CommonStatus;
use App\Lib\Resource\Field;
use App\Models\Subcategory;
use App\Lib\Resource\Column;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubcategoryController extends Controller
{
    static protected $heading = [
        'index' => 'Subcategory',
        'create' => 'Create Subcategory',
        'show' => 'Subcategory Details',
        'edit' => 'Edit Subcategory',
    ];
    public function index(Request $request)
    {
        
        if ($request->ajax()) {
            return datatables(Subcategory::query())->toJson();
        }
        return view('admin.resource.index', [
            'name' => 'admin.subcategory',
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
            'name'   => 'admin.subcategory',
            'heading' => self::$heading,
            'fields' => [
                Field::select('category_id')->label('Category')->options(Category::select(['id','name'])->where('status', CommonStatus::Active)->get())->required(),
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
            'category_id' => 'required',
            'status' => 'nullable',
        ]);
        $validated['created_by'] =auth()->user()->id; 
        return response()->report(Subcategory::create($validated));

    }


    public function show(Subcategory $subcategory)
    {
        return view('admin.resource.show', [
            'name'             => 'admin.subcategory',
            'skipPermission'=>false,
            'heading'          => [
                'index'  => 'Subcategory',
                'show'   => 'Show subcategory',
            ],
            'model'            => $subcategory,
            'columns'          => ['name','status'],
           
        ]);
    }

    public function edit(Subcategory $subcategory)
    {
        return view('admin.resource.edit', [
            'model'            => $subcategory,
            'skipPermission'=>false,
            'name'             => 'admin.subcategory',
            'heading'          => [
                'index'  => 'Subcategory',
                'edit'   => 'Edit subcategory',
            ],
            'fields' => [
                Field::select('category_id')->label('Category')->options(Category::select(['id','name'])->where('status', CommonStatus::Active)->get())->required(),
                Field::text('name')->required(),
                Field::select('status')->options(CommonStatus::asSelectArray())->required()
            ],
            'statusMap' => CommonStatus::class,
        ]);
    }

    public function update(Request $request, Subcategory $subcategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required',
            'status' => 'nullable',
        ]);
        return response()->report($subcategory->update($validated), 'Subcategory updated successfully');
    }

    public function destroy(Subcategory $subcategory)
    {
        try{
            $subcategory->delete();
            return response()->success('Subcategory deleted successfully');
        }catch(\Exception $ex){
            return response()->error('Something went wrong');
        }
    }
}
