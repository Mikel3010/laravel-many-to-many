@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crea Progetti</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error}}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.projects.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="title" class="form-label">Titolo</label>
          <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Descrizione</label>
          <textarea class="form-control" id="description" name="description">{{old('description')}}</textarea>
        </div>
        <div class="mb-3">

            <div class="preview">
                <img id="file-image-preview">
            </div>

            <label for="image" class="form-label">Image</label>
            <input class="form-control" type="file" id="image" name="image">
          </div>
          <div class="mb-3">
            <label for="type_id" class="form-label">Tipo</label>
            <select class="form-select" name="type_id" id="type_id">
                <option value="">Select Tipo Progetto</option>
                @foreach ($types as $type)
                <option value="{{$type->id}}" {{old('type_id') == $type->id ? 'selected' : ''}}>{{$type->name}}</option>
                @endforeach
              </select>
          </div>
          <div class="mb-3">
            <div>Tecnologie</div>
            @foreach ($technologies as $technology)
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" id="technologies" value="{{ $technology->id}}" name="technologies[]" {{ in_array($technology-id , old('technologies', [])) ? 'checked' : ''}}>
              <label class="form-check-label" for="technologies">{{$technology->name}}</label>
            </div>    
            @endforeach
          </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
