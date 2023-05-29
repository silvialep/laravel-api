@extends('layouts/admin')

@section('content')

<div class="d-flex justify-content-between align-items-center mt-5">
    <div class="d-flex gap-4 align-items-center">
        <h2>I miei progetti</h2>
        <a href="{{route('admin.projects.create')}}" class="btn btn-success d-flex align-items-center"><i class="fa-solid fa-plus"></i></a>
    </div>
    <form class="m-3"  action="{{route('admin.search')}}" method="GET">
    @csrf
        <input type="text" name="title" id="title">
        <button type="submit">Cerca</button>
    </form>
</div>



<table class="mt-5 table table-hover" style="height: calc(100vh - 350px)">
  <thead>
    <th scope="col">Titolo</th>
    <th scope="col">Descrizione</th>
    <th scope="col">Contenuto</th>
    <th scope="col">Tipologia</th>
    <th scope="col">Tecnologie</th>
    <th scope="col">Slug</th>
    <th scope="col">Comandi</th>
  </thead>

  <tbody>

    @foreach($projects as $index => $project)
    <tr>
        <td style="color:deeppink; text-transform:uppercase; font-weight:bold">{{$project->title}}</td>
        <td>{{$project->description}}</td>
        <td>{{$project->content}}</td>
        <td>
            @if(empty($project->type->type_name))
            <span class="text-danger fst-italic">NN</span>
            @else
            <a href="{{route('admin.types.show', $project->type)}}">{{$project->type->type_name}}</a>
            @endif
        </td>
        <td>
            @if(count($project->technologies) > 0)
            <ul style="padding:0; list-style-type:none">
                @foreach($project->technologies as $item)
                <li>
                    <a href="{{route('admin.technologies.show', $item)}}" class="badge rounded-pill mx-1" style="background-color: {{$item->color}}; text-decoration:none; color:white;">{{$item->name}}</a>
                </li>
                @endforeach
            </ul>
            
            @else
            <span class="fst-italic text-danger px-3">NN</span>
            @endif
        </td>
        <td>{{$project->slug}}</td>
        <td>
            <a href="{{route('admin.projects.show', $project)}}"><i class="fa-solid fa-magnifying-glass"></i></a>
            <a class="text-success" href="{{route('admin.projects.edit', $project)}}"><i class="fa-solid fa-pen"></i></a>
            <a href="{{route('admin.projects.destroy', $project)}}" class="text-danger" data-bs-toggle="modal" data-bs-target="#deleteProjectModal_{{$project->id}}"><i class="fa-solid fa-trash"></i></a>
            <div class="modal fade" id="deleteProjectModal_{{$project->id}}" tabindex="-1" aria-labelledby="idLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="idLabel">Elimina il progetto</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    <div class="modal-body">
                        Sei sicuro di voler eliminare il progetto "{{$project->title}}"?
                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                            <form action="{{route('admin.projects.destroy', $project)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            
                            <button type="submit" class="btn btn-danger">Elimina il progetto</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div> 
        </td>
    </tr>
    @endforeach


  </tbody>
</table>
@endsection