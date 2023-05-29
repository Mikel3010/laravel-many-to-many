@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modifica Progetto: {{$project->title}}</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error}}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.projects.update', $project)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label for="title" class="form-label">Titolo</label>
          <input type="text" class="form-control" id="title" name="title" value="{{old('title'),$project->title}}">
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Descrizione</label>
          <textarea class="form-control" id="description" name="description">{{old('description',$project->description)}}</textarea>
        </div>
        <div class="mb-3">

            <div class="preview">
                <img id="file-image-preview" @if($project->image) src="{{ asset('storage/' . $project->image)}}" @endif>
            </div>

            <label for="image" class="form-label">Image</label>
            <input class="form-control" type="file" id="image" name="image">
          </div>
        <button type="submit" class="btn btn-primary">Edit</button>
    </form>
</div>
@endsection