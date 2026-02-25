<?php

namespace App\Http\Controllers\Admin;

use App\Models\Team;
use App\Enum\CommonStatus;
use App\Lib\Resource\Field;
use App\Lib\Resource\Image;
use App\Lib\Resource\Column;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeamController extends Controller
{
    static protected $heading = [
        'index' => 'Board of Advisor',
        'create' => 'Create Board of Advisor',
        'show' => 'Board of Advisor Details',
        'edit' => 'Edit Board of Advisor',
    ];
    public function index(Request $request)
    {
        
        if ($request->ajax()) {
            return datatables(Team::query())->toJson();
        }
        return view('admin.resource.index', [
            'name' => 'admin.team',
            'heading' => self::$heading,
            'skipPermission'=>false,
            'columns' => [
                Column::make('id'),
                Column::make('image'),
                Column::make('name'),
                Column::make('designation'),
                Column::make('status'),
            ],
            'statusMap' => CommonStatus::class,
        ]);
    }


    public function create() {
        return view('admin.resource.create', [
            'skipPermission'=>false,
            'name'   => 'admin.team',
            'heading' => self::$heading,
            'fields' => [
                Field::text('name')->required(),
                Field::text('designation')->required(),
                Field::text('description'),
                Field::text('fb_link'),
                Field::text('linking_link'),
                Field::text('instagram_link'),
                Field::file('image')->required()->label('Image(500 x 500 px)'),
                Field::select('status')->options(CommonStatus::asSelectArray())->required()
            ],
            'statusMap' => CommonStatus::class,
        ]);
        }


    public function store(Request $request)
    {
        $validated = $request->validate([ 
            'name' => 'required|string|max:255',
            'designation' => 'nullable',
            'description' => 'nullable',
            'fb_link' => 'nullable',
            'linking_link' => 'nullable',
            'instagram_link' => 'nullable',
            'image' => 'nullable',
            'status' => 'nullable',
        ]);
        if (!empty($validated['image'])) {
            $validated['image'] = Image::store('image', 'upload/product');
        }
        return response()->report(Team::create($validated));

    }


    public function show(Team $team)
    {
        return view('admin.resource.show', [
            'name'             => 'admin.team',
            'skipPermission'=>false,
            'heading'          => [
                'index'  => 'Board of Advisor',
                'show'   => 'Show Board of Advisor',
            ],
            'model'            => $team,
            'columns'          => ['title','image','status'],
           
        ]);
    }

    public function edit(Team $team)
    {
        return view('admin.resource.edit', [
            'model'            => $team,
            'skipPermission'=>false,
            'name'             => 'admin.team',
            'heading'          => [
                'index'  => 'Board of Advisor',
                'edit'   => 'Edit Board of Advisor',
            ],
            'fields' => [
                Field::text('name')->required(),
                Field::text('designation')->required(),
                Field::text('description'),
                Field::text('fb_link'),
                Field::text('linking_link'),
                Field::text('instagram_link'),
                Field::file('image')->label('Image(500 x 500 px)'),
                Field::select('status')->options(CommonStatus::asSelectArray())->required()
            ],
            'statusMap' => CommonStatus::class,
        ]);
    }

    public function update(Request $request, Team $team)
    {
        $validated = $request->validate([ 
            'name' => 'required|string|max:255',
            'designation' => 'nullable',
            'description' => 'nullable',
            'fb_link' => 'nullable',
            'linking_link' => 'nullable',
            'instagram_link' => 'nullable',
            'image' => 'nullable',
            'status' => 'nullable',
        ]);
        if (!empty($validated['image'])) {
            $validated['image'] = Image::store('image', 'upload/product');
        }
        return response()->report($team->update($validated), 'Team updated successfully');
    }

    public function destroy(Team $team)
    {
        try{
            $team->delete();
            return response()->success('Team deleted successfully');
        }catch(\Exception $ex){
            return response()->error('Something went wrong');
        }
    }
}
