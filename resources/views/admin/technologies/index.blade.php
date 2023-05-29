@extends('layouts/admin')

@section('content')

<div class="d-flex justify-content-between aling-items-center mt-5">
    <h2>Tutte le tecnologie</h2>
    <a href="{{route('admin.technologies.create')}}" class="btn btn-success d-flex align-items-center">Nuova tecnologia</a>
</div>



<table class="mt-5 table table-hover">
  <thead>
    <th scope="col">Nome</th>
    <th scope="col">Slug</th>
    <th scope="col">Colore</th>
    <th scope="col">Progetti</th>
    <th scope="col">Comandi</th>
  </thead>

  <tbody>

    @foreach($technologies as $technology)
    <tr>
        <td style="color:deeppink; text-transform:uppercase; font-weight:bold">{{$technology->name}}</td>
        <td>{{$technology->slug}}</td>
        <td><a href="{{route('admin.technologies.show', $technology)}}" class="badge rounded-pill" style="background-color: {{$technology->color}}; text-decoration:none; color: {{$technology->color}};">{{'test'}}</a></td>
        <td>
            @if(count($technology->projects) > 0)
              <ul style="padding:0; list-style-type:none">
                  @foreach($technology->projects as $item)
                  <li>
                  <a href="{{route('admin.projects.show', $item->slug)}}">{{$item->title}}</a>
                  </li>
                  @endforeach
              </ul>
            @else
            <span class="fst-italic text-danger px-3">NN</span>
            @endif
        </td>
        <td>
            <a href="{{route('admin.technologies.show', $technology)}}"><i class="fa-solid fa-magnifying-glass"></i></a>
            <a class="text-success" href="{{route('admin.technologies.edit', $technology)}}"><i class="fa-solid fa-pen"></i></a>
            <a href="{{route('admin.technologies.destroy', $technology)}}" class="text-danger" data-bs-toggle="modal" data-bs-target="#deleteTechnologyModal_{{$technology->id}}"><i class="fa-solid fa-trash"></i></a>
            <div class="modal fade" id="deleteTechnologyModal_{{$technology->id}}" tabindex="-1" aria-labelledby="idLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="idLabel">Elimina la tecnologia</h1>
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
        </td>
    </tr>
    @endforeach


  </tbody>
</table>
@endsection