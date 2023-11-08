@extends('layouts.admin')

@section('content')


<section class=" my-4">
        @if(session('message'))

        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>{{session('message')}}</strong> 
        </div>

        @endif

        <div class="d-flex justify-content-between mb-3">
            <h4 class="text-muted text-uppercase">All Projects</h4>
            <a href="{{route('projects.create')}}" class="btn btn-primary">Create Project</a>
        </div>

        <div class="card">

            <div class="table-responsive-sm">
                <table class="table table-light mb-0">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Image</th>
                            <th scope="col">Title</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>


                        @forelse ($projects as $project)
                        <tr class="">
                            <td scope="row">{{$project->id}}</td>
                            <td>
                                
                                @if (str_contains($project->cover_image, 'http'))
                                    <img width="100" class=" img-fluid" src="{{ $project->cover_image }}">
                                @else
                                    <img width="100" class=" img-fluid" src="{{asset('storage/' . $project->cover_image)}}" alt="">
                                @endif

                            </td>
                            <td class="w-75">{{$project->title}}</td>
                            <td>

                                <a href="{{route('projects.show', $project->id)}}" class="btn btn-primary">View</a>
                                <a href="{{route('projects.edit', $project->id)}}" class="btn btn-secondary">Edit</a>
                                
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalId-{{$project->id}}">
                                    Delete
                                </button>

                                <!-- Modal Body -->
                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                <div class="modal fade" id="modalId-{{$project->id}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitle-{{$project->id}}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalTitle-{{$project->id}}">Identificativo prodotto: {{$project->id}}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Attenzione! Se procedi eliminando il prodotto non potrai più tornare indietro, confermi?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                                <!-- Delete form -->
                                                <form action="{{route('projects.destroy', $project->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Confirm</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>
                        @empty

                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</section>


@endsection