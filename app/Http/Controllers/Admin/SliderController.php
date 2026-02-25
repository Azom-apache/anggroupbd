<?php

namespace App\Http\Controllers\Admin;

use App\Lib\Resource\Image;
use App\Models\Slider;
use App\Enum\CommonStatus;
use App\Lib\Resource\Field;
use App\Lib\Resource\Column;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{
    static protected $heading = [
        'index' => 'Slider',
        'create' => 'Create Slider',
        'show' => 'Slider Details',
        'edit' => 'Edit Slider',
    ];
    public function index(Request $request)
    {
        
        if ($request->ajax()) {
            return datatables(Slider::query())->toJson();
        }
        return view('admin.resource.index', [
            'name' => 'admin.slider',
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
            'name'   => 'admin.slider',
            'heading' => self::$heading,
            'fields' => [
                Field::text('title')->required()->label('Title'),
                Field::file('image')->required(),
                Field::textarea('description')->required()->label('Description'),

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
            'description' => 'nullable',
            'status' => 'nullable',
        ]);
        if (!empty($validated['image'])) {
            $validated['image'] = Image::store('image', 'upload/slider');
        }


        return response()->report(Slider::create($validated));

    }


    public function show(Slider $slider)
    {
        return view('admin.resource.show', [
            'name'             => 'admin.slider',
            'skipPermission'=>false,
            'heading'          => [
                'index'  => 'Slider',
                'show'   => 'Show slider',
            ],
            'model'            => $slider,
            'columns'          => ['title','image','status'],
        ]);
    }

    public function edit(Slider $slider)
    {
        return view('admin.resource.edit', [
            'model'            => $slider,
            'skipPermission'=>false,
            'name'             => 'admin.slider',
            'heading'          => [
                'index'  => 'Sliders',
                'edit'   => 'Edit slider',
            ],
            'fields' => [
                Field::text('title')->required(),
                Field::file('image'),
                Field::textarea('description')->required()->label('Description'),
                Field::select('status')->options(CommonStatus::asSelectArray())->required()
            ],
            'statusMap' => CommonStatus::class,
        ]);
    }

    public function update(Request $request, Slider $slider)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable',
            'description' => 'nullable',
            'status' => 'nullable',
        ]);
        if (!empty($validated['image'])) {
            $validated['image'] = Image::store('image', 'upload/slider');
        }
        return response()->report($slider->update($validated), 'Slider updated successfully');
    }

    public function destroy(Slider $slider)
    {
        try{
            $slider->delete();
            return response()->success('Slider deleted successfully');
        }catch(\Exception $ex){
            return response()->error('Something went wrong');
        }
    }
}
