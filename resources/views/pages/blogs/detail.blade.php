@extends('layouts.user')

@section('head')
    <style>
        /* Custom Blog Page Styles */
        .blog-hero {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        }
        
        .blog-image {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .blog-image:hover {
            transform: scale(1.02);
        }
        
        .reading-progress {
            position: fixed;
            top: 0;
            left: 0;
            width: 0%;
            height: 3px;
            background: linear-gradient(90deg, #f59e0b, #d97706);
            z-index: 9999;
            transition: width 0.3s ease;
        }
        
        .floating-toc {
            position: sticky;
            top: 2rem;
            max-height: calc(100vh - 4rem);
            overflow-y: auto;
        }
        
        .comment-card {
            background: linear-gradient(145deg, #f8fafc, #e2e8f0);
            transition: all 0.3s ease;
        }
        
        .comment-card:hover {
            background: linear-gradient(145deg, #e2e8f0, #cbd5e1);
            transform: translateY(-2px);
        }
        
        .author-card {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            transition: all 0.3s ease;
        }
        
        .author-card:hover {
            background: linear-gradient(135deg, #fde68a 0%, #fcd34d 100%);
            transform: translateY(-2px);
        }
        
        .related-blog-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .related-blog-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }
        
        .social-share-button {
            transition: all 0.3s ease;
        }
        
        .social-share-button:hover {
            transform: scale(1.1);
        }
        
        .reading-time-badge {
            background: linear-gradient(45deg, #10b981, #059669);
        }
        
        .bookmark-float {
            animation: bookmarkFloat 3s ease-in-out infinite;
        }
        
        @keyframes bookmarkFloat {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-10px) rotate(3deg); }
        }
        
        .prose {
            line-height: 1.8;
        }
        
        .prose h1, .prose h2, .prose h3, .prose h4, .prose h5, .prose h6 {
            margin-top: 2rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }
        
        .prose p {
            margin-bottom: 1.5rem;
        }
        
        .prose img {
            border-radius: 0.75rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        
        .comment-form {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
        }
        
        .share-buttons {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.8);
        }
    </style>
    
    <x-seo :modal="$blog" title="title"/>
@endsection

@section('content')
    <!-- Reading Progress Bar -->
    <div id="reading-progress" class="reading-progress"></div>
    
    <div class="container mx-auto px-4 max-w-7xl">
        <x-user.bread-crumb :data="['Home', 'Blog', $blog->title]"/>
        
        <div class="grid lg:grid-cols-4 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-3 space-y-8">
                <!-- Article Header -->
                <article class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                    <!-- Hero Image -->
                    <div class="relative">
                        <!-- Reading Time Badge -->
                        <div class="reading-time-badge absolute top-4 left-4 z-10 text-white px-4 py-2 rounded-xl font-bold shadow-lg">
                            <i class='bx bx-time mr-1'></i>
                            {{ ceil(str_word_count(strip_tags($blog->content)) / 200) }} min read
                        </div>
                        
                        <!-- Category Badge -->
                        @if($blog->category)
                            <div class="absolute top-4 right-4 z-10 bg-white bg-opacity-90 text-gray-700 px-4 py-2 rounded-xl font-medium shadow-lg">
                                <i class='bx bx-folder mr-1'></i>
                                {{ $blog->category->name }}
                            </div>
                        @endif
                        
                        <img src="{{ url('storage/' . $blog->thumbnail) }}" 
                             alt="{{ $blog->title }}" 
                             class="blog-image w-full h-64 md:h-80 object-cover">
                    </div>

                    <!-- Article Content -->
                    <div class="p-6 md:p-8">
                        <!-- Author Info -->
                        <div class="author-card rounded-xl p-4 mb-6">
                            <div class="flex items-center">
                                <img src="{{ url('storage/' . $blog->company->logo) }}" 
                                     alt="{{ $blog->company->name }}"
                                     class="w-16 h-16 rounded-full border-4 border-white shadow-lg mr-4">
                                <div class="flex-1">
                                    <div class="flex items-center text-sm text-gray-600 mb-1">
                                        <i class='bx bx-calendar mr-1'></i>
                                        Published {{ $blog->created_at->format('M j, Y') }} 
                                        <span class="mx-2">•</span>
                                        {{ $blog->created_at->diffForHumans() }}
                                    </div>
                                    <div class="flex items-center">
                                        <span class="text-gray-700 mr-2">by</span>
                                        <a href="{{ route('view.company', [$blog->company->slug]) }}" 
                                           class="font-semibold text-amber-700 hover:text-amber-800 transition-colors">
                                            {{ $blog->company->name }}
                                        </a>
                                    </div>
                                </div>
                                
                                <!-- Follow/Contact Button -->
                                <a href="{{ route('view.company', [$blog->company->slug]) }}"
                                   class="bg-amber-600 hover:bg-amber-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                                    <i class='bx bx-user-plus mr-1'></i>
                                    Follow
                                </a>
                            </div>
                        </div>

                        <!-- Article Title -->
                        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                            {{ $blog->title }}
                        </h1>

                        <!-- Article Meta -->
                        <div class="flex flex-wrap items-center gap-4 mb-8 text-sm text-gray-600">
                            <div class="flex items-center">
                                <i class='bx bx-show mr-1'></i>
                                {{ $blog->views ?? 0 }} views
                            </div>
                            <div class="flex items-center">
                                <i class='bx bx-message-dots mr-1'></i>
                                {{ $blog->comments->count() }} comments
                            </div>
                            @if($blog->tags)
                                <div class="flex items-center flex-wrap gap-2">
                                    <i class='bx bx-tag mr-1'></i>
                                    @foreach(is_array($blog->tags) ? $blog->tags : explode(',', $blog->tags) as $tag)
                                        <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded-full text-xs">
                                            {{ trim($tag) }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <!-- Social Share Buttons -->
                        <div class="share-buttons rounded-xl p-4 mb-8">
                            <div class="flex items-center justify-between">
                                <h3 class="font-semibold text-gray-900">Share this article</h3>
                                <div class="flex items-center space-x-3">
                                    <button onclick="shareOnFacebook()" 
                                            class="social-share-button w-10 h-10 bg-blue-600 hover:bg-blue-700 text-white rounded-full flex items-center justify-center">
                                        <i class='bx bxl-facebook'></i>
                                    </button>
                                    <button onclick="shareOnTwitter()" 
                                            class="social-share-button w-10 h-10 bg-sky-500 hover:bg-sky-600 text-white rounded-full flex items-center justify-center">
                                        <i class='bx bxl-twitter'></i>
                                    </button>
                                    <button onclick="shareOnLinkedIn()" 
                                            class="social-share-button w-10 h-10 bg-blue-700 hover:bg-blue-800 text-white rounded-full flex items-center justify-center">
                                        <i class='bx bxl-linkedin'></i>
                                    </button>
                                    <button onclick="copyLink()" 
                                            class="social-share-button w-10 h-10 bg-gray-600 hover:bg-gray-700 text-white rounded-full flex items-center justify-center">
                                        <i class='bx bx-link'></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Article Content -->
                        <div class="prose prose-lg max-w-none text-gray-800" id="article-content">
                            {!! $blog->content !!}
                        </div>

                        <!-- Article Footer -->
                        <div class="border-t border-gray-200 pt-8 mt-8">
                            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                                <!-- Tags -->
                                @if($blog->tags)
                                    <div>
                                        <h4 class="font-semibold text-gray-900 mb-2">Tags:</h4>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach(is_array($blog->tags) ? $blog->tags : explode(',', $blog->tags) as $tag)
                                                <span class="bg-amber-100 text-amber-800 px-3 py-1 rounded-full text-sm font-medium">
                                                    #{{ trim($tag) }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                
                                <!-- Like/Bookmark Actions -->
                                <div class="flex items-center space-x-3">
                                    <button onclick="likeArticle()" 
                                            class="flex items-center bg-red-50 hover:bg-red-100 text-red-600 px-4 py-2 rounded-lg transition-colors">
                                        <i class='bx bx-heart mr-2'></i>
                                        <span id="like-count">{{ $blog->likes ?? 0 }}</span>
                                    </button>
                                    <button onclick="bookmarkArticle()" 
                                            class="flex items-center bg-amber-50 hover:bg-amber-100 text-amber-600 px-4 py-2 rounded-lg transition-colors">
                                        <i class='bx bx-bookmark mr-2'></i>
                                        Bookmark
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Comments Section -->
                <section class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 md:p-8">
                    <!-- Comment Form -->
                    <div class="comment-form rounded-2xl p-6 mb-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                            <i class='bx bx-message-dots text-blue-600 mr-3'></i>
                            Leave a Comment
                        </h3>
                        
                        <form method="post" action="{{ route('blog.comment.submit') }}" id="commentForm">
                            @csrf
                            <div class="space-y-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                        Your Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" 
                                           id="name" 
                                           name="name" 
                                           required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                           placeholder="Enter your name">
                                </div>
                                
                                <div>
                                    <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">
                                        Your Comment <span class="text-red-500">*</span>
                                    </label>
                                    <textarea id="comment" 
                                              name="comment" 
                                              rows="5" 
                                              required
                                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none"
                                              placeholder="Share your thoughts..."></textarea>
                                </div>
                            </div>
                            
                            <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                            @auth
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <button type="submit" 
                                        class="mt-6 w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold py-3 rounded-lg hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105">
                                    <i class='bx bx-send mr-2'></i>
                                    Submit Comment
                                </button>
                            @else
                                <button type="button" 
                                        onclick="showLoginPrompt()"
                                        class="mt-6 w-full bg-gray-600 hover:bg-gray-700 text-white font-semibold py-3 rounded-lg transition-colors">
                                    <i class='bx bx-log-in mr-2'></i>
                                    Login to Comment
                                </button>
                            @endauth
                        </form>
                    </div>

                    <!-- Comments List -->
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">
                            Comments 
                            <span class="text-lg text-gray-500 font-normal">({{ $blog->comments->count() }})</span>
                        </h3>

                        @if($blog->comments->count() > 0)
                            <div class="space-y-6">
                                @foreach($blog->comments as $comment)
                                    <div class="comment-card rounded-2xl p-6">
                                        <div class="flex items-start space-x-4">
                                            <!-- Avatar -->
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name) }}&background=f59e0b&color=fff&size=48" 
                                                 alt="{{ $comment->user->name }}"
                                                 class="w-12 h-12 rounded-full border-2 border-amber-200">
                                            
                                            <!-- Comment Content -->
                                            <div class="flex-1">
                                                <div class="flex items-center justify-between mb-2">
                                                    <div>
                                                        <h4 class="font-semibold text-gray-900">{{ $comment->user->name }}</h4>
                                                        <p class="text-sm text-gray-600">{{ $comment->created_at->diffForHumans() }}</p>
                                                    </div>
                                                    
                                                    <!-- Comment Actions -->
                                                    <div class="flex items-center space-x-2">
                                                        <button class="text-gray-400 hover:text-red-500 transition-colors">
                                                            <i class='bx bx-heart'></i>
                                                        </button>
                                                        <button class="text-gray-400 hover:text-blue-500 transition-colors">
                                                            <i class='bx bx-reply'></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                
                                                <div class="prose prose-sm max-w-none text-gray-700">
                                                    {!! $comment->comment !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-12 bg-gray-50 rounded-2xl">
                                <i class='bx bx-message-dots text-6xl text-gray-300 mb-4'></i>
                                <h4 class="text-lg font-semibold text-gray-600 mb-2">No Comments Yet</h4>
                                <p class="text-gray-500">Be the first to share your thoughts!</p>
                            </div>
                        @endif
                    </div>
                </section>

                <!-- Related Blogs Section -->
                @if($related_blogs && $related_blogs->count() > 0)
                <section class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 md:p-8">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-3xl font-bold text-gray-900 flex items-center">
                            <i class='bx bx-book-open text-amber-600 mr-3'></i>
                            Related Articles
                        </h2>
                        <span class="bg-amber-100 text-amber-800 px-3 py-1 rounded-full text-sm font-medium">
                            {{ $related_blogs->count() }} {{ Str::plural('Article', $related_blogs->count()) }}
                        </span>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($related_blogs as $item)
                            <div class="related-blog-card bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden group">
                                <!-- Blog Image -->
                                <div class="relative h-48 bg-gray-50 overflow-hidden">
                                    <a href="{{ route('view.blog', $item->slug) }}">
                                        <img alt="{{ $item->title }}" 
                                             src="{{ url('storage/' . $item->thumbnail) }}"
                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                    </a>
                                    
                                    <!-- Reading Time -->
                                    <div class="absolute bottom-3 right-3 bg-black bg-opacity-70 text-white px-2 py-1 rounded-lg text-xs">
                                        {{ ceil(str_word_count(strip_tags($item->content ?? $item->summary ?? '')) / 200) }} min
                                    </div>
                                </div>

                                <!-- Blog Info -->
                                <div class="p-4">
                                    <h4 class="font-semibold text-gray-900 mb-3 line-clamp-2 group-hover:text-amber-600 transition-colors">
                                        <a href="{{ route('view.blog', $item->slug) }}">
                                            {{ $item->title }}
                                        </a>
                                    </h4>
                                    
                                    <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                        {!! Str::limit(strip_tags($item->summary), 100) !!}
                                    </p>

                                    <!-- Blog Meta -->
                                    <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
                                        <span>{{ $item->created_at->format('M j, Y') }}</span>
                                        <div class="flex items-center">
                                            <i class='bx bx-message-dots mr-1'></i>
                                            {{ $item->comments_count ?? 0 }} comments
                                        </div>
                                    </div>

                                    <a href="{{ route('view.blog', $item->slug) }}"
                                       class="block w-full text-center bg-gradient-to-r from-amber-600 to-orange-600 text-white font-semibold py-3 rounded-xl hover:from-amber-700 hover:to-orange-700 transition-all duration-300 transform hover:scale-105">
                                        <i class='bx bx-book-open mr-2'></i>
                                        Read Article
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Table of Contents -->
                <div class="floating-toc bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                    <h3 class="font-bold text-gray-900 mb-4 flex items-center">
                        <i class='bx bx-list-ul text-amber-600 mr-2'></i>
                        Table of Contents
                    </h3>
                    <div id="toc" class="space-y-2 text-sm">
                        <!-- TOC will be generated by JavaScript -->
                    </div>
                </div>

                <!-- Author Profile -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                    <h3 class="font-bold text-gray-900 mb-4 flex items-center">
                        <i class='bx bx-user text-amber-600 mr-2'></i>
                        About the Author
                    </h3>
                    
                    <div class="text-center">
                        <img src="{{ url('storage/' . $blog->company->logo) }}" 
                             alt="{{ $blog->company->name }}"
                             class="w-20 h-20 rounded-full mx-auto border-4 border-amber-100 shadow-lg mb-4">
                        
                        <h4 class="font-semibold text-gray-900 mb-2">{{ $blog->company->name }}</h4>
                        <p class="text-sm text-gray-600 mb-4">Content Creator & Industry Expert</p>
                        
                        <div class="grid grid-cols-2 gap-4 mb-4 text-center">
                            <div>
                                <div class="font-bold text-amber-600">{{ $blog->company->blogs_count ?? '1' }}</div>
                                <div class="text-xs text-gray-600">Articles</div>
                            </div>
                            <div>
                                <div class="font-bold text-blue-600">{{ $blog->company->followers_count ?? '0' }}</div>
                                <div class="text-xs text-gray-600">Followers</div>
                            </div>
                        </div>
                        
                        <a href="{{ route('view.company', [$blog->company->slug]) }}"
                           class="block w-full bg-amber-600 hover:bg-amber-700 text-white font-semibold py-2 rounded-lg transition-colors">
                            View Profile
                        </a>
                    </div>
                </div>

                <!-- Newsletter Signup -->
                <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl border border-amber-200 p-6">
                    <h3 class="font-bold text-gray-900 mb-4 flex items-center">
                        <i class='bx bx-envelope text-amber-600 mr-2'></i>
                        Stay Updated
                    </h3>
                    
                    <p class="text-gray-700 mb-4 text-sm">Get the latest articles and insights delivered to your inbox.</p>
                    
                    <form class="space-y-3">
                        <input type="email" 
                               placeholder="Enter your email"
                               class="w-full px-3 py-2 border border-amber-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500 text-sm">
                        <button type="submit" 
                                class="w-full bg-amber-600 hover:bg-amber-700 text-white font-semibold py-2 rounded-lg transition-colors text-sm">
                            Subscribe
                        </button>
                    </form>
                </div>

                <!-- Popular Articles -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                    <h3 class="font-bold text-gray-900 mb-4 flex items-center">
                        <i class='bx bx-trending-up text-amber-600 mr-2'></i>
                        Popular Articles
                    </h3>
                    
                    <div class="space-y-4">
                        @foreach($related_blogs->take(3) as $popular)
                            <div class="flex items-start space-x-3">
                                <img src="{{ url('storage/' . $popular->thumbnail) }}" 
                                     alt="{{ $popular->title }}"
                                     class="w-16 h-16 object-cover rounded-lg">
                                <div class="flex-1">
                                    <h4 class="font-medium text-gray-900 text-sm line-clamp-2 mb-1">
                                        <a href="{{ route('view.blog', $popular->slug) }}" class="hover:text-amber-600">
                                            {{ $popular->title }}
                                        </a>
                                    </h4>
                                    <p class="text-xs text-gray-600">{{ $popular->created_at->format('M j, Y') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Login Prompt Modal -->
    <div id="loginModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 p-6">
            <div class="text-center">
                <i class='bx bx-lock-alt text-6xl text-gray-300 mb-4'></i>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Login Required</h3>
                <p class="text-gray-600 mb-6">You need to be logged in to comment on this article.</p>
                
                <div class="flex space-x-3">
                    <button onclick="hideLoginModal()" 
                            class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 rounded-lg transition-colors">
                        Cancel
                    </button>
                    <a href="{{ route('auth.login') }}" 
                       class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition-colors text-center">
                        Login
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')
    <script>
        // Reading Progress Bar
        function updateReadingProgress() {
            const article = document.getElementById('article-content');
            const progressBar = document.getElementById('reading-progress');
            
            if (!article || !progressBar) return;
            
            const articleTop = article.offsetTop;
            const articleHeight = article.offsetHeight;
            const windowHeight = window.innerHeight;
            const scrollTop = window.scrollY;
            
            const progress = Math.min(
                Math.max((scrollTop - articleTop + windowHeight) / articleHeight, 0),
                1
            );
            
            progressBar.style.width = `${progress * 100}%`;
        }

        // Generate Table of Contents
        function generateTOC() {
            const article = document.getElementById('article-content');
            const toc = document.getElementById('toc');
            
            if (!article || !toc) return;
            
            const headings = article.querySelectorAll('h1, h2, h3, h4, h5, h6');
            
            if (headings.length === 0) {
                toc.innerHTML = '<p class="text-gray-500 text-sm">No headings found</p>';
                return;
            }
            
            let tocHTML = '';
            headings.forEach((heading, index) => {
                const id = `heading-${index}`;
                heading.id = id;
                
                const level = parseInt(heading.tagName.charAt(1));
                const indent = (level - 1) * 12;
                
                tocHTML += `
                    <a href="#${id}" 
                       class="block py-1 text-gray-600 hover:text-amber-600 transition-colors"
                       style="padding-left: ${indent}px;"
                       onclick="smoothScrollTo('${id}')">
                        ${heading.textContent}
                    </a>
                `;
            });
            
            toc.innerHTML = tocHTML;
        }

        // Smooth scroll to element
        function smoothScrollTo(elementId) {
            const element = document.getElementById(elementId);
            if (element) {
                element.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        }

        // Social Share Functions
        function shareOnFacebook() {
            const url = encodeURIComponent(window.location.href);
            const title = encodeURIComponent('{{ $blog->title }}');
            window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank', 'width=600,height=400');
        }

        function shareOnTwitter() {
            const url = encodeURIComponent(window.location.href);
            const title = encodeURIComponent('{{ $blog->title }}');
            const via = 'YourWebsite'; // Replace with your Twitter handle
            window.open(`https://twitter.com/intent/tweet?url=${url}&text=${title}&via=${via}`, '_blank', 'width=600,height=400');
        }

        function shareOnLinkedIn() {
            const url = encodeURIComponent(window.location.href);
            const title = encodeURIComponent('{{ $blog->title }}');
            const summary = encodeURIComponent('{{ strip_tags(Str::limit($blog->summary ?? $blog->content, 200)) }}');
            window.open(`https://www.linkedin.com/sharing/share-offsite/?url=${url}&title=${title}&summary=${summary}`, '_blank', 'width=600,height=400');
        }

        async function copyLink() {
            try {
                await navigator.clipboard.writeText(window.location.href);
                showNotification('Link copied to clipboard!', 'success');
            } catch (error) {
                console.error('Error copying link:', error);
                showNotification('Failed to copy link. Please try again.', 'error');
            }
        }

        // Like Article Function
        async function likeArticle() {
            try {
                // Simulate API call (replace with actual endpoint)
                const likeCount = document.getElementById('like-count');
                const currentCount = parseInt(likeCount.textContent);
                likeCount.textContent = currentCount + 1;
                
                showNotification('Thank you for liking this article!', 'success');
            } catch (error) {
                console.error('Error liking article:', error);
                showNotification('Failed to like article. Please try again.', 'error');
            }
        }

        // Bookmark Article Function
        async function bookmarkArticle() {
            try {
                // Simulate API call (replace with actual endpoint)
                showNotification('Article bookmarked successfully!', 'success');
            } catch (error) {
                console.error('Error bookmarking article:', error);
                showNotification('Failed to bookmark article. Please try again.', 'error');
            }
        }

        // Login Modal Functions
        function showLoginPrompt() {
            document.getElementById('loginModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function hideLoginModal() {
            document.getElementById('loginModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Comment Form Enhancement
        document.getElementById('commentForm')?.addEventListener('submit', function(e) {
            @guest
                e.preventDefault();
                showLoginPrompt();
                return false;
            @endguest
            
            // Show loading state
            const submitButton = this.querySelector('button[type="submit"]');
            const originalText = submitButton.innerHTML;
            submitButton.innerHTML = '<i class="bx bx-loader-alt animate-spin mr-2"></i>Submitting...';
            submitButton.disabled = true;
            
            // Re-enable after submission (form will redirect)
            setTimeout(() => {
                submitButton.innerHTML = originalText;
                submitButton.disabled = false;
            }, 3000);
        });

        // Notification Function
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 transform transition-all duration-300 ${
                type === 'success' ? 'bg-green-500 text-white' : 
                type === 'error' ? 'bg-red-500 text-white' : 
                'bg-blue-500 text-white'
            }`;
            notification.textContent = message;
            
            document.body.appendChild(notification);
            
            // Slide in animation
            setTimeout(() => {
                notification.style.transform = 'translateX(0)';
            }, 100);
            
            // Remove after 5 seconds
            setTimeout(() => {
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.parentNode.removeChild(notification);
                    }
                }, 300);
            }, 5000);
        }

        // Close modal when clicking outside
        document.getElementById('loginModal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideLoginModal();
            }
        });

        // Escape key to close modal
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                hideLoginModal();
            }
        });

        // Initialize everything when page loads
        document.addEventListener('DOMContentLoaded', function() {
            generateTOC();
            updateReadingProgress();
            
            // Update reading progress on scroll
            window.addEventListener('scroll', updateReadingProgress);
            
            // Initialize intersection observer for animations
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-fade-in');
                    }
                });
            }, {
                threshold: 0.1
            });

            // Observe elements for animations
            document.querySelectorAll('.related-blog-card, .comment-card').forEach(el => {
                observer.observe(el);
            });
        });

        // Newsletter subscription
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[type="email"]').value;
            
            if (email) {
                showNotification('Thank you for subscribing to our newsletter!', 'success');
                this.reset();
            }
        });
    </script>
@endsection