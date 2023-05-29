@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fs-4 text-secondary my-4">
        {{$project->title}}
    </h2>
    <p>
        {{$project->description}}
    </p>
 
</div>
@endsection