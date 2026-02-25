<?php

namespace App\Http\Controllers\Admin;


use App\Models\Image;
use App\Enum\CommonStatus;
use App\Lib\Resource\Field;
use App\Lib\Resource\Column;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
    static protected $heading = [
        'index' => 'Image',
        'create' => 'Create Image',
        'show' => 'Image Details',
        'edit' => 'Edit Image',
    ];
    public function index(Request $request)
    {
        
        if ($request->ajax()) {
            return datatables(Image::query())->toJson();
        }
        return view('admin.resource.index', [
            'name' => 'admin.image',
            'heading' => self::$heading,
            'skipPermission'=>false,
            'columns' => [
                Column::make('id'),
                Column::make('title'),
                Column::make('image'),
                Column::make('status'),
            ],
            'statusMap' => CommonStatus::class,
        ]);
    }


    public function create() {
        return view('admin.resource.create', [
            'skipPermission'=>false,
            'name'   => 'admin.image',
            'heading' => self::$heading,
            'fields' => [
                Field::text('title')->required()->label('Title'),
                Field::file('image')->required(),
                Field::select('status')->options(CommonStatus::asSelectArray())->required()
            ],
            'statusMap' => CommonStatus::class,
        ]);
        }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required',
            'status' => 'nullable',
        ]);
        if (!empty($validated['image'])) {
            $validated['image'] = \App\Lib\Resource\Image::store('image', 'upload/slider');
        }

        return response()->report(Image::create($validated));

    }


    public function show(Image $image)
    {
        return view('admin.resource.show', [
            'name'             => 'admin.image',
            'skipPermission'=>false,
            'heading'          => [
                'index'  => 'Image',
                'show'   => 'Show image',
            ],
            'model'            => $image,
            'columns'          => ['title','image','status'],
        ]);
    }

    public function edit(Image $image)
    {
        return view('admin.resource.edit', [
            'model'            => $image,
            'skipPermission'=>false,
            'name'             => 'admin.image',
            'heading'          => [
                'index'  => 'Images',
                'edit'   => 'Edit image',
            ],
            'fields' => [
                Field::text('title')->required(),
                Field::file('image'),
                Field::select('status')->options(CommonStatus::asSelectArray())->required()
            ],
            'statusMap' => CommonStatus::class,
        ]);
    }

    public function update(Request $request, Image $image)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable',
            'status' => 'nullable',
        ]);
        if (!empty($validated['image'])) {
            $validated['image'] =  \App\Lib\Resource\Image::store('image', 'upload/slider');
        }
        return response()->report($image->update($validated), 'Image updated successfully');
    }

    public function destroy(Image $image)
    {
        try{
            $image->delete();
            return response()->success('Image deleted successfully');
        }catch(\Exception $ex){
            return response()->error('Something went wrong');
        }
    }
}
