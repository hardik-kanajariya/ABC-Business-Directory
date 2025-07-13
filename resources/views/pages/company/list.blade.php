@extends('layouts.user')

@section('head')
    <style>
        /* Enhanced search animations */
        .search-container {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .search-input:focus {
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }
        
        /* Card hover effects */
        .company-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .company-card:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        /* Loading skeleton */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }
        
        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
        
        /* Custom scrollbar for search results */
        .search-results::-webkit-scrollbar {
            width: 6px;
        }
        
        .search-results::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }
        
        .search-results::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }
        
        .search-results::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
    </style>
@endsection

@section('content')
    <x-user.bread-crumb :data="['Home', 'Company', 'List']"/>
    
    <!-- Enhanced Hero Search Section -->
    <div class="search-container relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-20"></div>
        <div class="relative z-10 container mx-auto px-4 py-16 lg:py-20 bg-transparent">
            <div class="text-center mb-8">
                <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold text-white mb-4 leading-tight">
                    Discover Amazing <span class="text-yellow-300">Companies</span>
                </h1>
                <p class="text-lg md:text-xl text-white opacity-90 max-w-2xl mx-auto">
                    Connect with thousands of businesses and unlock new opportunities
                </p>
            </div>
            
            <!-- Enhanced Search Form -->
            <div class="max-w-4xl mx-auto relative">
                <form action="{{ route('company') }}" method="GET" class="bg-white rounded-2xl shadow-2xl p-2">
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
                                placeholder="Search companies, services, or locations..." 
                                autocomplete="off"
                                class="search-input w-full pl-12 pr-4 py-4 text-lg border-0 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-300"
                            >
                            
                            <!-- Enhanced Search Results Dropdown -->
                            <div id="searchResults" class="search-results absolute top-full left-0 right-0 bg-white mt-1 rounded-lg shadow-lg border max-h-80 overflow-y-auto z-50 hidden">
                                <div id="searchResultsContent"></div>
                                <div id="searchLoading" class="hidden p-4 text-center">
                                    <div class="inline-block animate-spin rounded-full h-6 w-6 border-b-2 border-indigo-600"></div>
                                    <span class="ml-2 text-gray-600">Searching...</span>
                                </div>
                            </div>
                        </div>
                        
                        <button 
                            type="submit" 
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-xl font-semibold text-lg transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        >
                            <span class="hidden md:inline">Search Now</span>
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
                        <label for="company-category-filter" class="text-gray-700 font-medium whitespace-nowrap">
                            <i class='bx bx-filter-alt text-lg'></i>
                            <span class="hidden md:inline ml-1">Category:</span>
                        </label>
                        <select 
                            name="category" 
                            id="company-category-filter" 
                            class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white min-w-32"
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
                        <label for="company-sort-by" class="text-gray-700 font-medium whitespace-nowrap">
                            <i class='bx bx-sort text-lg'></i>
                            <span class="hidden md:inline ml-1">Sort by:</span>
                        </label>
                        <select 
                            name="sort" 
                            id="company-sort-by" 
                            class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white min-w-32"
                            onchange="applyFilters()"
                        >
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name A-Z</option>
                            <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Rating: Low to High</option>
                            <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Rating: High to Low</option>
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                        </select>
                    </div>
                    
                    <!-- Clear Filters -->
                    @if(request('category') || request('sort') || request('q'))
                        <button 
                            onclick="clearFilters()" 
                            class="text-sm text-indigo-600 hover:text-indigo-800 font-medium flex items-center gap-1 transition-colors"
                        >
                            <i class='bx bx-x text-lg'></i>
                            Clear Filters
                        </button>
                    @endif
                </div>

                <!-- Results Info -->
                <div class="text-gray-600 text-sm">
                    <span class="hidden sm:inline">
                        Showing {{ $companies->firstItem() ?: 0 }} - {{ $companies->lastItem() ?: 0 }} of {{ $companies->total() }} results
                    </span>
                    <span class="sm:hidden">
                        {{ $companies->total() }} companies found
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Companies Grid -->
    <div class="container mx-auto px-4 py-8">
        @if($companies->count() > 0)
<div class="space-y-6">
    @foreach($companies as $company)
        <div class="company-card bg-white rounded-xl shadow-md hover:shadow-xl border border-gray-100 overflow-hidden group transition-all duration-300 hover:-translate-y-1">
            <div class="flex flex-col md:flex-row">
                <!-- Left: Logo & Quick Info -->
                <div class="md:w-80 bg-gradient-to-br from-gray-50 to-gray-100 p-6 flex flex-col items-center justify-center relative">
                    <div class="w-24 h-24 mb-4 relative">
                        <img 
                            class="w-full h-full object-contain transition-transform duration-300 group-hover:scale-110" 
                            src="{{ $company->logo ? url('storage/' . $company->logo) : asset('images/default-company.png') }}"
                            alt="{{ $company->name }} logo"
                            loading="lazy"
                            onerror="this.src='{{ asset('images/default-company.png') }}'"
                        >
                    </div>
                    
                    @if($company->is_featured)
                        <div class="absolute top-3 left-3">
                            <span class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-md">
                                ⭐ Featured
                            </span>
                        </div>
                    @endif

                    <!-- Quick Stats -->
                    <div class="text-center space-y-2">
                        @php
                            $rating = \App\classes\HelperFunctions::getRatingAverage('company', $company->id);
                            $reviewCount = \App\classes\HelperFunctions::getRatingCount('company', $company->id);
                        @endphp
                        <div class="flex justify-center text-yellow-400">
                            @for($i = 1; $i <= 5; $i++)
                                <i class='bx {{ $i <= $rating ? 'bxs-star' : 'bx-star' }}'></i>
                            @endfor
                        </div>
                        <div class="text-sm">
                            <span class="font-bold text-gray-800">{{ number_format($rating, 1) }}</span>
                            <span class="text-gray-600">({{ $reviewCount }})</span>
                        </div>
                    </div>
                </div>

                <!-- Right: Company Details -->
                <div class="flex-1 p-6">
                    <div class="grid md:grid-cols-3 gap-6 h-full">
                        <!-- Column 1: Basic Info -->
                        <div class="space-y-4">
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900 mb-2 group-hover:text-indigo-600 transition-colors">
                                    {{ $company->name }}
                                </h3>
                                <div class="flex items-center text-gray-600 text-sm">
                                    <i class='bx bx-map-pin text-red-500 mr-2'></i>
                                    <span>{{ $company->address->state->name ?? 'N/A' }}, {{ $company->address->country->name ?? 'N/A' }}</span>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class='bx bx-time text-green-500 mr-2'></i>
                                    <span>Est. {{ $company->created_at->format('Y') }}</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class='bx bx-user text-blue-500 mr-2'></i>
                                    <span>{{ $reviewCount }} {{ Str::plural('review', $reviewCount) }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Column 2: Services -->
                        <div>
                            <h4 class="font-semibold text-gray-700 mb-3 flex items-center">
                                <i class='bx bx-briefcase text-indigo-500 mr-2'></i>
                                Services Offered
                            </h4>
                            <div class="space-y-2">
                                @forelse($company->extra_things as $index => $item)
                                    @if($index < 4)
                                        <div class="flex items-center text-sm">
                                            <div class="w-2 h-2 bg-indigo-400 rounded-full mr-2"></div>
                                            <span class="text-gray-700">{{ Str::limit($item, 30) }}</span>
                                        </div>
                                    @elseif($index === 4)
                                        <div class="text-sm text-gray-500 italic">
                                            +{{ count($company->extra_things) - 4 }} more services
                                        </div>
                                        @break
                                    @endif
                                @empty
                                    <span class="text-gray-500 text-sm italic">No services listed</span>
                                @endforelse
                            </div>
                        </div>

                        <!-- Column 3: Actions & Contact -->
                        <div class="flex flex-col justify-between">
                            <div class="space-y-3">
                                <a 
                                    href="{{ route('view.company', [$company->slug]) }}" 
                                    class="block w-full text-center px-4 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold rounded-lg transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                >
                                    <i class='bx bx-user mr-2'></i>
                                    View Full Profile
                                </a>
                                
                                <div class="grid grid-cols-2 gap-2">
                                    <button class="px-3 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors text-sm font-medium">
                                        <i class='bx bx-phone mr-1'></i>
                                        Contact
                                    </button>
                                    <button class="px-3 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors text-sm font-medium">
                                        <i class='bx bx-bookmark mr-1'></i>
                                        Save
                                    </button>
                                </div>
                            </div>

                            <!-- Additional Info -->
                            <div class="mt-4 p-3 bg-gray-50 rounded-lg">
                                <div class="flex justify-between text-xs text-gray-600">
                                    <span>Verified Business</span>
                                    <i class='bx bx-check-circle text-green-500'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

            <!-- Enhanced Pagination -->
            <div class="mt-12">
                {{ $companies->appends(request()->query())->links() }}
            </div>
        @else
            <!-- Enhanced Empty State -->
            <div class="text-center py-16">
                <div class="max-w-md mx-auto">
                    <div class="mb-6">
                        <i class='bx bx-search-alt-2 text-6xl text-gray-300'></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">No Companies Found</h3>
                    <p class="text-gray-600 mb-6">
                        We couldn't find any companies matching your criteria. Try adjusting your search or filters.
                    </p>
                    <button 
                        onclick="clearFilters()" 
                        class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition-colors"
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
            <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-indigo-600 mb-4"></div>
            <p class="text-gray-600 font-medium">Loading companies...</p>
        </div>
    </div>

    <x-related-keywords :seo="$seo" :route="'company'"/>
@endsection

@section('page-scripts')
    <script>
        // Enhanced filter functionality with loading states
        function applyFilters() {
            showLoading();
            
            const categoryValue = document.getElementById('company-category-filter').value;
            const sortValue = document.getElementById('company-sort-by').value;
            const searchValue = document.getElementById('searchInput').value;
            
            let url = '{{ route('company') }}';
            let params = [];

            if (categoryValue !== 'all') {
                params.push('category=' + encodeURIComponent(categoryValue));
            }

            if (sortValue && sortValue !== 'default') {
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
            window.location.href = '{{ route('company') }}';
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
                
                const searchURL = "{{ route('api.search.company', ['search' => '__input__']) }}".replace('__input__', encodeURIComponent(query));
                
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
                        <i class='bx bx-search-alt-2 text-2xl mb-2'></i>
                        <p>No companies found</p>
                    </div>
                `;
            } else {
                results.forEach((result, index) => {
                    const resultElement = document.createElement('a');
                    resultElement.href = "{{ route('company', ['q' => '__slug__']) }}".replace('__slug__', encodeURIComponent(result));
                    resultElement.className = 'block px-4 py-3 hover:bg-gray-50 transition-colors border-b border-gray-100 last:border-b-0';
                    resultElement.innerHTML = `
                        <div class="flex items-center">
                            <i class='bx bx-building text-gray-400 mr-3'></i>
                            <span class="text-gray-900">${escapeHtml(result)}</span>
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

        // Keyboard navigation for search results
        searchInput.addEventListener('keydown', function(e) {
            const results = searchResultsContent.querySelectorAll('a');
            let selectedIndex = -1;
            
            // Find currently selected result
            results.forEach((result, index) => {
                if (result.classList.contains('bg-gray-100')) {
                    selectedIndex = index;
                }
            });

            if (e.key === 'ArrowDown') {
                e.preventDefault();
                selectedIndex = Math.min(selectedIndex + 1, results.length - 1);
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                selectedIndex = Math.max(selectedIndex - 1, -1);
            } else if (e.key === 'Enter' && selectedIndex >= 0) {
                e.preventDefault();
                results[selectedIndex].click();
                return;
            } else if (e.key === 'Escape') {
                hideSearchResults();
                return;
            }

            // Update selection
            results.forEach((result, index) => {
                if (index === selectedIndex) {
                    result.classList.add('bg-gray-100');
                } else {
                    result.classList.remove('bg-gray-100');
                }
            });
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
                img.classList.add('skeleton');
                imageObserver.observe(img);
            });
        }
    </script>
@endsection