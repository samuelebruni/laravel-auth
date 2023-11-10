<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::paginate(4);

        return view('admin.projects.home',compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
         //$data = $request->all();
         $validate_data = $request->validated();
         $validate_data['slug'] = Str::slug($request->title, '-');

         if ($request->has('cover_image')) {
             $file_path = Storage::put('projects_thumbs', $request->cover_image);
             //$data['cover_image'] = $file_path;
             $validate_data['cover_image'] = $file_path;
         }
 
         $project = Project::create($validate_data);
 
         return to_route('projects.show', $project);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show',compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit',compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        
        $validate_data = $request->validated();

        if ($request->has('cover_image') && $project->cover_image) {

            Storage::delete($project->cover_image);

            $newImageFile = $request->cover_image;
            $path = Storage::put('projects_thumbs', $newImageFile);
            //$data['cover_image'] = $path;
            $validate_data['cover_image'] = $path;
        }

        if (!Str::is($project->getOriginal('title'), $request->title)) {

            $validate_data['slug'] = $project->generateSlug($request->title);
        }

        $project->update($validate_data);
        return to_route('admin.projects.show',$project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if (!is_null($project->cover_image)) {
            Storage::delete($project->cover_image);
        }
        $project->delete();
        return to_route('admin.projects.index')->with('message', 'Il progetto è stato eliminato correttamente ✅');
    }
}
