<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Enum\CommonStatus;
use App\Lib\Resource\Field;
use App\Lib\Resource\Image;
use App\Lib\Resource\Column;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    static protected $heading = [
        'index' => 'News & Event',
        'create' => 'Create News & Event',
        'show' => 'News & Event Details',
        'edit' => 'News & Event Blog',
    ];
    public function index(Request $request)
    {
        
        if ($request->ajax()) {
            return datatables(Blog::query())->toJson();
        }
        return view('admin.resource.index', [
            'name' => 'admin.blog',
            'heading' => self::$heading,
            'skipPermission'=>false,
            'columns' => [
                Column::make('id'),
                Column::make('title'),
                Column::make('date'),
                Column::make('image'),
                Column::make('description'),
                Column::make('status'),
            ],
            'statusMap' => CommonStatus::class,
        ]);
    }


    public function create() {
        return view('admin.resource.create', [
            'skipPermission'=>false,
            'name'   => 'admin.blog',
            'heading' => self::$heading,
            'fields' => [
                Field::text('title')->required(),
                Field::date('date')->required(),
                Field::textarea('description')->required(),
                Field::file('image')->required()->label('image (450 x 300 px)'),
                Field::select('status')->options(CommonStatus::asSelectArray())->required()
            ],
            'statusMap' => CommonStatus::class,
        ]);
        }


    public function store(Request $request)
    {
        $validated = $request->validate([ 
            'title' => 'required|string|max:255',
            'date' => 'nullable',
            'description' => 'nullable',
            'image' => 'nullable',
            'status' => 'nullable',
        ]);
        if (!empty($validated['image'])) {
            $validated['image'] = Image::store('image', 'upload/product');
        }
        return response()->report(Blog::create($validated));

    }


    public function show(Blog $blog)
    {
        return view('admin.resource.show', [
            'name'             => 'admin.blog',
            'skipPermission'=>false,
            'heading'          => [
                'index'  => 'News & Event',
                'show'   => 'Show News & Event',
            ],
            'model'            => $blog,
            'columns'          => ['link','description','status'],
           
        ]);
    }

    public function edit(Blog $blog)
    {
        return view('admin.resource.edit', [
            'model'            => $blog,
            'skipPermission'=>false,
            'name'             => 'admin.blog',
            'heading'          => [
                'index'  => 'News & Event',
                'edit'   => 'Edit News & Event',
            ],
            'fields' => [
                Field::text('title')->required(),
                Field::text('date')->required(),
                Field::textarea('description')->required(),
                Field::file('image')->label('image (450 x 300 px)'),
                Field::select('status')->options(CommonStatus::asSelectArray())->required()
            ],
            'statusMap' => CommonStatus::class,
        ]);
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([ 
            'title' => 'required|string|max:255',
            'date' => 'nullable',
            'description' => 'nullable',
            'image' => 'nullable',
            'status' => 'nullable',
        ]);
        if (!empty($validated['image'])) {
            $validated['image'] = Image::store('image', 'upload/product');
        }
        return response()->report($blog->update($validated), 'Blog updated successfully');
    }

    public function destroy(Blog $blog)
    {
        try{
            $blog->delete();
            return response()->success('Blog deleted successfully');
        }catch(\Exception $ex){
            return response()->error('Something went wrong');
        }
    }
}
