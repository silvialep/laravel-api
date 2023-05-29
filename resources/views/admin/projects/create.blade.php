@extends('layouts/admin')

@section('content')

<h2 class="mt-5">Aggiungi un nuovo progetto</h2>

<div class="container form-container py-5" style="height: calc(100vh - 100px)">
    <form action="{{route('admin.projects.store')}}" method="POST" enctype="multipart/form-data">
    @csrf


    <div class="mb-2">
      <label for="title">Titolo</label>
      <input class="form-control @error('title') is-invalid @enderror" type="text" id="title" name="title" value="{{old('title')}}">
      @error('title')
      <div class="invalid-feedback">
        {{$message}}
      </div>
      @enderror
    </div>

    <div class="mb-2">
      <label for="type_id">Tipologia</label>
      <select class="form-select @error('type_id') is-invalid @enderror" id="type_id" name="type_id">
        <option value="">Nessuna</option>
        @foreach ($types as $type)
            <option value="{{$type->id}}" {{$type->id == old('type_id') ? 'selected' : ''}}>{{$type->type_name}}</option>
        @endforeach
      </select>
      @error('type_id')
      <div class="invalid-feedback">
        {{$message}}
      </div>
      @enderror
    </div>

    <div class="my-4 form-group d-flex flex-row" style="position:relative">
      <label for="technology">Tecnologie</label>

      <div class="form-check">
        @foreach($technologies as $technology)
        <input type="checkbox" id="technology-{{$technology->id}}" name="technologies[]" value="{{$technology->id}}" @checked(in_array($technology->id, old('technologies', [])))>
        <label for="technology-{{$technology->id}}">{{$technology->name}}</label>
        @endforeach
      </div>
      @error('technologies') 
      <div class="text-danger" style="position:absolute; bottom:-20px; font-size:0.9rem">
        {{$message}}
      </div>
      @enderror

    </div>

    <div class="mb-4">
      <label for="content">Contenuto</label>
      <input class="form-control @error('content') is-invalid @enderror" type="text" id="content" name="content" value="{{old('content')}}">
      @error('content')
      <div class="invalid-feedback">
        {{$message}}
      </div>
      @enderror
    </div>

    <div class="mb-2">
      <label for="description">Descrizione</label>
      <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{old('description')}}</textarea>
      @error('description')
      <div class="invalid-feedback">
        {{$message}}
      </div>
      @enderror
    </div>

    <div class="mb-2">
      <label for="project_cover">Immagine</label>
      <input type="file" id="project_cover" name="project_cover" class="form-control @error('project_cover') is-invalid @enderror">
      @error('project_cover')
        <div class="invalid-feedback">
          {{$message}}
        </div>    
      @enderror
    </div>

    
    <button class="btn btn-primary mt-3" type="submit">Salva</button>
    <input class="btn btn-warning mt-3" type="reset" value="Reset">
    
    
    
    
  </form>
  <button class="mt-2 btn pull-left" onclick="history.back()" style="background-color:rgb(208, 208, 215)">Indietro</button>

</div>


@endsection
