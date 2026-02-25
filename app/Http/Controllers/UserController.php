<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Lib\Resource\Field;
use Illuminate\Http\Request;
use App\Traits\ChecksPermission;

class UserController extends Controller
{ 
    use ChecksPermission;
    static protected $heading = [
        'index' => 'User',
        'create' => 'Create User',
        'show' => 'User Details',
        'edit' => 'Edit User',
    ];
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables(User::query())->toJson();
        }

        return view('user.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
    return view('resource.create', [
        'permissionPrefix' => 'user',
        'name'   => 'user',
        'heading' => self::$heading,
        'fields' => [
            
            Field::text('name')->required()->label('Name'),
           
        ],
    ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
