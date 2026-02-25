<?php

namespace App\Http\Controllers\Admin;

use App\Enum\CommonStatus;
use App\Lib\Resource\Field;
use App\Lib\Resource\Image;
use App\Models\Certificate;
use App\Lib\Resource\Column;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CertificateController extends Controller
{
  protected $permissionPrefix = 'certificate';
    static protected $heading = [
        'index' => 'Certificate',
        'create' => 'Create Certificate',
        'show' => 'Certificate Details',
        'edit' => 'Edit Certificate',
    ];
    public function index(Request $request)
    {
        
        if ($request->ajax()) {
            return datatables(Certificate::query())->toJson();
        }
        return view('admin.resource.index', [
            'name' => 'admin.certificate',
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
            'name'   => 'admin.certificate',
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
        return response()->report(Certificate::create($validated));

    }


    public function show(Certificate $certificate)
    {
        return view('admin.resource.show', [
            'name'             => 'admin.certificate',
            'skipPermission'=>false,
            'heading'          => [
                'index'  => 'Certificate',
                'show'   => 'Show certificate',
            ],
            'model'            => $certificate,
            'columns'          => ['title','image','status'],
           
        ]);
    }

    public function edit(Certificate $certificate)
    {
        return view('admin.resource.edit', [
            'model'            => $certificate,
            'skipPermission'=>false,
            'name'             => 'admin.certificate',
            'heading'          => [
                'index'  => 'Certificate',
                'edit'   => 'Edit certificate',
            ],
            'fields' => [
                Field::text('title')->required(),
                Field::file('image')->label('Image(500 x 500 px)'),
                Field::select('status')->options(CommonStatus::asSelectArray())->required()
            ],
            'statusMap' => CommonStatus::class,
        ]);
    }

    public function update(Request $request, Certificate $certificate)
    {
        $validated = $request->validate([ 
            'title' => 'required|string|max:255',
            'image' => 'nullable',
            'status' => 'nullable',
        ]);
        if (!empty($validated['image'])) {
            $validated['image'] = Image::store('image', 'upload/product');
        }
        return response()->report($certificate->update($validated), 'Certificate updated successfully');
    }

    public function destroy(Certificate $certificate)
    {
        try{
            $certificate->delete();
            return response()->success('Certificate deleted successfully');
        }catch(\Exception $ex){
            return response()->error('Something went wrong');
        }
    }
}