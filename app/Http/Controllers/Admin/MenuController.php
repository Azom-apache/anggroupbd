<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Models\Client;
use App\Enum\CommonStatus;
use App\Lib\Resource\Field;
use App\Lib\Resource\Image;
use App\Lib\Resource\Column;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    static protected $heading = [
        'index' => 'Menu',
        'create' => 'Create Menu',
        'show' => 'Menu Details',
        'edit' => 'Edit Menu',
    ];
    public function index(Request $request)
    {
        
        if ($request->ajax()) {
            return datatables(Menu::with('client'))->toJson();
        }
        return view('admin.resource.index', [
            'name' => 'admin.menu',
            'heading' => self::$heading,
            'skipPermission'=>false,
            'columns' => [
                Column::make('id'),
                Column::make('menu_name'),
                Column::make('client.name'),
                Column::make('status'),
            ],
            'statusMap' => CommonStatus::class,
        ]);
    }


    public function create() {
        return view('admin.resource.create', [
            'skipPermission'=>false,
            'name'   => 'admin.menu',
            'heading' => self::$heading,
            'fields' => [
               Field::select('client_id')->label('Sister Concerns')->options(Client::select('id', 'name')->get()),
                Field::text('menu_name')->required(),
                Field::text('title'),
                Field::file('image'),
                Field::textarea('description_en')->label('Description ')->isEditor(),
                Field::select('status')->options(CommonStatus::asSelectArray())->required()
            ],
            'statusMap' => CommonStatus::class,
        ]);
        }


    public function store(Request $request)
    {
        $validated = $request->validate([
              'menu_name' => 'required|string|max:255',
            'client_id' => 'nullable',
            'title' => 'nullable',
            'status' => 'nullable',
            'description_en' => 'nullable',
            'image' => 'nullable',
        ]);
        $validated['created_by'] =auth()->user()->id; 
        if (!empty($validated['image'])) {
            $validated['image'] = Image::store('image', 'upload/product');
        }
        return response()->report(Menu::create($validated));

    }


    public function show(Menu $menu)
    {
        return view('admin.resource.show', [
            'name'             => 'admin.menu',
            'skipPermission'=>false,
            'heading'          => [
                'index'  => 'Menu',
                'show'   => 'Show menu',
            ],
            'model'            => $menu,
            'columns'          => ['name','image','status'],
           
        ]);
    }

    public function edit(Menu $menu)
    {
        return view('admin.resource.edit', [
            'model'            => $menu,
            'skipPermission'=>false,
            'name'             => 'admin.menu',
            'heading'          => [
                'index'  => 'Menu',
                'edit'   => 'Edit menu',
            ],
            'fields' => [
                Field::select('client_id')->label('Sister Concerns')->options(Client::select('id', 'name')->get()),
                Field::text('menu_name')->required(),
                Field::text('title'),
                Field::file('image'),
                Field::textarea('description_en')->label('Description ')->isEditor(),
                Field::select('status')->options(CommonStatus::asSelectArray())->required()
            ],
            'statusMap' => CommonStatus::class,
        ]);
    }

    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'menu_name' => 'required|string|max:255',
            'client_id' => 'nullable',
            'title' => 'nullable',
            'status' => 'nullable',
            'description_en' => 'nullable',
            'image' => 'nullable',
        ]);
        if (!empty($validated['image'])) {
            $validated['image'] = Image::store('image', 'upload/product');
        }
        return response()->report($menu->update($validated), 'Menu updated successfully');
    }

    public function destroy(Menu $menu)
    {
        try{
            $menu->delete();
            return response()->success('Menu deleted successfully');
        }catch(\Exception $ex){
            return response()->error('Something went wrong');
        }
    }
}
