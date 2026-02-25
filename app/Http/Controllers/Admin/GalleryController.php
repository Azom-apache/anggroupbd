<?php

namespace App\Http\Controllers\Admin;

use App\Lib\Field;
use App\Lib\Image;



use App\Lib\Column;
use App\Models\Gallery;

use App\Enum\CommonStatus;
use Illuminate\Http\Request;
use App\Traits\ChecksPermission;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    use ChecksPermission;
    protected $permissionPrefix = 'gallery';
    static protected $heading = [
        'index' => 'Partner',
        'create' => 'Create Partner',
        'show' => 'Partner Details',
        'edit' => 'Edit Partner',
    ];
    public function index(Request $request)
    {
        
        if ($request->ajax()) {
            return datatables(Gallery::query())->toJson();
        }
        return view('admin.resource.index', [
            'name' => 'admin.gallery',
            'heading' => self::$heading,
            'skipPermission'=>false,
            'columns' => [
                Column::make('id'),
                Column::make('image'),
                Column::make('title'),
                Column::make('status'),
            ],
            'statusMap' => CommonStatus::class,
        ]);
    }


    public function create() {
        return view('admin.resource.create', [
            'skipPermission'=>false,
            'name'   => 'admin.gallery',
            'heading' => self::$heading,
            'fields' => [
                Field::text('title')->required(),
                Field::file('image')->required()->label('Image(500 x 500 px)'),
                Field::select('status')->options(CommonStatus::asSelectArray())->required()
            ],
            'statusMap' => CommonStatus::class,
        ]);
        }


    public function store(Request $request)
    {
        $validated = $request->validate([ 
            'title' => 'required|string|max:255',
            'image' => 'nullable',
            'status' => 'nullable',
        ]);
        if (!empty($validated['image'])) {
            $validated['image'] = Image::store('image', 'upload/product');
        }
        return response()->report(Gallery::create($validated));

    }


    public function show(Gallery $gallery)
    {
        return view('admin.resource.show', [
            'name'             => 'admin.gallery',
            'skipPermission'=>false,
            'heading'          => [
                'index'  => 'Gallery',
                'show'   => 'Show gallery',
            ],
            'model'            => $gallery,
            'columns'          => ['title','image','status'],
           
        ]);
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.resource.edit', [
            'model'            => $gallery,
            'skipPermission'=>false,
            'name'             => 'admin.gallery',
            'heading'          => [
                'index'  => 'Gallery',
                'edit'   => 'Edit gallery',
            ],
            'fields' => [
                Field::text('title')->required(),
                Field::file('image')->label('Image(500 x 500 px)'),
                Field::select('status')->options(CommonStatus::asSelectArray())->required()
            ],
            'statusMap' => CommonStatus::class,
        ]);
    }

    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([ 
            'title' => 'required|string|max:255',
            'image' => 'nullable',
            'status' => 'nullable',
        ]);
        if (!empty($validated['image'])) {
            $validated['image'] = Image::store('image', 'upload/product');
        }
        return response()->report($gallery->update($validated), 'Gallery updated successfully');
    }

    public function destroy(Gallery $gallery)
    {
        try{
            $gallery->delete();
            return response()->success('Gallery deleted successfully');
        }catch(\Exception $ex){
            return response()->error('Something went wrong');
        }
    }
}
