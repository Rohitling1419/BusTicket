@extends('frontend.master')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4">Blog Posts</h1>

    @if ($posts->isEmpty())
        <p class="text-center text-muted">No blog posts available.</p>
    @else
    <div class="row">
    @foreach ($posts as $post)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow-sm border-0 h-100">
              
                @if ($post->image_path)
                    <!-- Display image from storage -->
                    <img src="{{ asset('storage/' . str_replace('public/', '', $post->image_path)) }}" class="card-img-top" alt="{{ $post->title }}">

                @else
                    <!-- Default image -->
                    <img src="{{ asset('images/default.jpg') }}" class="card-img-top" alt="Default Image">
                @endif
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">
                        <a href="{{ route('admin.posts.index', $post->id) }}" class="text-dark text-decoration-none">
                            {{ Str::limit($post->title, 50) }}
                        </a>
                    </h5>
                    <p class="text-muted small">
                        Posted on <strong>{{ $post->created_at->format('F d, Y') }}</strong> by <strong>{{ $post->author }}</strong>
                    </p>
                    <p class="text-muted">{{ Str::limit($post->content, 100) }}</p>
                    <a href="{{ route('admin.posts.index', $post->id) }}" class="btn btn-primary mt-auto">Read More</a>
                </div>
            </div>
        </div>
    @endforeach
</div>

    @endif
</div>
@endsection
