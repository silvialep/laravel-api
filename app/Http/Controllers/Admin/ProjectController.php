<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
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
        $technologies = Technology::all();
        return view('admin.projects.index', compact('projects', 'technologies'));
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

        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formData = $request->all();

        $this->validateForm($formData);

        $project = new Project();

        if($request->hasFile('project_cover')) {
            $path = Storage::put('project_images', $request->project_cover);
            $formData['project_cover'] = $path;
        }

        $project->fill($formData);
        
        $project->slug = Str::slug($project->title, '-');

        $project->save();
        
        if (array_key_exists('technologies', $formData)) {
            $project->technologies()->attach($formData['technologies']);
        }
        
        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin/projects/show', compact('project'));
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
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $formData = $request->all();

        $this->validateForm($formData);

        if($request->hasFile('project_cover')) {
            if($project->project_cover) {
                Storage::delete($project->project_cover);
            }

            $path = Storage::put('project_images', $request->project_cover);
            $formData['project_cover'] = $path;
        }

        $project->slug = Str::slug($formData['title'], '-');

        $project->update($formData);

        if (array_key_exists('technologies', $formData)) {
            $project->technologies()->sync($formData['technologies']);
        } else {
            $project->technologies()->detach();
        }

        return redirect()->route('admin.projects.show', compact('project'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if($project->project_cover) {
            Storage::delete($project->project_cover);
        }
        $project->delete();
        return redirect()->route('admin.projects.index');
    }

    private function validateForm($formData)
    {
        $validator = Validator::make($formData, 
            [
                'title' => 'required',
                'type_id' => 'nullable|exists:types,id',
                'description' => 'required',
                'content' => 'required',
                'technologies' => 'required',
                'project_cover' => 'nullable|image|max:4096',
            ],
            [
                'title.required' => 'Il campo del titolo è richiesto',
                'type_id.exists' => 'La tipologia deve essere una esistente',
                'description.required' => 'Il campo della descrizione è richiesto',
                'content.required' => 'Il contenuto è richiesto',
                'technologies.required' => 'Almeno una tecnologia è richiesta',
                'project_cover.image' => 'Il file caricato deve essere di tipo :image',
                'project_cover.max' => 'La dimensione del file non deve superare i 4 MB'

            ]
        )->validate();
        return $validator;

    }

    
    
}
