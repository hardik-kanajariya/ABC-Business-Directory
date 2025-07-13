@extends('layouts.user')

@section('head')
    <style>
        /* Enhanced search animations */
        .search-container {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }
        
        .search-input:focus {
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }
        
        /* Card hover effects */
        .product-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .product-card:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        /* View switcher animations */
        .view-switcher button {
            transition: all 0.2s ease-in-out;
        }
        
        .view-switcher button.active {
            transform: scale(1.05);
        }
        
        /* Layout transitions */
        .products-container {
            transition: all 0.3s ease-in-out;
        }
    </style>
@endsection

@section('content')
    <x-user.bread-crumb :data="['Home', 'Products', 'List']"/>
    
    <!-- Enhanced Hero Search Section -->
    <div class="search-container relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-20"></div>
        <div class="relative z-10 container mx-auto px-4 py-16 lg:py-20 bg-transparent">
            <div class="text-center mb-8">
                <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold text-white mb-4 leading-tight">
                    Discover Amazing <span class="text-yellow-300">Products</span>
                </h1>
                <p class="text-lg md:text-xl text-white opacity-90 max-w-2xl mx-auto">
                    Browse thousands of quality products from trusted sellers
                </p>
            </div>
            
            <!-- Enhanced Search Form -->
            <div class="max-w-4xl mx-auto relative">
                <form action="{{ route('products') }}" method="GET" class="bg-white rounded-2xl shadow-2xl p-2">
                    <div class="flex flex-col md:flex-row gap-2">
                        <div class="flex-1 relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class='bx bx-search text-gray-400 text-xl'></i>
                            </div>
                            <input 
                                id="searchInput" 
                                name="search" 
                                type="text" 
                                value="{{ request('search') }}"
                                placeholder="Search products, brands, or categories..." 
                                autocomplete="off"
                                class="search-input w-full pl-12 pr-4 py-4 text-lg border-0 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 transition-all duration-300"
                            >
                            
                            <!-- Enhanced Search Results Dropdown -->
                            <div id="searchResults" class="search-results absolute top-full left-0 right-0 bg-white mt-1 rounded-lg shadow-lg border max-h-80 overflow-y-auto z-50 hidden">
                                <div id="searchResultsContent"></div>
                                <div id="searchLoading" class="hidden p-4 text-center">
                                    <div class="inline-block animate-spin rounded-full h-6 w-6 border-b-2 border-green-600"></div>
                                    <span class="ml-2 text-gray-600">Searching...</span>
                                </div>
                            </div>
                        </div>
                        
                        <button 
                            type="submit" 
                            class="bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded-xl font-semibold text-lg transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                        >
                            <span class="hidden md:inline">Find Products</span>
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
                        <label for="product-category-filter" class="text-gray-700 font-medium whitespace-nowrap">
                            <i class='bx bx-filter-alt text-lg'></i>
                            <span class="hidden md:inline ml-1">Category:</span>
                        </label>
                        <select 
                            name="category" 
                            id="product-category-filter" 
                            class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white min-w-32"
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
                        <label for="product-sort-by" class="text-gray-700 font-medium whitespace-nowrap">
                            <i class='bx bx-sort text-lg'></i>
                            <span class="hidden md:inline ml-1">Sort by:</span>
                        </label>
                        <select 
                            name="sort" 
                            id="product-sort-by" 
                            class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white min-w-32"
                            onchange="applyFilters()"
                        >
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name A-Z</option>
                            <option value="price-low-to-high" {{ request('sort') == 'price-low-to-high' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price-high-to-low" {{ request('sort') == 'price-high-to-low' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                        </select>
                    </div>
                    
                    <!-- Clear Filters -->
                    @if(request('category') || request('sort') || request('search'))
                        <button 
                            onclick="clearFilters()" 
                            class="text-sm text-green-600 hover:text-green-800 font-medium flex items-center gap-1 transition-colors"
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
                            Showing {{ $products->firstItem() ?: 0 }} - {{ $products->lastItem() ?: 0 }} of {{ $products->total() }} results
                        </span>
                        <span class="sm:hidden">
                            {{ $products->total() }} products found
                        </span>
                    </div>

                    <!-- View Switcher -->
                    <div class="view-switcher flex items-center bg-white rounded-lg border border-gray-300 p-1">
                        <button 
                            onclick="switchView('grid')" 
                            id="gridViewBtn"
                            class="active flex items-center px-3 py-2 rounded-md text-sm font-medium transition-all duration-200 bg-green-100 text-green-700"
                        >
                            <i class='bx bx-grid-alt mr-2'></i>
                            <span class="hidden md:inline">Grid</span>
                        </button>
                        <button 
                            onclick="switchView('list')" 
                            id="listViewBtn"
                            class="flex items-center px-3 py-2 rounded-md text-sm font-medium transition-all duration-200 text-gray-600 hover:text-gray-800"
                        >
                            <i class='bx bx-list-ul mr-2'></i>
                            <span class="hidden md:inline">List</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Container -->
    <div class="container mx-auto px-4 py-8">
        @if($products->count() > 0)
            <!-- Grid View -->
            <div id="gridView" class="products-container grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 md:gap-8">
                @foreach($products as $product)
                    <div class="product-card bg-white rounded-xl shadow-md hover:shadow-xl border border-gray-100 overflow-hidden group h-full flex flex-col transition-all duration-300 hover:-translate-y-1">
                        <!-- Product Image -->
                        <div class="relative bg-gray-50 h-64 overflow-hidden">
                            <img 
                                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110" 
                                src="{{ $product->thumbnail ? url('storage/' . $product->thumbnail) : asset('images/default-product.png') }}"
                                alt="{{ $product->name }}"
                                loading="lazy"
                                onerror="this.src='{{ asset('images/default-product.png') }}'"
                            >
                            
                            <!-- Category Badge -->
                            <div class="absolute top-3 left-3">
                                <span class="bg-white bg-opacity-90 text-gray-700 px-2 py-1 rounded-full text-xs font-medium">
                                    {{ $product->category->name }}
                                </span>
                            </div>
                            
                            <!-- Condition Badge -->
                            <div class="absolute top-3 right-3">
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium">
                                    {{ $product->condition }}
                                </span>
                            </div>
                            
                            <!-- Quick Action Overlay -->
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                                <button class="bg-white text-gray-700 px-4 py-2 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 text-sm font-medium">
                                    <i class='bx bx-show mr-2'></i>Quick View
                                </button>
                            </div>
                        </div>

                        <!-- Product Information -->
                        <div class="flex-1 p-6 flex flex-col">
                            <div class="flex-1">
                                <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-green-600 transition-colors">
                                    {{ $product->name }}
                                </h3>
                                
                                <div class="space-y-2 mb-4">
                                    <div class="flex items-center text-sm text-gray-600">
                                        <i class='bx bx-tag text-blue-500 mr-2'></i>
                                        <span>Brand: {{ $product->brand }}</span>
                                    </div>
                                </div>

                                <!-- Price -->
                                <div class="mb-6">
                                    <div class="flex items-center justify-between">
                                        <span class="text-2xl font-bold text-green-600">${{ number_format($product->price, 2) }}</span>
                                        @if($product->original_price && $product->original_price > $product->price)
                                            <span class="text-sm text-gray-500 line-through">${{ number_format($product->original_price, 2) }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Action Button -->
                            <div class="mt-auto">
                                <a 
                                    href="{{ route('view.product', [$product->slug]) }}" 
                                    class="block w-full text-center px-4 py-3 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-semibold rounded-lg transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500"
                                >
                                    <i class='bx bx-cart mr-2'></i>
                                    Enquire Now
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- List View -->
            <div id="listView" class="products-container space-y-6 hidden">
                @foreach($products as $product)
                    <div class="product-card bg-white rounded-xl shadow-md hover:shadow-xl border border-gray-100 overflow-hidden group transition-all duration-300 hover:-translate-y-1">
                        <div class="flex flex-col md:flex-row">
                            <!-- Product Image -->
                            <div class="md:w-80 bg-gray-50 relative overflow-hidden">
                                <img 
                                    class="w-full h-64 md:h-full object-cover transition-transform duration-300 group-hover:scale-110" 
                                    src="{{ $product->thumbnail ? url('storage/' . $product->thumbnail) : asset('images/default-product.png') }}"
                                    alt="{{ $product->name }}"
                                    loading="lazy"
                                    onerror="this.src='{{ asset('images/default-product.png') }}'"
                                >
                                
                                <!-- Category Badge -->
                                <div class="absolute top-3 left-3">
                                    <span class="bg-white bg-opacity-90 text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
                                        {{ $product->category->name }}
                                    </span>
                                </div>
                            </div>

                            <!-- Product Details -->
                            <div class="flex-1 p-6">
                                <div class="grid md:grid-cols-3 gap-6 h-full">
                                    <!-- Column 1: Basic Info -->
                                    <div class="space-y-4">
                                        <div>
                                            <h3 class="text-2xl font-bold text-gray-900 mb-2 group-hover:text-green-600 transition-colors">
                                                {{ $product->name }}
                                            </h3>
                                            <div class="space-y-2">
                                                <div class="flex items-center text-sm text-gray-600">
                                                    <i class='bx bx-tag text-blue-500 mr-2'></i>
                                                    <span>{{ $product->brand }}</span>
                                                </div>
                                                <div class="flex items-center text-sm text-gray-600">
                                                    <i class='bx bx-check-circle text-green-500 mr-2'></i>
                                                    <span>{{ $product->condition }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Price -->
                                        <div class="space-y-2">
                                            <div class="text-3xl font-bold text-green-600">
                                                ${{ number_format($product->price, 2) }}
                                            </div>
                                            @if($product->original_price && $product->original_price > $product->price)
                                                <div class="flex items-center gap-2">
                                                    <span class="text-lg text-gray-500 line-through">${{ number_format($product->original_price, 2) }}</span>
                                                    <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs font-bold">
                                                        {{ round((($product->original_price - $product->price) / $product->original_price) * 100) }}% OFF
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Column 2: Features/Description -->
                                    <div>
                                        <h4 class="font-semibold text-gray-700 mb-3 flex items-center">
                                            <i class='bx bx-info-circle text-blue-500 mr-2'></i>
                                            Product Details
                                        </h4>
                                        <div class="space-y-2">
                                            @if($product->description)
                                                <p class="text-sm text-gray-600 line-clamp-3">
                                                    {{ Str::limit($product->description, 150) }}
                                                </p>
                                            @endif
                                            
                                            <div class="flex flex-wrap gap-2 mt-3">
                                                <span class="bg-blue-50 text-blue-700 px-2 py-1 rounded-full text-xs font-medium">
                                                    {{ $product->category->name }}
                                                </span>
                                                <span class="bg-green-50 text-green-700 px-2 py-1 rounded-full text-xs font-medium">
                                                    {{ $product->condition }}
                                                </span>
                                                @if($product->brand)
                                                    <span class="bg-purple-50 text-purple-700 px-2 py-1 rounded-full text-xs font-medium">
                                                        {{ $product->brand }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Column 3: Actions -->
                                    <div class="flex flex-col justify-between">
                                        <div class="space-y-3">
                                            <a 
                                                href="{{ route('view.product', [$product->slug]) }}" 
                                                class="block w-full text-center px-4 py-3 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-semibold rounded-lg transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500"
                                            >
                                                <i class='bx bx-cart mr-2'></i>
                                                Enquire Now
                                            </a>
                                            
                                            <div class="grid grid-cols-2 gap-2">
                                                <button class="px-3 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors text-sm font-medium">
                                                    <i class='bx bx-heart mr-1'></i>
                                                    Save
                                                </button>
                                                <button class="px-3 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors text-sm font-medium">
                                                    <i class='bx bx-share mr-1'></i>
                                                    Share
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Additional Info -->
                                        <div class="mt-4 p-3 bg-gray-50 rounded-lg">
                                            <div class="flex justify-between text-xs text-gray-600">
                                                <span>Verified Seller</span>
                                                <i class='bx bx-check-shield text-green-500'></i>
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
                {{ $products->appends(request()->query())->links() }}
            </div>
        @else
            <!-- Enhanced Empty State -->
            <div class="text-center py-16">
                <div class="max-w-md mx-auto">
                    <div class="mb-6">
                        <i class='bx bx-package text-6xl text-gray-300'></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">No Products Found</h3>
                    <p class="text-gray-600 mb-6">
                        We couldn't find any products matching your criteria. Try adjusting your search or filters.
                    </p>
                    <button 
                        onclick="clearFilters()" 
                        class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition-colors"
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
            <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-green-600 mb-4"></div>
            <p class="text-gray-600 font-medium">Loading products...</p>
        </div>
    </div>

    <x-related-keywords :seo="$seo" :route="'products'"/>
@endsection

@section('page-scripts')
    <script>
        // View switcher functionality
        function switchView(viewType) {
            const gridView = document.getElementById('gridView');
            const listView = document.getElementById('listView');
            const gridBtn = document.getElementById('gridViewBtn');
            const listBtn = document.getElementById('listViewBtn');

            if (viewType === 'grid') {
                gridView.classList.remove('hidden');
                listView.classList.add('hidden');
                
                gridBtn.classList.add('active', 'bg-green-100', 'text-green-700');
                gridBtn.classList.remove('text-gray-600');
                
                listBtn.classList.remove('active', 'bg-green-100', 'text-green-700');
                listBtn.classList.add('text-gray-600');
            } else {
                listView.classList.remove('hidden');
                gridView.classList.add('hidden');
                
                listBtn.classList.add('active', 'bg-green-100', 'text-green-700');
                listBtn.classList.remove('text-gray-600');
                
                gridBtn.classList.remove('active', 'bg-green-100', 'text-green-700');
                gridBtn.classList.add('text-gray-600');
            }

            // Save preference to localStorage
            localStorage.setItem('productViewPreference', viewType);
        }

        // Load saved view preference
        document.addEventListener('DOMContentLoaded', function() {
            const savedView = localStorage.getItem('productViewPreference') || 'grid';
            switchView(savedView);
        });

        // Enhanced filter functionality with loading states
        function applyFilters() {
            showLoading();
            
            const categoryValue = document.getElementById('product-category-filter').value;
            const sortValue = document.getElementById('product-sort-by').value;
            const searchValue = document.getElementById('searchInput').value;
            
            let url = '{{ route('products') }}';
            let params = [];

            if (categoryValue !== 'all') {
                params.push('category=' + encodeURIComponent(categoryValue));
            }

            if (sortValue && sortValue !== 'default') {
                params.push('sort=' + encodeURIComponent(sortValue));
            }
            
            if (searchValue.trim()) {
                params.push('search=' + encodeURIComponent(searchValue.trim()));
            }

            if (params.length > 0) {
                url += '?' + params.join('&');
            }

            window.location.href = url;
        }

        function clearFilters() {
            showLoading();
            window.location.href = '{{ route('products') }}';
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
                
                const searchURL = "{{ route('api.search.product', ['search' => '__input__']) }}".replace('__input__', encodeURIComponent(query));
                
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
                        <i class='bx bx-package text-2xl mb-2'></i>
                        <p>No products found</p>
                    </div>
                `;
            } else {
                results.forEach((result, index) => {
                    const resultElement = document.createElement('a');
                    resultElement.href = "{{ route('products', ['search' => '__slug__']) }}".replace('__slug__', encodeURIComponent(result));
                    resultElement.className = 'block px-4 py-3 hover:bg-gray-50 transition-colors border-b border-gray-100 last:border-b-0';
                    resultElement.innerHTML = `
                        <div class="flex items-center">
                            <i class='bx bx-package text-gray-400 mr-3'></i>
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
    </script>
@endsection