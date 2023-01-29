@extends('layouts.admin')

@section('content')
    <h1>Edit Project</h1>
    @include('partials.error')
    <form action="{{ route('admin.projects.update', $project->slug) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                placeholder="" aria-describedby="titleHelper" value="{{ old('title', $project->title) }}">
            <small id="titleHelper" class="text-muted">Add title with max 100 characters</small>
        </div>
        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="mb-3">
            <img class="w-25" src="{{ asset('storage/' . $project->cover_image) }}" alt="">
            <div>
                <label for="cover_image" class="form-label">Image</label>
                <input type="file" name="cover_image" id="cover_image"
                    class="form-control @error('cover_image') is-invalid @enderror" placeholder=""
                    aria-describedby="cover_imageHelper">
                <small id="cover_imageHelper" class="text-muted">Replace image</small>
            </div>
        </div>
        @error('cover_image')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label for="type_id" class="form-label">Types</label>
            <select class="form-select form-select-sm @error('type_id') 'is-invalid' @enderror" name="type_id"
                id="type_id">
                <option value="" disabled>Select Type</option>

                @forelse ($types as $type)
                    <option value="{{ $type->id }}"
                        {{ $type->id == old('type_id', $project->type ? $project->type->id : '') ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @empty
                    <option value="">Sorry, no types in the system.</option>
                @endforelse
            </select>
        </div>
        @error('type_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="mb-3">
            <label for="technologies" class="form-label">Technologies</label>
            <select multiple class="form-select form-select-sm" name="technologies[]" id="technologies">
                <option value="" disabled>Select technologies</option>

                @forelse ($technologies as $technology)
                    @if ($errors->any())
                        <option value="{{ $technology->id }}"
                            {{ in_array($technology->id, old('technologies', [])) ? 'selected' : '' }}>
                            {{ $technology->name }}
                        </option>
                    @else
                        <option value="{{ $technology->id }}"
                            {{ $project->technologies->contains($technology->id) ? 'selected' : '' }}>
                            {{ $technology->name }}
                        </option>
                    @endif
                @empty
                    <option value="" disabled>Sorry, no technologies in the system.</option>
                @endforelse
            </select>
        </div>
        @error('technologies')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea type="text" name="description" id="description"
                class="form-control @error('description') is-invalid @enderror" placeholder="" aria-describedby="descriptionHelper">{{ old('description', $project->description) }}</textarea>
            <small id="descriptionHelper" class="text-muted">Add a description with max 300 characters</small>
        </div>
        @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-primary">Edit</button>
    </form>
@endsection
