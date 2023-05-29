@extends('layouts/admin')

@section('content')
  <div class="mt-5 d-flex justify-content-between align-items-center gap-2">
    <h1>Pagina di amministrazione</h1>
    {{-- <div>
      <div class="mx-auto pull-right">
        <div>
          <form action="{{ route('searchProjects') }}" method="GET" role="search">

            <div class="input-group d-flex justify-content-between align-items-center gap-2">
              <input type="search" class="form-control mr-2" name="search" placeholder="Cerca tra i progetti" id="search" value="">
              <span>
                <button class="btn btn-info" type="submit" title="Search projects">
                  <span class="fas fa-search"></span>
                </button>
              </span>
            </div>
          </form>
        </div>
      </div>
    </div> --}}
  </div>

  <hr>

  <div style="height: calc(100vh - 350px)">
    <div class="my-5 d-flex gap-2 justify-content-between">
      <a href="{{route('admin.projects.index')}}" class="btn btn-primary d-flex align-items-center">Mostra tutti i progetti</a>
      <a href="{{route('admin.types.index')}}" class="btn btn-info d-flex align-items-center">Mostra tutte le tipologie</a>
      <a href="{{route('admin.technologies.index')}}" class="btn btn-secondary d-flex align-items-center">Mostra tutte le tecnologie</a>
    </div>
    
  </div>
@endsection


