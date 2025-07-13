@extends('layouts.user')

@section('head')
    <style>
        /* Enhanced search animations */
        .search-container {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        }
        
        .search-input:focus {
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
        }
        
        /* Blog card hover effects */
        .blog-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .blog-card:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        /* Reading time badges */
        .reading-time {
            background: linear-gradient(45deg, #059669, #10b981);
        }
        
        .featured-badge {
            background: linear-gradient(45deg, #f59e0b, #d97706);
            animation: featuredPulse 2s ease-in-out infinite;
        }
        
        @keyframes featuredPulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }
        
        /* Author avatar hover */
        .author-avatar {
            transition: all 0.3s ease;
        }
        
        .blog-card:hover .author-avatar {
            transform: scale(1.1);
        }
        
        /* View switcher animations */
        .view-switcher button {
            transition: all 0.2s ease-in-out;
        }
        
        .view-switcher button.active {
            transform: scale(1.05);
        }
        
        /* Blog image overlay effects */
        .blog-image-overlay {
            background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
        }
        
        /* Bookmark floating animation */
        .bookmark-float {
            animation: bookmarkFloat 3s ease-in-out infinite;
        }
        
        @keyframes bookmarkFloat {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-10px) rotate(5deg); }
        }
        
        /* Text gradient effect */
        .text-gradient {
            background: linear-gradient(45deg, #f59e0b, #ef4444);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
@endsection

@section('content')
    <x-user.bread-crumb :data="['Home', 'Blogs', 'List']"/>
    
    <!-- Enhanced Hero Search Section -->
    <div class="search-container relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-20"></div>
        <!-- Floating reading icons animation -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-20 left-10 text-white opacity-20 bookmark-float">📚</div>
            <div class="absolute top-32 right-20 text-white opacity-20 animate-pulse">✍️</div>
            <div class="absolute bottom-20 left-20 text-white opacity-20 bookmark-float delay-1000">📖</div>
            <div class="absolute bottom-32 right-10 text-white opacity-20 animate-pulse delay-500">💡</div>
        </div>
        
        <div class="relative z-10 container mx-auto px-4 py-16 lg:py-20 bg-transparent">
            <div class="text-center mb-8">
                <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold text-white mb-4 leading-tight">
                    Discover Amazing <span class="text-yellow-300">Stories</span>
                </h1>
                <p class="text-lg md:text-xl text-white opacity-90 max-w-2xl mx-auto">
                    Explore inspiring articles, insights, and stories from thought leaders and creators
                </p>
                
                <!-- Blog Stats -->
                <div class="flex justify-center gap-8 mt-6 text-white">
                    <div class="text-center">
                        <div class="text-2xl font-bold">{{ $blogs->total() }}+</div>
                        <div class="text-sm opacity-75">Articles</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold">50+</div>
                        <div class="text-sm opacity-75">Categories</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold">Daily</div>
                        <div class="text-sm opacity-75">New Posts</div>
                    </div>
                </div>
            </div>
            
            <!-- Enhanced Search Form -->
            <div class="max-w-4xl mx-auto relative">
                <form action="{{ route('blogs') }}" method="GET" class="bg-white rounded-2xl shadow-2xl p-2">
                    <div class="flex flex-col md:flex-row gap-2">
                        <div class="flex-1 relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class='bx bx-search text-gray-400 text-xl'></i>
                            </div>
                            <input 
                                id="searchInput" 
                                name="q" 
                                type="text" 
                                value="{{ request('q') }}"
                                placeholder="Search articles, topics, or authors..." 
                                autocomplete="off"
                                class="search-input w-full pl-12 pr-4 py-4 text-lg border-0 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 transition-all duration-300"
                            >
                            
                            <!-- Enhanced Search Results Dropdown -->
                            <div id="searchResults" class="search-results absolute top-full left-0 right-0 bg-white mt-1 rounded-lg shadow-lg border max-h-80 overflow-y-auto z-50 hidden">
                                <div id="searchResultsContent"></div>
                                <div id="searchLoading" class="hidden p-4 text-center">
                                    <div class="inline-block animate-spin rounded-full h-6 w-6 border-b-2 border-amber-600"></div>
                                    <span class="ml-2 text-gray-600">Searching articles...</span>
                                </div>
                            </div>
                        </div>
                        
                        <button 
                            type="submit" 
                            class="bg-amber-600 hover:bg-amber-700 text-white px-8 py-4 rounded-xl font-semibold text-lg transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2"
                        >
                            <span class="hidden md:inline">Search Articles</span>
                            <i class='bx bx-search md:hidden text-xl'></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Enhanced Filters Section -->
    <div class="bg-gray-50 border-b">
        <div class="container mx-auto px-4 py-6">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-4">
                <!-- Filter Controls -->
                <div class="flex flex-wrap items-center gap-4">
                    <!-- Category Filter -->
                    <div class="flex items-center gap-2">
                        <label for="blog-category-filter" class="text-gray-700 font-medium whitespace-nowrap">
                            <i class='bx bx-filter-alt text-lg'></i>
                            <span class="hidden md:inline ml-1">Category:</span>
                        </label>
                        <select 
                            name="category" 
                            id="blog-category-filter" 
                            class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 bg-white min-w-32"
                            onchange="applyFilters()"
                        >
                            <option value="all">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->name }}" {{ request('category') == $category->name ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sort Filter -->
                    <div class="flex items-center gap-2">
                        <label for="blog-sort" class="text-gray-700 font-medium whitespace-nowrap">
                            <i class='bx bx-sort text-lg'></i>
                            <span class="hidden md:inline ml-1">Sort by:</span>
                        </label>
                        <select 
                            name="sort" 
                            id="blog-sort" 
                            class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 bg-white min-w-32"
                            onchange="applyFilters()"
                        >
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                            <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Popular</option>
                            <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Title A-Z</option>
                        </select>
                    </div>
                    
                    <!-- Clear Filters -->
                    @if(request('category') || request('sort') || request('q'))
                        <button 
                            onclick="clearFilters()" 
                            class="text-sm text-amber-600 hover:text-amber-800 font-medium flex items-center gap-1 transition-colors"
                        >
                            <i class='bx bx-x text-lg'></i>
                            Clear Filters
                        </button>
                    @endif
                </div>

                <!-- View Switcher & Results Info -->
                <div class="flex items-center gap-6">
                    <!-- Results Info -->
                    <div class="text-gray-600 text-sm">
                        <span class="hidden sm:inline">
                            Showing {{ $blogs->firstItem() ?: 0 }} - {{ $blogs->lastItem() ?: 0 }} of {{ $blogs->total() }} articles
                        </span>
                        <span class="sm:hidden">
                            {{ $blogs->total() }} articles found
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Blogs Container -->
    <div class="container mx-auto px-4 py-8">
        @if($blogs->count() > 0)
            <!-- Grid View -->
            <div id="gridView" class="blogs-container grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 md:gap-8">
                @foreach($blogs as $blog)
                    <div class="blog-card bg-white rounded-xl shadow-md hover:shadow-xl border border-gray-100 overflow-hidden group h-full flex flex-col transition-all duration-300 hover:-translate-y-2 relative">
                        <!-- Featured Badge -->
                        @if(isset($blog->is_featured) && $blog->is_featured)
                            <div class="featured-badge absolute top-3 left-3 z-10 px-3 py-1 rounded-full">
                                <p class="text-white text-xs font-bold">⭐ Featured</p>
                            </div>
                        @endif

                        <!-- Blog Image -->
                        <div class="relative bg-gray-50 h-56 overflow-hidden">
                            <a href="{{ route('view.blog', [$blog->slug]) }}">
                                <img 
                                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110" 
                                    src="{{ $blog->thumbnail ? url('storage/' . $blog->thumbnail) : asset('images/default-blog.png') }}"
                                    alt="{{ $blog->title }}"
                                    loading="lazy"
                                    onerror="this.src='{{ asset('images/default-blog.png') }}'"
                                >
                            </a>
                            
                            <!-- Reading Time Overlay -->
                            <div class="reading-time absolute bottom-3 right-3 px-2 py-1 rounded-lg text-white text-xs font-medium">
                                {{ str_word_count(strip_tags($blog->content ?? $blog->summary ?? '')) > 0 ? ceil(str_word_count(strip_tags($blog->content ?? $blog->summary ?? '')) / 200) : 1 }} min read
                            </div>
                            
                            <!-- Category Overlay -->
                            @if(isset($blog->category))
                                <div class="absolute top-3 right-3">
                                    <span class="bg-white bg-opacity-90 text-gray-700 px-2 py-1 rounded-full text-xs font-medium">
                                        {{ $blog->category->name }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        <!-- Blog Information -->
                        <div class="flex-1 p-6 flex flex-col">
                            <div class="flex-1">
                                <!-- Blog Title -->
                                <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-amber-600 transition-colors">
                                    <a href="{{ route('view.blog', [$blog->slug]) }}">
                                        {{ $blog->title }}
                                    </a>
                                </h3>
                                
                                <!-- Blog Summary -->
                                <p class="text-gray-600 mb-4 line-clamp-3 text-sm leading-relaxed">
                                    {!! Str::limit(strip_tags($blog->summary), 120) !!}
                                </p>

                                <!-- Author & Date -->
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center">
                                        <div class="author-avatar w-8 h-8 bg-amber-100 rounded-full flex items-center justify-center">
                                            <span class="text-amber-600 font-bold text-sm">
                                                {{ substr($blog->author ?? 'Admin', 0, 1) }}
                                            </span>
                                        </div>
                                        <div class="ml-2">
                                            <div class="text-sm font-medium text-gray-900">{{ $blog->author ?? 'Admin' }}</div>
                                            <div class="text-xs text-gray-600">{{ $blog->created_at->format('M d, Y') }}</div>
                                        </div>
                                    </div>
                                    
                                    <!-- Blog Stats -->
                                    <div class="flex items-center text-xs text-gray-500">
                                        <i class='bx bx-show mr-1'></i>
                                        <span>{{ $blog->views ?? 0 }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Button -->
                            <div class="mt-auto">
                                <a 
                                    href="{{ route('view.blog', [$blog->slug]) }}" 
                                    class="block w-full text-center px-4 py-3 bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-700 hover:to-amber-800 text-white font-semibold rounded-lg transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-amber-500"
                                >
                                    <i class='bx bx-book-open mr-2'></i>
                                    Read Article
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Enhanced Pagination -->
            <div class="mt-12">
                {{ $blogs->appends(request()->query())->links() }}
            </div>
        @else
            <!-- Enhanced Empty State -->
            <div class="text-center py-16">
                <div class="max-w-md mx-auto">
                    <div class="mb-6">
                        <i class='bx bx-book-open text-6xl text-gray-300'></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">No Articles Found</h3>
                    <p class="text-gray-600 mb-6">
                        We couldn't find any articles matching your criteria. Try adjusting your search or filters.
                    </p>
                    <button 
                        onclick="clearFilters()" 
                        class="inline-flex items-center px-6 py-3 bg-amber-600 hover:bg-amber-700 text-white font-semibold rounded-lg transition-colors"
                    >
                        <i class='bx bx-refresh mr-2'></i>
                        Clear All Filters
                    </button>
                </div>
            </div>
        @endif
    </div>

    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="fixed inset-0 bg-white bg-opacity-75 flex items-center justify-center z-50 hidden">
        <div class="text-center">
            <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-amber-600 mb-4"></div>
            <p class="text-gray-600 font-medium">Loading articles...</p>
        </div>
    </div>

    <x-related-keywords :seo="$seo" :route="'blogs'"/>
@endsection

@section('page-scripts')
    <script>
        // Load saved view preference
        document.addEventListener('DOMContentLoaded', function() {
            const savedView = localStorage.getItem('blogViewPreference') || 'grid';
            switchView(savedView);
        });

        // Enhanced filter functionality with loading states
        function applyFilters() {
            showLoading();
            
            const categoryValue = document.getElementById('blog-category-filter').value;
            const sortValue = document.getElementById('blog-sort').value;
            const searchValue = document.getElementById('searchInput').value;
            
            let url = '{{ route('blogs') }}';
            let params = [];

            if (categoryValue !== 'all') {
                params.push('category=' + encodeURIComponent(categoryValue));
            }

            if (sortValue && sortValue !== 'newest') {
                params.push('sort=' + encodeURIComponent(sortValue));
            }
            
            if (searchValue.trim()) {
                params.push('q=' + encodeURIComponent(searchValue.trim()));
            }

            if (params.length > 0) {
                url += '?' + params.join('&');
            }

            window.location.href = url;
        }

        function clearFilters() {
            showLoading();
            window.location.href = '{{ route('blogs') }}';
        }

        function showLoading() {
            document.getElementById('loadingOverlay').classList.remove('hidden');
        }

        // Enhanced search functionality with debouncing and error handling
        let searchTimeout;
        const searchInput = document.getElementById('searchInput');
        const searchResults = document.getElementById('searchResults');
        const searchResultsContent = document.getElementById('searchResultsContent');
        const searchLoading = document.getElementById('searchLoading');

        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            const inputValue = this.value.trim();

            if (inputValue.length >= 2) {
                searchTimeout = setTimeout(() => performSearch(inputValue), 300);
            } else {
                hideSearchResults();
            }
        });

        // Hide search results when clicking outside
        document.addEventListener('click', function(event) {
            if (!searchInput.contains(event.target) && !searchResults.contains(event.target)) {
                hideSearchResults();
            }
        });

        async function performSearch(query) {
            try {
                showSearchLoading();
                
                const searchURL = "{{ route('api.search.blogs', ['search' => '__input__']) }}".replace('__input__', encodeURIComponent(query));
                
                const response = await fetch(searchURL);
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                const data = await response.json();
                displaySearchResults(data);
                
            } catch (error) {
                console.error('Search error:', error);
                displaySearchError();
            } finally {
                hideSearchLoading();
            }
        }

        function showSearchLoading() {
            searchLoading.classList.remove('hidden');
            searchResults.classList.remove('hidden');
        }

        function hideSearchLoading() {
            searchLoading.classList.add('hidden');
        }

        function displaySearchResults(results) {
            searchResultsContent.innerHTML = '';

            if (results.length === 0) {
                searchResultsContent.innerHTML = `
                    <div class="p-4 text-center text-gray-500">
                        <i class='bx bx-book-open text-2xl mb-2'></i>
                        <p>No articles found</p>
                    </div>
                `;
            } else {
                results.forEach((result, index) => {
                    const resultElement = document.createElement('a');
                    resultElement.href = "{{ route('blogs', ['q' => '__slug__']) }}".replace('__slug__', encodeURIComponent(result));
                    resultElement.className = 'block px-4 py-3 hover:bg-gray-50 transition-colors border-b border-gray-100 last:border-b-0';
                    resultElement.innerHTML = `
                        <div class="flex items-center">
                            <i class='bx bx-book-open text-gray-400 mr-3'></i>
                            <span class="text-gray-900">${escapeHtml(result)}</span>
                            <span class="ml-auto text-xs text-amber-600 font-medium">📖 Article</span>
                        </div>
                    `;
                    searchResultsContent.appendChild(resultElement);
                });
            }

            searchResults.classList.remove('hidden');
        }

        function displaySearchError() {
            searchResultsContent.innerHTML = `
                <div class="p-4 text-center text-red-500">
                    <i class='bx bx-error text-2xl mb-2'></i>
                    <p>Search temporarily unavailable</p>
                </div>
            `;
            searchResults.classList.remove('hidden');
        }

        function hideSearchResults() {
            searchResults.classList.add('hidden');
        }

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        // Form submission with validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const searchValue = searchInput.value.trim();
            if (searchValue.length > 0 && searchValue.length < 2) {
                e.preventDefault();
                alert('Please enter at least 2 characters to search');
                return false;
            }
            showLoading();
        });

        // Performance optimization: Intersection Observer for lazy loading
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src || img.src;
                        img.classList.remove('skeleton');
                        observer.unobserve(img);
                    }
                });
            });

            document.querySelectorAll('img[loading="lazy"]').forEach(img => {
                imageObserver.observe(img);
            });
        }

        // Reading progress tracking
        let readingProgress = {};

        document.querySelectorAll('a[href*="view.blog"]').forEach(link => {
            link.addEventListener('click', function() {
                const blogTitle = this.closest('.blog-card').querySelector('h3').textContent.trim();
                
                // Track blog clicks for analytics
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'blog_click', {
                        event_category: 'content',
                        event_label: blogTitle,
                        value: 1
                    });
                }
                
                // Save to reading history (localStorage)
                let readingHistory = JSON.parse(localStorage.getItem('blogReadingHistory') || '[]');
                readingHistory.unshift({
                    title: blogTitle,
                    url: this.href,
                    timestamp: new Date().toISOString()
                });
                
                // Keep only last 10 articles
                readingHistory = readingHistory.slice(0, 10);
                localStorage.setItem('blogReadingHistory', JSON.stringify(readingHistory));
            });
        });

        // Blog recommendation system (simple)
        function recommendBlogs() {
            const readingHistory = JSON.parse(localStorage.getItem('blogReadingHistory') || '[]');
            if (readingHistory.length > 0) {
                // Show reading history or recommendations
                console.log('Recent reading history:', readingHistory);
            }
        }

        // Initialize recommendations
        document.addEventListener('DOMContentLoaded', recommendBlogs);
    </script>
@endsection