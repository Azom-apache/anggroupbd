<?php

namespace App\Http\Controllers\Admin;

use App\Models\Notice;
use App\Enum\CommonStatus;
use App\Lib\Resource\Field;
use App\Lib\Resource\Image;
use App\Lib\Resource\Column;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NoticeController extends Controller
{
    static protected $heading = [
        'index' => 'Blogs',
        'create' => 'Create Blogs',
        'show' => 'Blogs Details',
        'edit' => 'Edit Blogs',
    ];
    public function index(Request $request)
    {
        
        if ($request->ajax()) {
            return datatables(Notice::query())->toJson();
        }
        return view('admin.resource.index', [
            'name' => 'admin.notice',
            'heading' => self::$heading,
            'skipPermission'=>false,
            'columns' => [
                Column::make('id'),
                Column::make('notice')->label('Name'),
                Column::make('designation'),
                Column::make('status'),
            ],
            'statusMap' => CommonStatus::class,
        ]);
    }


    public function create() {
        return view('admin.resource.create', [
            'skipPermission'=>false,
            'name'   => 'admin.notice',
            'heading' => self::$heading,
            'fields' => [
                Field::text('notice')->required()->label('Name'),
                Field::text('designation')->required()->label('Designation'),
                Field::textarea('description')->required()->label('Description'),
                Field::file('image')->required()->label('Image'),
                Field::select('status')->options(CommonStatus::asSelectArray())->required()
            ],
            'statusMap' => CommonStatus::class,
        ]);
        }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'notice' => 'required|string',
            'designation' => 'nullable',
            'description' => 'nullable',
            'image' => 'nullable',
            'status' => 'nullable',
        ]);
        $validated['created_by'] =auth()->user()->id; 
        if (!empty($validated['image'])) {
            $validated['image'] = Image::store('image', 'upload/product');
        }
        return response()->report(Notice::create($validated));

    }


    public function show(Notice $notice)
    {
        return view('admin.resource.show', [
            'name'             => 'admin.notice',
            'skipPermission'=>false,
            'heading'          => [
                'index'  => 'Blog',
                'show'   => 'Show Blog',
            ],
            'model'            => $notice,
            'columns'          => ['notice','status'],
        ]);
    }

    public function edit(Notice $notice)
    {
        return view('admin.resource.edit', [
            'model'            => $notice,
            'skipPermission'=>false,
            'name'             => 'admin.notice',
            'heading'          => [
                'index'  => 'Blog',
                'edit'   => 'Edit Blog',
            ],
            'fields' => [
                Field::text('notice')->required()->label('Name'),
                Field::text('designation')->required()->label('Designation'),
                Field::textarea('description')->required()->label('Description'),
                Field::file('image')->required()->label('Image'),
                Field::select('status')->options(CommonStatus::asSelectArray())->required()
            ],
            'statusMap' => CommonStatus::class,
        ]);
    }

    public function update(Request $request, Notice $notice)
    {
        $validated = $request->validate([
            'notice' => 'required|string',
            'designation' => 'nullable',
            'description' => 'nullable',
            'image' => 'nullable',
            'status' => 'nullable',
        ]);
        if (!empty($validated['image'])) {
            $validated['image'] = Image::store('image', 'upload/product');
        }
        return response()->report($notice->update($validated), 'Blog updated successfully');
    }

    public function destroy(Notice $notice)
    {
        try{
            $notice->delete();
            return response()->success('Blog deleted successfully');
        }catch(\Exception $ex){
            return response()->error('Something went wrong');
        }
    }
}
