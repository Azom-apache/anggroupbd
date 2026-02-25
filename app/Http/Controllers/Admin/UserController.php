<?php

namespace App\Http\Controllers\Admin;

use App\Lib\Image;
use App\Models\User;
use App\Lib\Resource\Field;
use App\Lib\Resource\Column;
use Illuminate\Http\Request;
use App\Traits\ChecksPermission;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\Exceptions\Exception;

class UserController extends Controller
{
    use ChecksPermission;
    static protected $heading = [
        'index' => 'Member',
        'create' => 'Create Member',
        'show' => 'Member Details',
        'edit' => 'Edit Member',
    ];
    public function index(Request $request)
    {
        
        if ($request->ajax()) {
            return datatables(User::query())->toJson();
        }
        return view('admin.user.index', [
            'name' => 'user',
            'heading' => self::$heading,
            'routePrefix' => 'admin.user',
            'skipPermission' => true,
            'columns' => [
                Column::make('id'),
                Column::make('email'),
                Column::make('name'),
                Column::make('created_at'),
            ]
        ]);
    }


    public function create() {
        return view('admin.resource.create', [
            'routePrefix' => 'admin.user.index',
            'name'   => 'admin.user',
            'heading' => self::$heading,
            'fields' => [
                
                Field::text('name')->required()->label('Name'),
                Field::text('designation')->required()->label('Designation'),
                Field::email('email')->required()->label('Email'),
                Field::number('phone')->required()->label('Phone'),
                Field::file('avatar')->required()->label('Image'),
               
            ],
        ]);
        }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'nullable',
            'avatar' => 'nullable|image|max:2048',
            'phone' => 'nullable',
            'designation' => 'nullable',
        ]);
        $validated['password'] = Hash::make('12345678');
        if (!empty($validated['avatar'])) {
            $validated['avatar'] = Image::store('avatar', 'upload/product');
        }
        return response()->report(User::create($validated));

    }


    public function show(User $user)
    {
        //
    }

    public function portal(User $user)
    {
//        abort_if(!Auth::user()->isA('admin'), 403);
        $cid = uniqid();
        Cache::put($cid, $user->id, 60);
        $url = URL::temporarySignedRoute(
            'portal', now()->addMinute(), ['user' => $user->id, 'cid' => $cid]
        );

        return <<<HTML
<body style="padding: 2rem;">
Open <a href="$url" target="_blank">$url</a> in incognito window.
<script type="text/javascript">
window.onblur = function() { window.close(); }
</script>
</body>
HTML;
    }


    public function edit(User $user)
    {
        //
    }


    public function update(Request $request, User $user)
    {
        //
    }


    public function destroy(User $user)
    {
        try{
            $user->delete();
            return response()->success('user deleted successfully');
        }catch(\Exception $ex){
            return response()->error('Something went wrong');
        }
    }
}
