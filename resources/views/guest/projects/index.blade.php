@extends('layouts.app')

@section('content')
<div class="container">
    <div >
        <h2 class="fs-4 text-secondary my-4">
            Lista Progetti
        </h2>
    </div>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Titolo</th>
            <th scope="col">Slug</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
            <tr>
                <th scope="row">{{$project->id}}</th>
                <td>{{$project->title}}</td>
                <td>{{$project->slug}}</td>
              </tr>
            @endforeach
        </tbody>
      </table>
</div>
@endsection