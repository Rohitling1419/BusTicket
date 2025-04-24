@extends('frontend.master')

@section('content')
<div class="blog-detail-section py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Main Blog Post Card -->
                <div class="blog-post-card card border-0 shadow overflow-hidden" style="margin-top: 2rem;">
                    
                    @if ($post->image_path)
                        <div class="featured-image-wrapper">
                            <img src="{{ asset('storage/' . str_replace('public/', '', $post->image_path)) }}" 
                                 class="featured-image" alt="{{ $post->title }}">
                        </div>
                    @endif

                    <div class="card-body p-4">
                        <div class="post-meta">
                            <div class="post-date">
                                <i class="bi bi-calendar3"></i>
                                {{ $post->created_at->format('F d, Y') }}
                            </div>
                            <div class="post-author">
                                <i class="bi bi-person-fill"></i>
                                {{ $post->author }}
                            </div>
                            <div class="post-category">
                                <i class="bi bi-bookmark-fill"></i>
                                Travel
                            </div>
                        </div>

                        <h1 class="post-title">{{ $post->title }}</h1>
                        
                        <div class="post-content">
                            {!! nl2br(e($post->content)) !!}
                        </div>
                        
                        <div class="post-footer mt-4">
                            <div class="post-tags">
                                <i class="bi bi-tags-fill"></i>
                                <span class="tag">Travel</span>
                                <span class="tag">Bus</span>
                                <span class="tag">Tourism</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- More Blog Posts Section -->
                <div class="more-posts mt-4">
                    <div class="text-center">
                        <a href="{{ route('blog') }}" class="view-all-btn">
                            View All Blog Posts <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Enhanced Blog Post Detail Styling */
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
        line-height: 1.5;
    }

    .blog-detail-section {
        padding: 3rem 0;
        background-color: var(--light-color);
        position: relative;
    }

    /* Blog Post Card Styling */
    .blog-post-card {
        border-radius: 0.75rem;
        overflow: hidden;
        background-color: white;
        position: relative;
    }

    /* Post Navigation */
    .post-navigation {
        padding: 1rem 1.5rem 0;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        color: var(--gray-600);
        text-decoration: none;
        font-weight: 500;
        transition: var(--transition);
        padding: 0.4rem 0.8rem;
        border-radius: 1.5rem;
        background-color: var(--gray-100);
    }

    .back-link:hover {
        color: var(--primary-color);
        background-color: var(--primary-light);
    }

    .back-link i {
        margin-right: 0.4rem;
        font-size: 1rem;
    }

    /* Featured Image */
    .featured-image-wrapper {
        position: relative;
        overflow: hidden;
        max-height: 400px;
    }

    .featured-image {
        width: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .blog-post-card:hover .featured-image {
        transform: scale(1.02);
    }

    /* Post Meta */
    .post-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-bottom: 1rem;
        font-size: 0.85rem;
        color: var(--gray-600);
    }

    .post-date, .post-author, .post-category {
        display: flex;
        align-items: center;
        background-color: var(--gray-100);
        padding: 0.35rem 0.75rem;
        border-radius: 1.5rem;
        transition: var(--transition);
    }

    .post-date:hover, .post-author:hover, .post-category:hover {
        background-color: var(--primary-light);
        color: var(--primary-dark);
    }

    .post-meta i {
        color: var(--primary-color);
        margin-right: 0.4rem;
        font-size: 0.9rem;
    }

    /* Post Title */
    .post-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 1rem;
        line-height: 1.3;
        position: relative;
        padding-bottom: 0.75rem;
    }

    .post-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 3px;
        background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
        border-radius: 2px;
    }

    /* Post Content */
    .post-content {
        font-size: 1rem;
        line-height: 1.7;
        color: var(--gray-700);
        margin-top: 1.5rem;
    }

    .post-content p {
        margin-bottom: 1.25rem;
    }

    /* Post Footer */
    .post-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 0.75rem;
        padding-top: 1rem;
        border-top: 1px solid var(--gray-200);
    }

    /* Post Tags */
    .post-tags {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 0.4rem;
    }

    .post-tags i {
        color: var(--primary-color);
        margin-right: 0.4rem;
    }

    .tag {
        display: inline-block;
        padding: 0.25rem 0.6rem;
        background-color: var(--primary-light);
        color: var(--primary-color);
        border-radius: 1.5rem;
        font-size: 0.8rem;
        font-weight: 500;
        transition: var(--transition);
    }

    .tag:hover {
        background-color: var(--primary-color);
        color: white;
        transform: translateY(-2px);
    }

    /* Post Share */
    .post-share {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .share-label {
        font-weight: 500;
        color: var(--gray-700);
    }

    .share-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background-color: var(--gray-100);
        color: var(--gray-700);
        text-decoration: none;
        transition: var(--transition);
    }

    .share-icon:hover {
        background-color: var(--primary-color);
        color: white;
        transform: translateY(-2px);
    }

    /* More Posts Section */
    .more-posts {
        padding-top: 1.5rem;
    }

    .section-header {
        text-align: center;
        margin-bottom: 1.5rem;
    }

    .section-title {
        font-size: 1.6rem;
        font-weight: 700;
        color: var(--gray-800);
        margin-bottom: 0.4rem;
    }

    .title-underline {
        height: 3px;
        width: 60px;
        background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
        margin: 0.4rem auto 0.75rem;
        border-radius: 2px;
    }

    .section-subtitle {
        font-size: 1rem;
        color: var(--gray-600);
        max-width: 500px;
        margin: 0 auto;
    }

    /* Blog Item Styling */
    .blog-item {
        background-color: white;
        border-radius: 0.75rem;
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: var(--transition);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .blog-item:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-md);
    }

    .blog-image {
        position: relative;
        height: 180px;
        overflow: hidden;
    }

    .blog-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .blog-item:hover .blog-image img {
        transform: scale(1.05);
    }

    .category-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 0.3rem 0.8rem;
        border-radius: 1.5rem;
        font-size: 0.75rem;
        font-weight: 500;
        z-index: 2;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.15);
    }

    .blog-content {
        padding: 1.25rem;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .blog-meta {
        display: flex;
        gap: 0.75rem;
        font-size: 0.8rem;
        color: var(--gray-600);
        margin-bottom: 0.75rem;
    }

    .blog-meta span {
        display: flex;
        align-items: center;
    }

    .blog-meta i {
        color: var(--primary-color);
        margin-right: 0.25rem;
    }

    .blog-title {
        font-size: 1.15rem;
        font-weight: 700;
        line-height: 1.4;
        margin-bottom: 0.6rem;
        color: var(--gray-800);
        transition: var(--transition);
    }

    .blog-item:hover .blog-title {
        color: var(--primary-color);
    }

    .blog-excerpt {
        font-size: 0.9rem;
        color: var(--gray-600);
        margin-bottom: 1rem;
        flex-grow: 1;
    }

    .read-more {
        display: inline-flex;
        align-items: center;
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: var(--transition);
        margin-top: auto;
    }

    .read-more i {
        margin-left: 0.4rem;
        transition: var(--transition);
    }

    .read-more:hover {
        color: var(--primary-dark);
    }

    .read-more:hover i {
        transform: translateX(4px);
    }

    /* View All Button */
    .view-all-btn {
        display: inline-flex;
        align-items: center;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 0.6rem 1.5rem;
        border-radius: 1.5rem;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none;
        transition: var(--transition);
        box-shadow: 0 3px 8px rgba(114, 9, 183, 0.25);
    }

    .view-all-btn i {
        margin-left: 0.4rem;
        transition: var(--transition);
    }

    .view-all-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 12px rgba(114, 9, 183, 0.3);
        color: white;
    }

    .view-all-btn:hover i {
        transform: translateX(4px);
    }

    /* Responsive Adjustments */
    @media (max-width: 991.98px) {
        .post-title {
            font-size: 1.6rem;
        }
        
        .post-content {
            font-size: 0.95rem;
        }
        
        .featured-image-wrapper {
            max-height: 350px;
        }
        
        .section-title {
            font-size: 1.5rem;
        }
        
        .blog-image {
            height: 160px;
        }
    }

    @media (max-width: 767.98px) {
        .blog-detail-section {
            padding: 2rem 0;
        }
        
        .post-title {
            font-size: 1.5rem;
        }
        
        .post-content {
            font-size: 0.95rem;
        }
        
        .featured-image-wrapper {
            max-height: 300px;
        }
        
        .card-body {
            padding: 1.25rem !important;
        }
        
        .post-footer {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .post-share {
            margin-top: 0.75rem;
        }
        
        .blog-image {
            height: 180px;
        }
        
        .section-subtitle {
            font-size: 0.95rem;
        }
    }

    @media (max-width: 575.98px) {
        .blog-detail-section {
            padding: 1.5rem 0;
        }
        
        .post-title {
            font-size: 1.4rem;
        }
        
        .post-meta {
            gap: 0.5rem;
            margin-bottom: 0.75rem;
        }
        
        .featured-image-wrapper {
            max-height: 250px;
        }
        
        .post-navigation {
            padding: 0.75rem 1.25rem 0;
        }
        
        .section-title {
            font-size: 1.35rem;
        }
        
        .blog-title {
            font-size: 1.1rem;
        }
        
        .blog-content {
            padding: 1rem;
        }
        
        .view-all-btn {
            padding: 0.5rem 1.25rem;
            font-size: 0.85rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Smooth scroll to top when page loads
        window.scrollTo({top: 0, behavior: 'smooth'});
        
        // Add animation to post content paragraphs
        const paragraphs = document.querySelectorAll('.post-content p');
        if (paragraphs.length > 0) {
            paragraphs.forEach((paragraph, index) => {
                paragraph.style.opacity = '0';
                paragraph.style.transform = 'translateY(15px)';
                
                // Add a slight delay based on the index
                setTimeout(() => {
                    paragraph.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
                    paragraph.style.opacity = '1';
                    paragraph.style.transform = 'translateY(0)';
                }, 80 * (index + 1));
            });
        }
        
        // Add animation to blog items
        const blogItems = document.querySelectorAll('.blog-item');
        if (blogItems.length > 0) {
            blogItems.forEach((item, index) => {
                item.style.opacity = '0';
                item.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    item.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    item.style.opacity = '1';
                    item.style.transform = 'translateY(0)';
                }, 150 * (index + 1));
            });
        }
    });
</script>
@endsection