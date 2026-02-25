<?php

namespace App\Http\Controllers\Admin;

use App\Enum\CommonStatus;
use App\Lib\Resource\Field;
use App\Lib\Resource\Column;
use Illuminate\Http\Request;
use App\Models\Termsandcondition;
use App\Http\Controllers\Controller;

class TermsandconditionController extends Controller
{
    static protected $heading = [
        'index' => 'Terms and condition',
        'create' => 'Create Terms and condition',
        'show' => 'Terms and condition Details',
        'edit' => 'Edit Terms and condition',
    ];
    public function index(Request $request)
    {
        
        if ($request->ajax()) {
            return datatables(Termsandcondition::query())->rawColumns(['termsandcondition'])->toJson();
        }
        return view('admin.resource.index', [
            'name' => 'admin.termsandcondition',
            'heading' => self::$heading,
            'skipPermission'=>false,
            'columns' => [
                Column::make('id'),
                Column::make('termsandcondition'),
                Column::make('status'),
            ],
            'statusMap' => CommonStatus::class,
        ]);
    }


    public function create() {
        return view('admin.resource.create', [
            'skipPermission'=>false,
            'name'   => 'admin.termsandcondition',
            'heading' => self::$heading,
            'fields' => [
                Field::textarea('termsandcondition')->required()->isEditor()->label('Terms and Condition'),
                Field::select('status')->options(CommonStatus::asSelectArray())->required()
            ],
            'statusMap' => CommonStatus::class,
        ]);
        }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'termsandcondition' => 'required|string',
            'status' => 'nullable',
        ]);
        $validated['created_by'] =auth()->user()->id; 
        return response()->report(Termsandcondition::create($validated));

    }


    public function show(Termsandcondition $termsandcondition)
    {
        return view('admin.resource.show', [
            'name'             => 'admin.termsandcondition',
            'skipPermission'=>false,
            'heading'          => [
                'index'  => 'Brands',
                'show'   => 'Show termsandcondition',
            ],
            'model'            => $termsandcondition,
            'columns'          => ['termsandcondition','status'],
        ]);
    }

    public function edit(Termsandcondition $termsandcondition)
    {
        return view('admin.resource.edit', [
            'model'            => $termsandcondition,
            'skipPermission'=>false,
            'name'             => 'admin.termsandcondition',
            'heading'          => [
                'index'  => 'Termsandcondition',
                'edit'   => 'Edit termsandcondition',
            ],
            'fields' => [
                Field::textarea('termsandcondition')->required()->isEditor()->label('Terms and Condition'),
                Field::select('status')->options(CommonStatus::asSelectArray())->required()
            ],
            'statusMap' => CommonStatus::class,
        ]);
    }

    public function update(Request $request, Termsandcondition $termsandcondition)
    {
        $validated = $request->validate([
            'termsandcondition' => 'required|string',
            'status' => 'nullable',
        ]);
        return response()->report($termsandcondition->update($validated), 'Termsandcondition updated successfully');
    }

    public function destroy(Termsandcondition $termsandcondition)
    {
        try{
            $termsandcondition->delete();
            return response()->success('Termsandcondition deleted successfully');
        }catch(\Exception $ex){
            return response()->error('Something went wrong');
        }
    }
}
