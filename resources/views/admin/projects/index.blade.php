@extends('layouts.admin')

@section('content')
<h1>Projects</h1>
<a class="btn btn-primary my-3" href="{{route('admin.projects.create')}}">New Project</a>
<div class="table-responsive mt-4">
    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">TITLE</th>
                <th scope="col">SLUG</th>
                <th scope="col">IMAGE</th>
                <th scope="col">DESCRIPTION</th>
                <th scope="col">ACTIONS</th>

            </tr>
        </thead>
        <tbody>
            @forelse($projects as $project)
            <tr class="">
                <td scope="row">{{$project->id}}</td>
                <td>{{$project->title}}</td>
                <td>{{$project->slug}}</td>
                <td><img class="w-75" src="{{asset('storage/' . $project->cover_image)}}" alt=""></td>

                <td>{{$project->description}}</td>
                <td class="d-flex flex-column">
                    <a class="btn btn-primary btn-sm my-1" href="{{route('admin.projects.show', $project->slug)}}" role="button"><i class="fa fa-eye fa-sm fa-fw" aria-hidden="true"></i>
                    </a>
                    <a class="btn btn-secondary btn-sm my-1" href="{{route('admin.projects.edit', $project->slug)}}" role="button"><i class="fa fa-pencil fa-sm fa-fw" aria-hidden="true"></i>
                    </a>
                    <!-- Modal trigger button -->
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteProject-{{$project->slug}}"><i class="fa fa-trash fa-sm fa-fw" aria-hidden="true"></i>
                    </button>

                    <!-- Modal Body -->
                    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                    <div class="modal fade" id="deleteProject-{{$project->slug}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalProjectId-{{$project->slug}}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-dark" id="modalProjectId-{{$project->slug}}">Delete Project</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-dark">
                                    Do you really want to delete this element permanently?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <form action="{{route('admin.projects.destroy', $project->slug)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td>No Projects Available</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection