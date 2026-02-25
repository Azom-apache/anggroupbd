<?php

namespace App\Http\Controllers\Admin;

use App\Models\Video;
use App\Enum\CommonStatus;
use App\Lib\Resource\Field;
use App\Lib\Resource\Image;
use App\Lib\Resource\Column;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class VideoController extends Controller
{
    static protected $heading = [
        'index' => 'Video',
        'create' => 'Create Video',
        'show' => 'Video Details',
        'edit' => 'Edit Video',
    ];
    public function index(Request $request)
    {
        
        if ($request->ajax()) {
            return datatables(Video::query())->toJson();
        }
        return view('admin.resource.index', [
            'name' => 'admin.video',
            'heading' => self::$heading,
            'skipPermission'=>false,
            'columns' => [
                Column::make('id'),
                Column::make('title'),
                Column::make('video'),
                Column::make('status'),
            ],
            'statusMap' => CommonStatus::class,
        ]);
    }


    public function create() {
        return view('admin.resource.create', [
            'skipPermission'=>false,
            'name'   => 'admin.video',
            'heading' => self::$heading,
            'fields' => [
                Field::text('title')->label('Title'),
                Field::text('video')->required(),
                Field::select('status')->options(CommonStatus::asSelectArray())->required()
            ],
            'statusMap' => CommonStatus::class,
        ]);
        }


        public function store(Request $request) {
            $validated = $request->validate([
                'title'  => 'nullable',
                'video'  => 'nullable',
                'status'  => 'required',
            ]);
         
            preg_match('/(?:youtu\.be\/|youtube\.com(?:\/embed\/|\/v\/|\/watch\?v=|\/user\/\S+|\/ytscreeningroom\?v=|\/sandalsResorts#\w\/\w\/.*\/))([^\/&]{10,12})/', $request->video, $matches);
    
            // Check if the matched video ID is valid
            if (!empty($matches[1])) {
                // Assign the extracted video ID to $validated['video']
                $validated['video'] = $matches[1];
            }
    
            // Check if $validated['video'] starts with 'https://'
            if (strpos($validated['video'], 'https://') === 0) {
                // If it starts with 'https://', keep the original URL
                $validated['video'] = $request->video;
            }
    
            DB::transaction(function () use ($validated) {
                return tap(Video::create($validated));
            });
           return redirect()->route('admin.video.index')->with('success', 'Data has been submit successfully!');      
            
            //return response()->reportTo('success','Create successfully',route('admin.video.index'));
        }


    public function show(Video $video)
    {
        return view('admin.resource.show', [
            'name'             => 'admin.video',
            'skipPermission'=>false,
            'heading'          => [
                'index'  => 'Video',
                'show'   => 'Show video',
            ],
            'model'            => $video,
            'columns'          => ['title','image','status'],
        ]);
    }

    public function edit(Video $video)
    {
        return view('admin.resource.edit', [
            'model'            => $video,
            'skipPermission'=>false,
            'name'             => 'admin.video',
            'heading'          => [
                'index'  => 'Videos',
                'edit'   => 'Edit video',
            ],
            'fields' => [
                Field::text('title')->required(),
                Field::text('video'),
                Field::select('status')->options(CommonStatus::asSelectArray())->required()
            ],
            'statusMap' => CommonStatus::class,
        ]);
    }

    public function update(Request $request, Video $video) {
        $validated = $request->validate([
            'title'  => 'nullable',
            'video'  => 'nullable',
            'status'  => 'required',
        ]);
       
        preg_match('/(?:youtu\.be\/|youtube\.com(?:\/embed\/|\/v\/|\/watch\?v=|\/user\/\S+|\/ytscreeningroom\?v=|\/sandalsResorts#\w\/\w\/.*\/))([^\/&]{10,12})/', $request->video,$matches);
        if (!empty($matches[1])) {
            // Assign the extracted video ID to $validated['video']
            $validated['video'] = $matches[1];
        }

        // Check if $validated['video'] starts with 'https://'
        if (strpos($validated['video'], 'https://') === 0) {
            // If it starts with 'https://', keep the original URL
            $validated['video'] = $request->video;
        }
        $video->update($validated);
        return redirect()->route('admin.video.index')->with('success', 'Data has been submit successfully!');      
        
       // return response()->report($video->update($validated), 'Video updated successfully');
    }

    public function destroy(Video $video)
    {
        try{
            $video->delete();
            return response()->success('Video deleted successfully');
        }catch(\Exception $ex){
            return response()->error('Something went wrong');
        }
    }
}
