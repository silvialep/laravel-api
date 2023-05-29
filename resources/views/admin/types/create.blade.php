@extends('layouts/admin')

@section('content')

<h2 class="mt-5">Aggiungi una nuova tipologia</h2>

<div class="container form-container py-5" style="height: calc(100vh - 350px)">
    <form action="{{route('admin.types.store')}}" method="POST">
    @csrf


    <div class="mb-2">
      <label for="type_name">Nome</label>
      <input class="form-control @error('type_name') is-invalid @enderror" type="text" id="type_name" name="type_name" value="{{old('type_name')}}">
      @error('type_name')
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

    <button class="mt-3 btn btn-primary" type="submit">Salva</button>
    
    
    
    
  </form>
  <button class="mt-2 btn pull-left" onclick="history.back()" style="background-color:rgb(208, 208, 215)">Indietro</button>

</div>


@endsection
