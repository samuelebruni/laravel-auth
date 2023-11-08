@extends('layouts.admin')

@section('content')

<div class="container mt-5">

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li> {{$error}} </li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route('projects.store')}}" method="POST" enctype="multipart/form-data">

        <!-- // Attention to Cross site request forgery attacks -->
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input value="{{old('title')}}" type="text" class="form-control" name="title" id="title" aria-describedby="helpId" placeholder="Batman">
            <small id="titleHelper" class="form-text text-muted">Type the title here</small>
            @error('title')
                <div class="text-danger"> {{$message}} </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">description</label>
            <input value="{{old('description')}}" type="text" class="form-control" name="description" id="description" aria-describedby="helpId" placeholder="My project..">
            <small id="descriptionHelper" class="form-text text-muted">Type the description here</small>
            @error('description')
                <div class="text-danger"> {{$message}} </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="thumb" class="form-label">Choose file</label>
            <input type="file" class="form-control" name="thumb" id="thumb" placeholder="" aria-describedby="thumb_helper">
            <div id="thumb_helper" class="form-text">Upload an image for the current product</div>
        </div>


        <button type="submit" class="btn btn-primary">
            Save
        </button>


    </form>

</div>


@endsection