<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Category;
use App\Enum\CommonStatus;
use App\Lib\Resource\Field;
use App\Lib\Resource\Image;
use App\Lib\Resource\Column;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    static protected $heading = [
        'index' => 'Category',
        'create' => 'Create Category',
        'show' => 'Category Details',
        'edit' => 'Edit Category',
    ];
    public function index(Request $request)
    {
        
        if ($request->ajax()) {
            return datatables(Category::with('brand'))->toJson();
        }
        return view('admin.resource.index', [
            'name' => 'admin.category',
            'heading' => self::$heading,
            'skipPermission'=>false,
            'columns' => [
                Column::make('id'),
                Column::make('name'),
                Column::make('brand.name')->label('Mwnu type'),
                Column::make('image'),
                Column::make('status'),
            ],
            'statusMap' => CommonStatus::class,
        ]);
    }


    public function create() {
        return view('admin.resource.create', [
            'skipPermission'=>false,
            'name'   => 'admin.category',
            'heading' => self::$heading,
            'fields' => [
                
                Field::select('brand_id')->label('Menu Type')->options(Brand::select('id', 'name')->get()),
                Field::text('name')->required(),
                Field::file('image'),
                Field::textarea('description_en')->label('Description')->isEditor(),
                Field::select('status')->options(CommonStatus::asSelectArray())->required()
            ],
            'statusMap' => CommonStatus::class,
        ]);
        }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand_id' => 'nullable',
            'image' => 'nullable',
            'description_en' => 'nullable',
            'status' => 'nullable',
        ]);
        $validated['created_by'] =auth()->user()->id; 
        if (!empty($validated['image'])) {
            $validated['image'] = Image::store('image', 'upload/product');
        }
        return response()->report(Category::create($validated));

    }


    public function show(Category $category)
    {
        return view('admin.resource.show', [
            'name'             => 'admin.category',
            'skipPermission'=>false,
            'heading'          => [
                'index'  => 'Category',
                'show'   => 'Show category',
            ],
            'model'            => $category,
            'columns'          => ['name','image','status'],
           
        ]);
    }

    public function edit(Category $category)
    {
        return view('admin.resource.edit', [
            'model'            => $category,
            'skipPermission'=>false,
            'name'             => 'admin.category',
            'heading'          => [
                'index'  => 'Category',
                'edit'   => 'Edit category',
            ],
            'fields' => [
                Field::select('brand_id')->label('Menu Type')->options(Brand::select('id', 'name')->get()),
                Field::text('name')->required(),
                Field::file('image'),
                Field::textarea('description_en')->label('Description ')->isEditor(),
                Field::select('status')->options(CommonStatus::asSelectArray())->required()
            ],
            'statusMap' => CommonStatus::class,
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand_id' => 'nullable',
            'status' => 'nullable',
            'description_en' => 'nullable',
            'image' => 'nullable',
        ]);
        if (!empty($validated['image'])) {
            $validated['image'] = Image::store('image', 'upload/product');
        }
        return response()->report($category->update($validated), 'Category updated successfully');
    }

    public function destroy(Category $category)
    {
        try{
            $category->delete();
            return response()->success('Category deleted successfully');
        }catch(\Exception $ex){
            return response()->error('Something went wrong');
        }
    }
}
