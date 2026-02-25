<?php

namespace App\Http\Controllers\Admin;

use App\Lib\Resource\Column;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         if ($request->ajax()) {
            return datatables(Contact::query())->toJson();
        }
        return view('admin.resource.index', [
            'name' => 'admin.contact',
          
            'skipPermission'=>false,
            'columns' => [
                Column::make('id'),
                Column::make('the_name'),
                Column::make('the_email'),
                Column::make('the_message'),
               
            ],
        
        ]);
    

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
         if ($request->ajax()) {
            return datatables(Contact::query())->toJson();
        }
        return view('admin.resource.index', [
            'name' => 'admin.contact',
          
            'skipPermission'=>false,
            'columns' => [
                Column::make('id'),
                Column::make('the_name'),
                Column::make('the_email'),
                Column::make('the_message'),
               
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
      
      
        return view('admin.resource.index', [
            'name' => 'admin.contact',
          
            'skipPermission'=>false,
            'columns' => [
                Column::make('id'),
                Column::make('the_name'),
                Column::make('the_email'),
                Column::make('the_message'),
               
            ],
        
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       
       
        return view('admin.resource.index', [
            'name' => 'admin.contact',
          
            'skipPermission'=>false,
            'columns' => [
                Column::make('id'),
                Column::make('the_name'),
                Column::make('the_email'),
                Column::make('the_message'),
               
            ],
        
        ]);
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
    public function destroy(Contact $contact)
    {
        try{
            $contact->delete();
            return response()->success('contact deleted successfully');
        }catch(\Exception $ex){
            return response()->error('Something went wrong');
        }
    }
}
