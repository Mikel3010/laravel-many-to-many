@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="fs-4 text-secondary my-4">
            Lista tipi di progetto
        </h2>
        <a href="{{ route('admin.types.create')}}" class="btn btn-primary">Crea Tipo</a>
    </div>
    @if(session('message'))
    <div class="alert alert-success">
        {{session('message')}}
    </div>
    @endif
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Titolo</th>
            <th scope="col">Slug</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($types as $type)
            <tr>
                <th scope="row">{{$type->id}}</th>
                <td>{{$type->title}}</td>
                <td>{{$type->slug}}</td>
                <td>
                    <ul class="list-unstyled d-flex m-0 gap-1 justify-content-end">
                        <li><a href="{{ route('admin.types.show', $type->slug)}}" class="btn btn-sm btn-primary">Show</a></li>
                        <li><a href="{{ route('admin.types.edit', $type->slug)}}" class="btn btn-sm btn-warning">Edit</a></li>
                        <li><a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#type-{{$type->id}}">Delete</a></li>
                    </ul>
                </td>
              </tr>
              <div class="modal fade" id="type-{{$type->id}}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Attenzione</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                       Vuoi cancellare il tipo di progetto con id <strong>{{$type->id}}</strong>? 
                    </div>
                    <div class="modal-footer">
                      
                      <form action="{{ route('admin.types.destroy', $type)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
        </tbody>
      </table>
</div>
@endsection
