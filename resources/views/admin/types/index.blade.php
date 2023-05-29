@extends('layouts/admin')

@section('content')

<div class="d-flex justify-content-between aling-items-center mt-5">
    <h2>Tutte le tipologie</h2>
    <a href="{{route('admin.types.create')}}" class="btn btn-success d-flex align-items-center">Nuova tipologia</a>
</div>

<table class="table mt-3" style="height: calc(100vh - 350px)">
    <thead>
        <th scope="col">Nome</th>
        <th scope="col">Descrizione</th>
        <th scope="col">Progetti</th>
        <th scope="col">Comandi</th>
    </thead>
    <tbody>
        @foreach($types as $type)
        <tr>
            <td><a style="color:deeppink; text-transform:uppercase; text-decoration:none; font-weight:bold" href="{{route('admin.types.show', $type)}}">{{$type->type_name}}</a></td>
            <td>{{$type->description}}</td>
            @if(count($type->projects) > 0)
            <td>
                <ul style="padding:0">
                    @foreach($type->projects as $item)
                    <li>
                    <a href="{{route('admin.projects.show', $item->slug)}}">{{$item->title}}</a>
                    </li>
                    @endforeach

                </ul>
            </td>
            @else
            <td class="fst-italic text-danger px-3">NN</td>
            @endif
            <td>
                <a href="{{route('admin.types.show', $type->slug)}}"><i class="fa-solid fa-magnifying-glass"></i></a>
                <a class="text-success" href="{{route('admin.types.edit', $type->slug)}}"><i class="fa-solid fa-pen"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection