@extends('layouts/admin')

@section('content')

<h2 class="mt-5">Modifica la tecnologia</h2>

<div class="container form-container py-5" style="height: calc(100vh - 350px)">
    <form action="{{route('admin.technologies.update', $technology)}}" method="POST">
    @csrf

    @method ('PUT')

    <div class="mb-2">
      <label for="name">Nome</label>
      <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" value="{{old('name') ?? $technology->name}}">
      @error('name')
      <div class="invalid-feedback">
        {{$message}}
      </div>
      @enderror
    </div>

    <div class="mb-2">
      <label for="color">Colore</label>
      <input type="color" class="color-control @error('color') is-invalid @enderror" id="color" name="color" value="{{old('color') ?? $technology->color}}"></input>
      @error('color')
      <div class="invalid-feedback">
        {{$message}}
      </div>
      @enderror
    </div>

    <button class="mt-3 btn btn-primary" type="submit">Salva</button>
    
    
    
    
  </form>
  <button class="mt-2 btn pull-left" onclick="history.back()" style="background-color:rgb(208, 208, 215)">Indietro</button>

</div>


@endsection
