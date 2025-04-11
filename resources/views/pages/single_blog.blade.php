@extends('frontend.master')

@section('content')
<div class="container py-5">
    <div class="card shadow p-4">
        @if ($post->image_path)
            <img src="{{ asset('storage/' . str_replace('public/', '', $post->image_path)) }}" class="img-fluid mb-3" alt="{{ $post->title }}">
        @endif

        <h2 class="mb-3">{{ $post->title }}</h2>
        <p class="text-muted">Posted on <strong>{{ $post->created_at->format('F d, Y') }}</strong> by <strong>{{ $post->author }}</strong></p>
        
        <div class="mt-4">
            {!! nl2br(e($post->content)) !!}
        </div>
    </div>
</div>
@endsection
