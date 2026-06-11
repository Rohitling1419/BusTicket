@extends('frontend.master')

@section('content')
<div class="blog-section py-5">
    <div class="container" style="margin-top: 3rem;">

        @if ($posts->isEmpty())
        <div class="empty-state text-center py-5">
            <i class="bi bi-journal-text display-1 text-muted mb-3"></i>
            <h3>No blog posts available</h3>
            <p class="text-muted">Check back later for new content</p>
        </div>
        @else
        <div class="row g-4">
            @foreach ($posts as $post)
            <div class="col-lg-4 col-md-6">
                <div class="blog-card card h-100 border-0 shadow-sm">
                    <div class="card-img-wrapper">
                        @if ($post->image_path)
                        <!-- Display image from storage -->
                        <img src="{{ asset('storage/' . str_replace('public/', '', $post->image_path)) }}"
                            class="card-img-top" alt="{{ $post->title }}">
                        @else
                        <!-- Default image -->
                        <img src="{{ asset('images/default.jpg') }}"
                            class="card-img-top" alt="Default Image">
                        @endif
                        <div class="post-date">
                            <span class="day">{{ $post->created_at->format('d') }}</span>
                            <span class="month">{{ $post->created_at->format('M') }}</span>
                        </div>
                    </div>

                    <div class="card-body d-flex flex-column">
                        <div class="post-meta mb-2">
                            <span><i class="bi bi-person-fill me-1"></i>{{ $post->author }}</span>
                            <span><i class="bi bi-calendar3 me-1"></i>{{ $post->created_at->format('F d, Y') }}</span>
                        </div>

                        <h5 class="card-title">
                            <a href="{{ route('blog.show', $post->id) }}" class="post-title-link">

                                {{ Str::limit($post->title, 50) }}
                            </a>
                        </h5>

                        <p class="card-text text-muted">{{ Str::limit($post->content, 120) }}</p>

                        <a href="{{ route('blog.show', $post->id) }}" class="read-more-btn mt-auto">
                            Read More <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

<style>
    /* Enhanced Blog Section Styling */
    :root {
        --primary-color: #7209b7;
        --primary-light: #f3e8ff;
        --primary-dark: #560bad;
        --secondary-color: #4361ee;
        --accent-color: #4cc9f0;
        --success-color: #06d6a0;
        --warning-color: #ffd166;
        --danger-color: #ef476f;
        --light-color: #f8f9fa;
        --dark-color: #212529;
        --gray-100: #f8f9fa;
        --gray-200: #e9ecef;
        --gray-300: #dee2e6;
        --gray-400: #ced4da;
        --gray-500: #adb5bd;
        --gray-600: #6c757d;
        --gray-700: #495057;
        --gray-800: #343a40;
        --gray-900: #212529;
        --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.05);
        --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        --shadow-md: 0 6px 12px rgba(0, 0, 0, 0.08);
        --shadow-lg: 0 15px 25px rgba(0, 0, 0, 0.1);
        --transition: all 0.3s ease;
    }

    body {
        background-color: var(--light-color);
        color: var(--gray-700);
    }

    .blog-section {
        padding: 5rem 0;
        background-color: var(--light-color);
        position: relative;
    }

    /* Blog Title Styling */
    .blog-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 0.5rem;
    }

    .title-underline {
        height: 4px;
        width: 80px;
        background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
        margin: 0.5rem auto 1.5rem;
        border-radius: 2px;
    }

    .blog-subtitle {
        font-size: 1.1rem;
        color: var(--gray-600);
        max-width: 600px;
        margin: 0 auto 2rem;
    }

    /* Blog Card Styling */
    .blog-card {
        border-radius: 1rem;
        overflow: hidden;
        transition: var(--transition);
        background-color: white;
        height: 100%;
    }

    .blog-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-lg);
    }

    .card-img-wrapper {
        position: relative;
        overflow: hidden;
    }

    .card-img-top {
        height: 220px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .blog-card:hover .card-img-top {
        transform: scale(1.05);
    }

    /* Post Date Badge */
    .post-date {
        position: absolute;
        top: 15px;
        right: 15px;
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        color: white;
        border-radius: 0.5rem;
        padding: 0.5rem;
        text-align: center;
        min-width: 60px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        z-index: 2;
    }

    .post-date .day {
        font-size: 1.2rem;
        font-weight: 700;
        display: block;
        line-height: 1;
    }

    .post-date .month {
        font-size: 0.8rem;
        text-transform: uppercase;
        display: block;
        font-weight: 500;
    }

    /* Card Body Styling */
    .card-body {
        padding: 1.5rem;
    }

    .post-meta {
        display: flex;
        gap: 1rem;
        font-size: 0.85rem;
        color: var(--gray-600);
        margin-bottom: 0.75rem;
    }

    .post-meta span {
        display: inline-flex;
        align-items: center;
    }

    .post-meta i {
        color: var(--primary-color);
        margin-right: 0.25rem;
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: 700;
        line-height: 1.4;
        margin-bottom: 0.75rem;
    }

    .post-title-link {
        color: var(--gray-800);
        text-decoration: none;
        transition: var(--transition);
        display: inline-block;
    }

    .post-title-link:hover {
        color: var(--primary-color);
    }

    .card-text {
        font-size: 0.95rem;
        line-height: 1.6;
        color: var(--gray-600);
    }

    /* Read More Button */
    .read-more-btn {
        display: inline-flex;
        align-items: center;
        color: var(--primary-color);
        font-weight: 600;
        text-decoration: none;
        padding: 0.5rem 0;
        position: relative;
        transition: var(--transition);
    }

    .read-more-btn::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 2px;
        background-color: var(--primary-color);
        transition: var(--transition);
    }

    .read-more-btn:hover {
        color: var(--primary-dark);
    }

    .read-more-btn:hover::after {
        width: 100%;
    }

    .read-more-btn i {
        transition: var(--transition);
    }

    .read-more-btn:hover i {
        transform: translateX(5px);
    }

    /* Empty State Styling */
    .empty-state {
        background-color: white;
        border-radius: 1rem;
        padding: 3rem;
        box-shadow: var(--shadow);
    }

    .empty-state i {
        color: var(--gray-300);
    }

    .empty-state h3 {
        color: var(--gray-700);
        margin-bottom: 0.5rem;
    }

    /* Responsive Adjustments */
    @media (max-width: 991.98px) {
        .blog-title {
            font-size: 2.25rem;
        }

        .blog-section {
            padding: 4rem 0;
        }
    }

    @media (max-width: 767.98px) {
        .blog-title {
            font-size: 2rem;
        }

        .blog-subtitle {
            font-size: 1rem;
        }

        .blog-section {
            padding: 3rem 0;
        }

        .card-img-top {
            height: 200px;
        }
    }

    @media (max-width: 575.98px) {
        .blog-title {
            font-size: 1.75rem;
        }

        .blog-section {
            padding: 2.5rem 0;
        }

        .card-img-top {
            height: 180px;
        }

        .post-date {
            top: 10px;
            right: 10px;
            min-width: 50px;
            padding: 0.4rem;
        }

        .post-date .day {
            font-size: 1rem;
        }

        .post-date .month {
            font-size: 0.7rem;
        }

        .card-body {
            padding: 1.25rem;
        }

        .card-title {
            font-size: 1.15rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const blogCards = document.querySelectorAll('.blog-card');

        if (blogCards.length > 0) {
            blogCards.forEach((card, index) => {
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 100 * index);
            });
        }
    });
</script>
@endsection