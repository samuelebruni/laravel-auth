@extends('layouts.admin')


@section('content')

<div class="container">

    <h1 class="py-4">Edit Project number: {{$project->id}}</h1>
    <h4 class="py-4">Edit Project title: {{$project->title}}</h4>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li> {{$error}} </li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{route('projects.update', $project)}}" method="POST" enctype="multipart/form-data">

        <!-- // Attention to Cross site request forgery attacks -->
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" id="title" aria-describedby="helpId" placeholder="Acolyte Eco Battle staff" value="{{$project->title}}">
            <small id="titleHelper" class="form-text text-muted">Type the title here</small>
            @error('title')
                <div class="text-danger"> {{$message}} </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">description</label>
            <input type="text" step="0.01" class="form-control" name="description" id="description" aria-describedby="helpId" placeholder="edit your description" value="{{$project->description}}">
            <small id="descriptionHelper" class="form-text text-muted">Type the description here</small>
            @error('description')
                <div class="text-danger"> {{$message}} </div>
            @enderror

        </div>

        <div class="d-flex gap-3">
            <div>
                @if (str_contains($project->thumb, 'http'))
                    <img width="250" class=" img-fluid" src="{{ $project->thumb }}">
                @else
                    <img width="250" class=" img-fluid" src="{{asset('storage/' . $project->thumb)}}" alt="">
                @endif
            </div>
            <div class="mb-3">
                <label for="thumb" class="form-label">Update Cover Image</label>
                <input type="file" class="form-control" name="thumb" id="thumb" placeholder="" aria-describedby="thumb_helper">
                <div id="thumb_helper" class="form-text">Upload an image for the current product</div>
            </div>
        </div>


        <button type="submit" class="btn btn-primary mt-3">
            Update
        </button>


    </form>

</div>


@endsection