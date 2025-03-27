@extends('admin.layout')

@section('content')
<x-app-layout>
    <main id="main" class="main">
<div class="container">
    <h2>Edit Blog Post</h2>
    
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" name="content" rows="4" required>{{ $post->content }}</textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image">
            @if($post->image_path)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . str_replace('public/', '', $post->image_path)) }}" width="150">
                </div>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Update Post</button>
    </form>
</div>
    </main>
</x-app-layout>
@endsection
