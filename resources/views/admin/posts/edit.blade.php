@extends('admin.layout')


@section('content')
<x-app-layout>
    <main id="main" class="main py-3 py-md-5">
        <div class="container-fluid px-3 px-md-4">
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('admin.posts.index') }}" class="btn btn-sm me-3"
                   style="background-color: #f3f4f6; color: #4b5563; border-radius: 6px;">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>
                <h2 class="fw-bold fs-3 fs-md-2 m-0" style="color: #4f46e5;">
                    <i class="fas fa-edit me-2"></i> Edit Blog Post
                </h2>
            </div>

            <!-- Error Messages -->
            @if($errors->any())
            <div class="alert alert-dismissible fade show mb-4 border-0" role="alert"
                 style="background-color: #fef2f2; color: #991b1b; border-left: 4px solid #ef4444; animation: slideIn 0.3s ease-out;">
                <div class="d-flex">
                    <div class="me-3">
                        <i class="fas fa-exclamation-circle fs-5"></i>
                    </div>
                    <div>
                        <h5 class="fw-semibold mb-1">Please fix the following errors:</h5>
                        <ul class="ps-3 mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px; overflow: hidden;">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-8">
                                <!-- Title Field -->
                                <div class="mb-4">
                                    <label for="title" class="form-label fw-medium mb-2" style="color: #4b5563;">Title</label>
                                    <input type="text" class="form-control form-control-lg" id="title" name="title"
                                           value="{{ $post->title }}" required
                                           style="border-radius: 8px; border-color: #e5e7eb; padding: 0.75rem 1rem;">
                                </div>

                                <!-- Content Field -->
                                <div class="mb-4">
                                    <label for="content" class="form-label fw-medium mb-2" style="color: #4b5563;">Content</label>
                                    <textarea class="form-control" id="content" name="content" rows="8" required
                                              style="border-radius: 8px; border-color: #e5e7eb; padding: 0.75rem 1rem; min-height: 200px;">{{ $post->content }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <!-- Image Field -->
                                <div class="mb-4">
                                    <label for="image" class="form-label fw-medium mb-2" style="color: #4b5563;">Featured Image</label>

                                    @if($post->image_path)
                                    <div class="mb-3 position-relative" style="border-radius: 8px; overflow: hidden; border: 2px dashed #e5e7eb;">
                                        <div style="position: relative; padding-top: 56.25%;">
                                            <img src="{{ asset('storage/' . str_replace('public/', '', $post->image_path)) }}"
                                                 class="position-absolute top-0 start-0 w-100 h-100"
                                                 style="object-fit: cover;">
                                        </div>
                                        <div class="p-2 bg-light text-center">
                                            <small class="text-muted">Current image</small>
                                        </div>
                                    </div>
                                    @endif

                                    <div class="input-group" style="border-radius: 8px; overflow: hidden;">
                                        <input type="file" class="form-control" id="image" name="image"
                                               style="border-radius: 8px; border-color: #e5e7eb; padding: 0.75rem 1rem;">
                                    </div>
                                    <div class="form-text mt-2">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Recommended size: 1200×675 pixels (16:9 ratio)
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                            <a href="{{ route('admin.posts.index') }}" class="btn btn-lg px-4"
                               style="border: 1.5px solid #e5e7eb; color: #4b5563; background-color: white; border-radius: 8px; font-weight: 500;">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-lg px-5"
                                    style="background-color: #4f46e5; color: white; border-radius: 8px; font-weight: 500;">
                                <i class="fas fa-save me-2"></i> Update Post
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <style>
        /* Custom styles for enhanced UI */
        body {
            background-color: #f9fafb;
            color: #1f2937;
        }

        .btn {
            transition: all 0.2s ease;
            font-weight: 500;
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .btn:active {
            transform: translateY(0);
        }

        .card {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            transition: box-shadow 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
            border-color: #4f46e5;
        }

        /* Animation for alerts */
        .alert {
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-8px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Focus styles */
        a:focus, button:focus, input:focus, textarea:focus {
            outline: 2px solid rgba(79, 70, 229, 0.5);
            outline-offset: 2px;
        }

        /* File input styling */
        input[type="file"] {
            padding: 0.5rem;
        }

        input[type="file"]::file-selector-button {
            border: 1px solid #e5e7eb;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            background-color: #f9fafb;
            color: #4b5563;
            margin-right: 1rem;
            transition: all 0.2s ease;
        }

        input[type="file"]::file-selector-button:hover {
            background-color: #f3f4f6;
            border-color: #d1d5db;
        }

        /* Responsive styles */
        @media (max-width: 767.98px) {
            .card-body {
                padding: 1.5rem;
            }

            .btn-lg {
                padding: 0.5rem 1rem;
                font-size: 1rem;
            }
        }
    </style>
</x-app-layout>
@endsection