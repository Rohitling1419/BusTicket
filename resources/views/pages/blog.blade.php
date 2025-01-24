@extends('frontend.Master')

@section('content')
<div class="container py-5" style="margin-top: 2rem;">
    <!-- Blog Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="text-center" style="color: rgb(147,7,231);">Blog</h1>
        </div>
    </div>

    <div class="row">
        <!-- Blog Post List -->

        <!-- Dummy Blog Post 1 -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title"><a href="#" class="text-decoration-none">Blog Post Title 1</a></h2>
                    <p class="text-muted">Posted on <strong>January 6, 2025</strong> by <strong>Author Name</strong></p>
                    <img src="https://via.placeholder.com/900x400" class="card-img-top mb-4" alt="Blog Post 1">
                    <p class="lead">This is a short description or excerpt for Blog Post 1. You can include an introduction or summary here.</p>
                    <a href="#" class="btn btn-primary">Read More</a>
                </div>
            </div>
        </div>

        <!-- Dummy Blog Post 2 -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title"><a href="#" class="text-decoration-none">Blog Post Title 2</a></h2>
                    <p class="text-muted">Posted on <strong>January 5, 2025</strong> by <strong>Author Name</strong></p>
                    <img src="https://via.placeholder.com/900x400" class="card-img-top mb-4" alt="Blog Post 2">
                    <p class="lead">This is a short description or excerpt for Blog Post 2. You can include an introduction or summary here.</p>
                    <a href="#" class="btn btn-primary">Read More</a>
                </div>
            </div>
        </div>

        <!-- Dummy Blog Post 3 -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title"><a href="#" class="text-decoration-none">Blog Post Title 3</a></h2>
                    <p class="text-muted">Posted on <strong>January 4, 2025</strong> by <strong>Author Name</strong></p>
                    <img src="https://via.placeholder.com/900x400" class="card-img-top mb-4" alt="Blog Post 3">
                    <p class="lead">This is a short description or excerpt for Blog Post 3. You can include an introduction or summary here.</p>
                    <a href="#" class="btn btn-primary">Read More</a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
