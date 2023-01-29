@extends('layouts.admin')

@section('content')
    <h1>{{ $project->title }}</h1>
    <h6>Slug: {{ $project->slug }}</h6>
    <hr>
    <img class="w-25" src="{{ asset('storage/' . $project->cover_image) }}" alt="">

    <div class="types">
        <strong>Type:</strong>
        {{ $project->type ? $project->type->name : 'Uncategorized' }}
    </div>
    <div class="technologies">
        <strong>Technologies:</strong>
        @if (count($project->technologies) > 0)
            @foreach ($project->technologies as $technology)
                <span>{{ $technology->name }}</span>
            @endforeach
        @else
            <span>Not technologies associated to the current project</span>
        @endif
    </div>
    <p>Description: {{ $project->description }}</p>
@endsection
