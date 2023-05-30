<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.create',compact('types','technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
       
        $data = $request->validated();
        $project = new Project();
        $project->fill($data);

        $project->slug = Str::slug($data['title'],'-');
        if(isset($data['image'])){
            $project->image = Storage::put('uploads', $data['image']);
        }

        $project->save();

        if (isset($data['technologies'])){
            $project->technologies()->sync($data['technologies']);
        }
        
        return redirect()->route('admin.projects.index')->with('message', "Progetto $project->id creato");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project','technologies','types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $data = $request->validated();
        $project->slug = Str::slug($data['title'],'-');

        if(isset($data['image'])){
            if($project->image){
                Storage::delete($project->image);
            }   
            $project->image = Storage::put('uploads', $data['image']);
        }

        if (isset($data['technologies'])){
            $project->technologies()->sync($data['technologies']);
        } else{
            $project->technologies()->detach();
        }

        $project->update($data);
        $project->save();

        return redirect()->route('admin.projects.index')->with('message', "Progetto $project->id modificato");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $old_id = $project->id;
        $project->delete();
        return redirect()->route('admin.projects.index')->with('message', "Progetto $old_id cancellato");
    }
}
