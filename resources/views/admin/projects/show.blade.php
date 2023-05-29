@extends('layouts/admin')

@section('content')

<div class="main pt-5" style="height: calc(100vh - 150px)">
  <div class="d-flex justify-content-between align-items-center">
    <h1>{{$project->title}}</h1>
    @if(empty($project->type->type_name))
    <span class="text-danger fst-italic">Nessuna categoria</span>
    @else
    <a href="{{route('admin.types.index')}}">{{$project->type->type_name}}</a>
    @endif
    
    {{-- <span class="text-danger fst-italic">{{$project->type->type_name ?? 'Nessuna categoria'}}</span> --}}
  </div>
  <hr>
  <div style="width:300px; height:300px;">
    <img style="width:300px" src="{{asset('storage/' . $project->project_cover)}}" alt="immagine progetto">
  </div>
  <div class="d-flex justify-content-between">
    <div>
      <strong>{{$project->description}}</strong>
      <p>
        {{$project->content}}
      </p>
    </div>
    <div>
      <div class="d-flex py-3">
        @foreach($project->technologies as $technology)
        <span class="badge rounded-pill mx-1" style="background-color: {{$technology->color}}">{{$technology->name}}</span>
        @endforeach
      </div>
    </div>
  </div>
</div>
<div class="container d-flex gap-3 justify-content-center align-items-center">
  <a href="{{route('admin.projects.index')}}" class="btn btn-primary d-flex align-items-center">Torna ai progetti</a>
  <a href="{{route('admin.types.index')}}" class="btn btn-info d-flex align-items-center">Torna alle tipologie</a>
  <a href="{{route('admin.technologies.index')}}" class="btn btn-secondary d-flex align-items-center">Torna alle tecnologie</a>
  <a href="{{route('admin.projects.edit', $project)}}" class="btn btn-warning d-flex align-items-center">Modifica</a>
  <a href="{{route('admin.projects.destroy', $project)}}" class="btn btn-danger d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#exampleModal">Elimina</a>
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Elimina il progetto</h1>
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
</div>
@endsection