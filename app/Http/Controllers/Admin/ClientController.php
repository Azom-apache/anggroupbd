<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use App\Enum\CommonStatus;
use App\Lib\Resource\Field;
use App\Lib\Resource\Image;
use App\Lib\Resource\Column;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    static protected $heading = [
        'index' => 'Sister Concerns​',
        'create' => 'Create Sister Concerns​',
        'show' => 'Sister Concerns​ Details',
        'edit' => 'Edit Sister Concerns​',
    ];
    public function index(Request $request)
    {
        
        if ($request->ajax()) {
            return datatables(Client::query())->toJson();
        }
        return view('admin.resource.index', [
            'name' => 'admin.client',
            'heading' => self::$heading,
            'skipPermission'=>false,
            'columns' => [
                Column::make('id'),
                Column::make('name'),
                Column::make('designation')->label('Short Text'),
                Column::make('image')->label('Profile'),
                Column::make('status'),
            ],
            'statusMap' => CommonStatus::class,
        ]);
    }


    public function create() {
        return view('admin.resource.create', [
            'skipPermission'=>false,
            'name'   => 'admin.client',
            'heading' => self::$heading,
            'fields' => [
                Field::text('name')->required(),
                Field::text('designation')->required()->label('Short Text'),
                Field::textarea('description'),
                Field::file('image')->label('Image/Logo'),
                Field::file('pdf')->label('Profile Pdf'),
                Field::select('status')->options(CommonStatus::asSelectArray())->required()
            ],
            'statusMap' => CommonStatus::class,
        ]);
        }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable',
            'pdf' => 'nullable',
            'designation' => 'nullable',
            'description' => 'nullable',
            'status' => 'nullable',
        ]);
        $validated['created_by'] =auth()->user()->id; 
        if (!empty($validated['image'])) {
            $validated['image'] = Image::store('image', 'upload/product');
        }
        if (!empty($validated['pdf'])) {
            $validated['pdf'] = Image::store('pdf', 'upload/product');
        }
        return response()->report(Client::create($validated));

    }


    public function show(Client $client)
    {
        return view('admin.resource.show', [
            'name'             => 'admin.client',
            'skipPermission'=>false,
            'heading'          => [
                'index'  => 'Client',
                'show'   => 'Show client',
            ],
            'model'            => $client,
            'columns'          => ['name','image','status'],
           
        ]);
    }

    public function edit(Client $client)
    {
        return view('admin.resource.edit', [
            'model'            => $client,
            'skipPermission'=>false,
            'name'             => 'admin.client',
            'heading'          => [
                'index'  => 'Client',
                'edit'   => 'Edit client',
            ],
            'fields' => [
                Field::text('name')->required(),
                Field::text('designation')->required()->label('Short Text'),
                Field::textarea('description'),
                Field::file('image')->label('Image/Logo'),
                Field::file('pdf')->label('Profile Pdf'),
                Field::select('status')->options(CommonStatus::asSelectArray())->required()
            ],
            'statusMap' => CommonStatus::class,
        ]);
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable',
            'designation' => 'nullable',
            'description' => 'nullable',
            'image' => 'nullable',
            'pdf' => 'nullable',
        ]);
        if (!empty($validated['image'])) {
            $validated['image'] = Image::store('image', 'upload/product');
        }
        if (!empty($validated['pdf'])) {
            $validated['pdf'] = Image::store('pdf', 'upload/product');
        }
        return response()->report($client->update($validated), 'Sister consern updated successfully');
    }

    public function destroy(Client $client)
    {
        try{
            $client->delete();
            return response()->success('Client deleted successfully');
        }catch(\Exception $ex){
            return response()->error('Something went wrong');
        }
    }
}
