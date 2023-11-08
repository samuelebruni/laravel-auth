@extends('layouts.admin')

@section('content')

<div class="p-5 my-4 rounded-0 bg-dark text-white">
    <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">{{$project->title}}</h1>
        <p>
            {{$project->description}}
        </p>
    </div>
</div>

<div class="container d-flex gap-2">

    <div>
        @if (str_contains($project->cover_image, 'http'))
            <img width="250" class=" img-fluid" src="{{ $project->cover_image }}">
        @else
            <img width="250" class=" img-fluid" src="{{asset('storage/' . $project->cover_image)}}" alt="">
        @endif
    </div>
</div>

@endsection