@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fs-4 text-secondary my-4">
        {{$project->title}}
    </h2>
    <p>
        {{$project->description}}
    </p>
    @if ($project->type_id)
    <h3>Tipo: {{$project->type?->name}}</h3>
    @endif
    <div>
        <img src="{{ asset('storage/' .$project->image)}}" alt="{{$project->title}}">
    </div>
    <a href="{{ route('admin.projects.edit', $project->slug)}}" class="btn btn-sm btn-warning">Edit</a>

 
</div>
@endsection
