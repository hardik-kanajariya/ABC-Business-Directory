@php use App\classes\HelperFunctions; @endphp
@extends('layouts.user')

@section('head')
    <style>
        /* Enhanced search animations */
        .search-container {
            background: linear-gradient(135deg, #7c3aed 0%, #5b21b6 100%);
        }
        
        .search-input:focus {
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
        }
        
        /* Forum card hover effects */
        .forum-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .forum-card:hover {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            transform: translateY(-2px);
        }
        
        /* Status badges */
        .status-solved {
            background: linear-gradient(45deg, #10b981, #059669);
        }
        
        .status-hot {
            background: linear-gradient(45deg, #ef4444, #dc2626);
            animation: hotPulse 2s ease-in-out infinite;
        }
        
        .status-new {
            background: linear-gradient(45deg, #3b82f6, #2563eb);
        }
        
        .status-locked {
            background: linear-gradient(45deg, #6b7280, #4b5563);
        }
        
        @keyframes hotPulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }
        
        /* Activity indicators */
        .activity-high {
            background: linear-gradient(45deg, #f59e0b, #d97706);
        }
        
        .activity-medium {
            background: linear-gradient(45deg, #10b981, #059669);
        }
        
        .activity-low {
            background: linear-gradient(45deg, #6b7280, #4b5563);
        }
        
        /* Avatar hover effects */
        .forum-avatar {
            transition: all 0.3s ease;
        }
        
        .forum-card:hover .forum-avatar {
            transform: scale(1.1);
        }
        
        /* Forum floating animation */
        .forum-float {
            animation: forumFloat 3s ease-in-out infinite;
        }
        
        @keyframes forumFloat {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-10px) rotate(3deg); }
        }
        
        /* Unread indicator */
        .unread-indicator {
            width: 8px;
            height: 8px;
            background: #3b82f6;
            border-radius: 50%;
            animation: unreadPulse 2s ease-in-out infinite;
        }
        
        @keyframes unreadPulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(1.2); }
        }
    </style>
@endsection

@section('content')
    <x-user.bread-crumb :data="['Home', 'Forums', 'List']"/>
    
    <!-- Enhanced Hero Search Section -->
    <div class="search-container relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-20"></div>
        <!-- Floating forum icons animation -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-20 left-10 text-white opacity-20 forum-float">💬</div>
            <div class="absolute top-32 right-20 text-white opacity-20 animate-pulse">🗣️</div>
            <div class="absolute bottom-20 left-20 text-white opacity-20 forum-float delay-1000">💭</div>
            <div class="absolute bottom-32 right-10 text-white opacity-20 animate-pulse delay-500">🔍</div>
        </div>
        
        <div class="relative z-10 container mx-auto px-4 py-16 lg:py-20 bg-transparent">
            <div class="text-center mb-8">
                <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold text-white mb-4 leading-tight">
                    Join the <span class="text-yellow-300">Discussion</span>
                </h1>
                <p class="text-lg md:text-xl text-white opacity-90 max-w-2xl mx-auto">
                    Connect with community members, share knowledge, and get answers to your questions
                </p>
                
                <!-- Forum Stats -->
                <div class="flex justify-center gap-8 mt-6 text-white">
                    <div class="text-center">
                        <div class="text-2xl font-bold">{{ $forums->total() }}+</div>
                        <div class="text-sm opacity-75">Discussions</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold">
                            {{ $forums->sum(function($forum) { return $forum->countAnswers(); }) }}+
                        </div>
                        <div class="text-sm opacity-75">Answers</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold">24/7</div>
                        <div class="text-sm opacity-75">Active Community</div>
                    </div>
                </div>
            </div>
            
            <!-- Enhanced Search Form -->
            <div class="max-w-4xl mx-auto relative">
                <form action="{{ route('forum') }}" method="GET" class="bg-white rounded-2xl shadow-2xl p-2">
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
                                placeholder="Search discussions, topics, or keywords..." 
                                autocomplete="off"
                                class="search-input w-full pl-12 pr-4 py-4 text-lg border-0 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition-all duration-300"
                            >
                            
                            <!-- Enhanced Search Results Dropdown -->
                            <div id="searchResults" class="search-results absolute top-full left-0 right-0 bg-white mt-1 rounded-lg shadow-lg border max-h-80 overflow-y-auto z-50 hidden">
                                <div id="searchResultsContent"></div>
                                <div id="searchLoading" class="hidden p-4 text-center">
                                    <div class="inline-block animate-spin rounded-full h-6 w-6 border-b-2 border-purple-600"></div>
                                    <span class="ml-2 text-gray-600">Searching discussions...</span>
                                </div>
                            </div>
                        </div>
                        
                        <button 
                            type="submit" 
                            class="bg-purple-600 hover:bg-purple-700 text-white px-8 py-4 rounded-xl font-semibold text-lg transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2"
                        >
                            <span class="hidden md:inline">Search Forums</span>
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
                        <label for="forum-category-filter" class="text-gray-700 font-medium whitespace-nowrap">
                            <i class='bx bx-filter-alt text-lg'></i>
                            <span class="hidden md:inline ml-1">Category:</span>
                        </label>
                        <select 
                            name="category" 
                            id="forum-category-filter" 
                            class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 bg-white min-w-32"
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
                    
                    <!-- Clear Filters -->
                    @if(request('category') || request('country') || request('sort') || request('q'))
                        <button 
                            onclick="clearFilters()" 
                            class="text-sm text-purple-600 hover:text-purple-800 font-medium flex items-center gap-1 transition-colors"
                        >
                            <i class='bx bx-x text-lg'></i>
                            Clear Filters
                        </button>
                    @endif
                </div>

                <!-- Results Info & Actions -->
                <div class="flex items-center gap-6">
                    <!-- Results Info -->
                    <div class="text-gray-600 text-sm">
                        <span class="hidden sm:inline">
                            Showing {{ $forums->firstItem() ?: 0 }} - {{ $forums->lastItem() ?: 0 }} of {{ $forums->total() }} discussions
                        </span>
                        <span class="sm:hidden">
                            {{ $forums->total() }} discussions found
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Forums List View -->
    <div class="container mx-auto px-4 py-8">
        @if($forums->count() > 0)
            <div class="space-y-4">
                @foreach($forums as $forum)
                    @php
                        $answerCount = $forum->countAnswers();
                        $isHot = $answerCount > 10;
                        $isNew = $forum->created_at->isToday();
                        $isUnanswered = $answerCount == 0;
                        $activityLevel = $answerCount > 15 ? 'high' : ($answerCount > 5 ? 'medium' : 'low');
                    @endphp

                    <div class="forum-card bg-white rounded-xl shadow-md hover:shadow-xl border border-gray-100 overflow-hidden group transition-all duration-300">
                        <div class="p-6">
                            <!-- Forum Header -->
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-start space-x-4 flex-1">
                                    <!-- Avatar -->
                                    <div class="forum-avatar flex-shrink-0">
                                        <img 
                                            src="https://ui-avatars.com/api/?name={{ urlencode($forum->company->name) }}&background=7c3aed&color=fff&size=48" 
                                            alt="{{ $forum->company->name }}"
                                            class="w-12 h-12 rounded-full border-2 border-purple-100"
                                        >
                                    </div>

                                    <!-- Forum Info -->
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-2">
                                            <div class="flex items-center space-x-2">
                                                <h3 class="font-semibold text-gray-900 text-sm">{{ $forum->company->name }}</h3>
                                                
                                                <!-- Status Badges -->
                                                @if($isNew)
                                                    <span class="status-new px-2 py-1 rounded-full text-white text-xs font-bold">NEW</span>
                                                @endif
                                                
                                                @if($isHot)
                                                    <span class="status-hot px-2 py-1 rounded-full text-white text-xs font-bold">🔥 HOT</span>
                                                @endif
                                                
                                                @if($isUnanswered)
                                                    <span class="bg-orange-100 text-orange-800 px-2 py-1 rounded-full text-xs font-medium">Unanswered</span>
                                                @endif
                                            </div>
                                            
                                            <!-- Category & Date -->
                                            <div class="flex items-center space-x-4 text-xs text-gray-500">
                                                <span class="bg-purple-50 text-purple-700 px-2 py-1 rounded-full font-medium">
                                                    {{ $forum->category->name }}
                                                </span>
                                                <span>{{ $forum->created_at->format('M d, Y') }}</span>
                                            </div>
                                        </div>

                                        <!-- Forum Title -->
                                        <h2 class="text-lg font-bold text-gray-900 mb-3 group-hover:text-purple-600 transition-colors line-clamp-2">
                                            <a href="{{ route('view.forum', [$forum->id, \Illuminate\Support\Str::slug($forum->title)]) }}">
                                                {{ $forum->title }}
                                            </a>
                                        </h2>

                                        <!-- Forum Content Preview -->
                                        <div class="text-gray-600 text-sm leading-relaxed mb-4 line-clamp-3">
                                            {!! Str::limit(strip_tags($forum->body), 200) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Forum Footer -->
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <!-- Activity Stats -->
                                <div class="flex items-center space-x-6">
                                    <div class="flex items-center text-sm text-gray-600">
                                        <i class='bx bx-message-dots mr-2 text-purple-500'></i>
                                        <span class="font-medium">{{ $answerCount }}</span>
                                        <span class="ml-1">{{ Str::plural('answer', $answerCount) }}</span>
                                    </div>
                                    
                                    <div class="flex items-center text-sm text-gray-600">
                                        <i class='bx bx-show mr-2 text-blue-500'></i>
                                        <span>{{ $forum->views ?? 0 }} views</span>
                                    </div>
                                    
                                    <!-- Activity Level Indicator -->
                                    <div class="flex items-center">
                                        <span class="text-xs text-gray-500 mr-2">Activity:</span>
                                        <div class="activity-{{ $activityLevel }} w-3 h-3 rounded-full"></div>
                                    </div>
                                    
                                    <!-- Last Activity -->
                                    <div class="text-xs text-gray-500">
                                        <i class='bx bx-time mr-1'></i>
                                        Last activity {{ $forum->updated_at->diffForHumans() }}
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex items-center space-x-3">
                                    <!-- Quick Reply Button -->
                                    <button 
                                        onclick="quickReply('{{ $forum->id }}')"
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-purple-600 hover:text-purple-800 border border-purple-300 rounded-lg hover:bg-purple-50 transition-colors"
                                        title="Quick Reply"
                                    >
                                        <i class='bx bx-reply mr-1'></i>
                                        <span class="hidden md:inline">Quick Reply</span>
                                    </button>
                                    
                                    <!-- Join Discussion Button -->
                                    <a 
                                        href="{{ route('view.forum', [$forum->id, \Illuminate\Support\Str::slug($forum->title)]) }}" 
                                        class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-semibold rounded-lg transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-purple-500"
                                    >
                                        <i class='bx bx-conversation mr-2'></i>
                                        Join Discussion
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Unread Indicator -->
                        @if($isNew || $isUnanswered)
                            <div class="unread-indicator absolute top-4 left-4"></div>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Enhanced Pagination -->
            <div class="mt-12">
                {{ $forums->appends(request()->query())->links() }}
            </div>
        @else
            <!-- Enhanced Empty State -->
            <div class="text-center py-16">
                <div class="max-w-md mx-auto">
                    <div class="mb-6">
                        <i class='bx bx-conversation text-6xl text-gray-300'></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">No Discussions Found</h3>
                    <p class="text-gray-600 mb-6">
                        We couldn't find any discussions matching your criteria. Be the first to start a conversation!
                    </p>
                    <div class="space-y-3">
                        <a 
                            href="{{ route('forum.create') ?? '#' }}"
                            class="inline-flex items-center px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg transition-colors"
                        >
                            <i class='bx bx-plus mr-2'></i>
                            Start New Discussion
                        </a>
                        <button 
                            onclick="clearFilters()" 
                            class="block mx-auto text-purple-600 hover:text-purple-800 font-medium text-sm"
                        >
                            Clear All Filters
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Quick Reply Modal -->
    <div id="quickReplyModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-xl p-6 max-w-md w-full mx-4">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Quick Reply</h3>
            <textarea 
                id="quickReplyText"
                placeholder="Type your reply..."
                class="w-full border border-gray-300 rounded-lg p-3 h-32 focus:outline-none focus:ring-2 focus:ring-purple-500"
            ></textarea>
            <div class="flex justify-end space-x-3 mt-4">
                <button 
                    onclick="closeQuickReply()"
                    class="px-4 py-2 text-gray-600 hover:text-gray-800 font-medium"
                >
                    Cancel
                </button>
                <button 
                    onclick="submitQuickReply()"
                    class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg"
                >
                    Post Reply
                </button>
            </div>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="fixed inset-0 bg-white bg-opacity-75 flex items-center justify-center z-50 hidden">
        <div class="text-center">
            <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-purple-600 mb-4"></div>
            <p class="text-gray-600 font-medium">Loading discussions...</p>
        </div>
    </div>
@endsection

@section('page-scripts')
    <script>
        // Enhanced filter functionality with loading states
        function applyFilters() {
            showLoading();
            
            const categoryValue = document.getElementById('forum-category-filter').value;
            const countryValue = document.getElementById('forum-country').value;
            const sortValue = document.getElementById('forum-sort').value;
            const searchValue = document.getElementById('searchInput').value;
            
            let url = '{{ route('forum') }}';
            let params = [];

            if (categoryValue !== 'all') {
                params.push('category=' + encodeURIComponent(categoryValue));
            }

            if (countryValue && countryValue !== '') {
                params.push('country=' + encodeURIComponent(countryValue));
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
            window.location.href = '{{ route('forum') }}';
        }

        function showLoading() {
            document.getElementById('loadingOverlay').classList.remove('hidden');
        }

        // Quick Reply functionality
        let currentForumId = null;

        function quickReply(forumId) {
            currentForumId = forumId;
            document.getElementById('quickReplyModal').classList.remove('hidden');
            document.getElementById('quickReplyText').focus();
        }

        function closeQuickReply() {
            document.getElementById('quickReplyModal').classList.add('hidden');
            document.getElementById('quickReplyText').value = '';
            currentForumId = null;
        }

        function submitQuickReply() {
            const replyText = document.getElementById('quickReplyText').value.trim();
            
            if (!replyText) {
                alert('Please enter your reply');
                return;
            }

            if (!currentForumId) {
                alert('Error: Forum ID not found');
                return;
            }

            // For now, redirect to full forum page
            // In a real implementation, you'd submit via AJAX
            window.location.href = `{{ route('view.forum', ['', '']) }}`.replace(/\/+$/, '') + '/' + currentForumId + '/reply';
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
                
                const searchURL = "{{ route('api.search.forums', ['search' => '__input__']) }}".replace('__input__', encodeURIComponent(query));
                
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
                        <i class='bx bx-conversation text-2xl mb-2'></i>
                        <p>No discussions found</p>
                    </div>
                `;
            } else {
                results.forEach((result, index) => {
                    const resultElement = document.createElement('a');
                    resultElement.href = "{{ route('forum', ['q' => '__slug__']) }}".replace('__slug__', encodeURIComponent(result));
                    resultElement.className = 'block px-4 py-3 hover:bg-gray-50 transition-colors border-b border-gray-100 last:border-b-0';
                    resultElement.innerHTML = `
                        <div class="flex items-center">
                            <i class='bx bx-conversation text-gray-400 mr-3'></i>
                            <span class="text-gray-900">${escapeHtml(result)}</span>
                            <span class="ml-auto text-xs text-purple-600 font-medium">💬 Discussion</span>
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

        // Keyboard shortcuts
        document.addEventListener('keydown', function(event) {
            // Escape key to close quick reply modal
            if (event.key === 'Escape') {
                closeQuickReply();
            }
            
            // Ctrl/Cmd + Enter to submit quick reply
            if ((event.ctrlKey || event.metaKey) && event.key === 'Enter') {
                if (!document.getElementById('quickReplyModal').classList.contains('hidden')) {
                    submitQuickReply();
                }
            }
        });

        // Forum activity tracking
        document.querySelectorAll('a[href*="view.forum"]').forEach(link => {
            link.addEventListener('click', function() {
                // Track forum views for analytics
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'forum_view', {
                        event_category: 'engagement',
                        event_label: this.href,
                        value: 1
                    });
                }
            });
        });

        // Auto-refresh discussions every 2 minutes to show new activity
        setInterval(function() {
            if (document.visibilityState === 'visible') {
                // Optional: Check for new discussions and show notification
                console.log('Checking for new forum activity...');
            }
        }, 120000); // 2 minutes
    </script>
@endsection