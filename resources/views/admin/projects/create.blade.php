@extends('layouts.admin')

@section('content')
    <h1>Create New Project</h1>
    @include('partials.error')
    <form action="{{ route('admin.projects.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" placeholder=""
                aria-describedby="titleHelper">
            <small id="titleHelper" class="text-muted">Add title with max 100 characters</small>
        </div>
        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label for="cover_image" class="form-label">Image</label>
            <input multiple type="file" name="cover_image" id="cover_image"
                class="form-control @error('cover_image') is-invalid @enderror" placeholder=""
                aria-describedby="cover_imageHelper">
            <small id="cover_imageHelper" class="text-muted">Add an image</small>
        </div>
        @error('cover_image')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="mb-3">
            <label for="type_id" class="form-label">Types</label>
            <select class="form-select form-select-sm @error('type_id') 'is-invalid' @enderror" name="type_id"
                id="type_id">
                <option selected disabled>Select Type</option>

                @foreach ($types as $type)
                    <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>
                        {{ $type->name }}</option>
                @endforeach

            </select>
        </div>
        @error('types')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="mb-3">
            <label for="technologies" class="form-label">Technologies</label>
            <select multiple class="form-select form-select-sm" name="technologies[]" id="technologies">
                <option value="" disabled>Select a Technology</option>

                @forelse ($technologies as $technology)
                    @if ($errors->any())
                        <option value="{{ $technology->id }}"
                            {{ in_array($technology->id, old('technologies', [])) ? 'selected' : '' }}>
                            {{ $technology->name }}
                        </option>
                    @else
                        <option value="{{ $technology->id }}">{{ $technology->name }}</option>
                    @endif
                @empty
                    <option value="" disabled>No Technologies available</option>
                @endforelse
            </select>
            @error('technologies')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea type="text" name="description" id="description" class="form-control" placeholder=""
                aria-describedby="descriptionHelper"></textarea>
            <small id="descriptionHelper" class="text-muted">Add a description with max 300 characters</small>
        </div>
        @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn btn-primary">Add</button>
    </form>
@endsection
