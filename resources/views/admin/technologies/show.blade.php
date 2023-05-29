@extends('layouts/admin')

@section('content')

<div class="main pt-5" style="height: calc(100vh - 350px)">
  <div class="d-flex justify-content-between align-items-center">
    <h1>{{$technology->name}}</h1>
    <div>
      <small>Colore: </small><small class="badge rounded-pill" style="background-color: {{$technology->color}}; text-decoration:none; color: {{$technology->color}};">{{'t'}}</small>
    </div>
  </div>
  <hr>

  @if(count($technology->projects) > 0)
  <table class="table mb-4">
    <thead>
      <th>Titolo</th>
      <th>Slug</th>
    </thead>

    <tbody>
      @foreach($technology->projects as $project)
        <tr>
          <td>{{$project->title}}</td>
          <td>{{$project->slug}}</td>
          <td><a href="{{route('admin.projects.show', $project)}}"><i class="fa-solid fa-magnifying-glass"></i></a></td>
        </tr>
      @endforeach

    </tbody>
  </table>
  @else

    <span class="fst-italic text-warning">Nessun progetto di questa categoria</span>
      
  @endif
  
</div>
<div class="container mt-5 d-flex gap-3 justify-content-center align-items-center">
  <a href="{{route('admin.projects.index')}}" class="btn btn-primary d-flex align-items-center">Torna ai progetti</a>
  <a href="{{route('admin.types.index')}}" class="btn btn-info d-flex align-items-center">Torna alle tipologie</a>
  <a href="{{route('admin.technologies.index')}}" class="btn btn-secondary d-flex align-items-center">Torna alle tecnologie</a>
  <a href="{{route('admin.technologies.edit', $technology)}}" class="btn btn-warning d-flex align-items-center">Modifica</a>
  <a href="{{route('admin.technologies.destroy', $technology)}}" class="btn btn-danger d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#exampleModal">Elimina</a>
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Elimina la tecnologia</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
          <div class="modal-body">
              Sei sicuro di voler eliminare la tecnologia "{{$technology->name}}"?
          </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                  <form action="{{route('admin.technologies.destroy', $technology)}}" method="POST">
                  @csrf
                  @method('DELETE')
                  
                  <button type="submit" class="btn btn-danger">Elimina la tecnologia</button>
                  </form>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection