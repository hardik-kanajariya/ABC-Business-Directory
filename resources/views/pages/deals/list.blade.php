@php
    use App\classes\HelperFunctions;
@endphp
@extends('layouts.user')

@section('head')
    <style>
        /* Enhanced search animations */
        .search-container {
            background: linear-gradient(135deg, #a93d3dff 0%, #ec4d4dff 100%);
        }
        
        .search-input:focus {
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }
        
        /* Deal card hover effects */
        .deal-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .deal-card:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        /* Discount ribbon animation */
        .discount-ribbon {
            background: linear-gradient(45deg, #ef4444, #f97316);
            animation: ribbonPulse 2s ease-in-out infinite;
        }
        
        @keyframes ribbonPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        /* Countdown timer styles */
        .countdown-timer {
            background: linear-gradient(135deg, #1f2937 0%, #374151 100%);
        }
        
        /* View switcher animations */
        .view-switcher button {
            transition: all 0.2s ease-in-out;
        }
        
        .view-switcher button.active {
            transform: scale(1.05);
        }
        
        /* Price animations */
        .price-display {
            transition: all 0.3s ease;
        }
        
        .deal-card:hover .price-display {
            transform: scale(1.05);
        }
    </style>
@endsection

@section('content')
    <x-user.bread-crumb :data="['Home', 'Deals', 'List']"/>
    
    <!-- Enhanced Hero Search Section -->
    <div class="search-container relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-20"></div>
        <!-- Floating deal icons animation -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-20 left-10 text-white opacity-20 animate-bounce">💰</div>
            <div class="absolute top-32 right-20 text-white opacity-20 animate-pulse">🔥</div>
            <div class="absolute bottom-20 left-20 text-white opacity-20 animate-bounce delay-1000">⚡</div>
            <div class="absolute bottom-32 right-10 text-white opacity-20 animate-pulse delay-500">🎯</div>
        </div>
        
        <div class="relative z-10 container mx-auto px-4 py-16 lg:py-20 bg-transparent">
            <div class="text-center mb-8">
                <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold text-white mb-4 leading-tight">
                    Incredible <span class="text-yellow-300">Deals & Offers</span>
                </h1>
                <p class="text-lg md:text-xl text-white opacity-90 max-w-2xl mx-auto">
                    Discover amazing discounts and limited-time offers from top brands
                </p>
                
                <!-- Deal Stats -->
                <div class="flex justify-center gap-8 mt-6 text-white">
                    <div class="text-center">
                        <div class="text-2xl font-bold">{{ $deals->total() }}+</div>
                        <div class="text-sm opacity-75">Active Deals</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold">75%</div>
                        <div class="text-sm opacity-75">Max Discount</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold">24/7</div>
                        <div class="text-sm opacity-75">New Offers</div>
                    </div>
                </div>
            </div>
            
            <!-- Enhanced Search Form -->
            <div class="max-w-4xl mx-auto relative">
                <form action="{{ route('deals') }}" method="GET" class="bg-white rounded-2xl shadow-2xl p-2">
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
                                placeholder="Search deals, brands, or categories..." 
                                autocomplete="off"
                                class="search-input w-full pl-12 pr-4 py-4 text-lg border-0 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 transition-all duration-300"
                            >
                            
                            <!-- Enhanced Search Results Dropdown -->
                            <div id="searchResults" class="search-results absolute top-full left-0 right-0 bg-white mt-1 rounded-lg shadow-lg border max-h-80 overflow-y-auto z-50 hidden">
                                <div id="searchResultsContent"></div>
                                <div id="searchLoading" class="hidden p-4 text-center">
                                    <div class="inline-block animate-spin rounded-full h-6 w-6 border-b-2 border-red-600"></div>
                                    <span class="ml-2 text-gray-600">Searching deals...</span>
                                </div>
                            </div>
                        </div>
                        
                        <button 
                            type="submit" 
                            class="bg-red-600 hover:bg-red-700 text-white px-8 py-4 rounded-xl font-semibold text-lg transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                        >
                            <span class="hidden md:inline">Find Deals</span>
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
                        <label for="deals-category-filter" class="text-gray-700 font-medium whitespace-nowrap">
                            <i class='bx bx-filter-alt text-lg'></i>
                            <span class="hidden md:inline ml-1">Category:</span>
                        </label>
                        <select 
                            name="category" 
                            id="deals-category-filter" 
                            class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 bg-white min-w-32"
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

                    <!-- Country Filter -->
                    <div class="flex items-center gap-2">
                        <label for="deals-country" class="text-gray-700 font-medium whitespace-nowrap">
                            <i class='bx bx-world text-lg'></i>
                            <span class="hidden md:inline ml-1">Country:</span>
                        </label>
                        <select 
                            name="country" 
                            id="deals-country" 
                            class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 bg-white min-w-32"
                            onchange="applyFilters()"
                        >
                            <option value="">All Countries</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}" {{ request('country') == $country->id ? 'selected' : '' }}>
                                    {{ $country->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sort Filter -->
                    <div class="flex items-center gap-2">
                        <label for="deals-sort" class="text-gray-700 font-medium whitespace-nowrap">
                            <i class='bx bx-sort text-lg'></i>
                            <span class="hidden md:inline ml-1">Sort by:</span>
                        </label>
                        <select 
                            name="sort" 
                            id="deals-sort" 
                            class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 bg-white min-w-32"
                            onchange="applyFilters()"
                        >
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                            <option value="discount" {{ request('sort') == 'discount' ? 'selected' : '' }}>Best Discount</option>
                            <option value="price-low" {{ request('sort') == 'price-low' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price-high" {{ request('sort') == 'price-high' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="ending-soon" {{ request('sort') == 'ending-soon' ? 'selected' : '' }}>Ending Soon</option>
                        </select>
                    </div>
                    
                    <!-- Clear Filters -->
                    @if(request('category') || request('country') || request('sort') || request('q'))
                        <button 
                            onclick="clearFilters()" 
                            class="text-sm text-red-600 hover:text-red-800 font-medium flex items-center gap-1 transition-colors"
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
                            Showing {{ $deals->firstItem() ?: 0 }} - {{ $deals->lastItem() ?: 0 }} of {{ $deals->total() }} deals
                        </span>
                        <span class="sm:hidden">
                            {{ $deals->total() }} deals found
                        </span>
                    </div>

                    <!-- View Switcher -->
                    <div class="view-switcher flex items-center bg-white rounded-lg border border-gray-300 p-1">
                        <button 
                            onclick="switchView('grid')" 
                            id="gridViewBtn"
                            class="active flex items-center px-3 py-2 rounded-md text-sm font-medium transition-all duration-200 bg-red-100 text-red-700"
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

    <!-- Deals Container -->
    <div class="container mx-auto px-4 py-8">
        @if($deals->count() > 0)
            <!-- Grid View -->
            <div id="gridView" class="deals-container grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                @foreach($deals as $deal)
                    <div class="deal-card bg-white rounded-xl shadow-md hover:shadow-xl border border-gray-100 overflow-hidden group h-full flex flex-col transition-all duration-300 hover:-translate-y-2 relative">
                        <!-- Discount Ribbon -->
                        <div class="discount-ribbon absolute top-0 left-0 z-10 px-3 py-1 rounded-br-lg">
                            <p class="text-white text-xs font-bold">
                                {{ HelperFunctions::getDiscountedPercentage($deal->discount_price, $deal->original_price) }}% OFF
                            </p>
                        </div>

                        <!-- Deal Image -->
                        <div class="relative bg-gray-50 h-48 overflow-hidden">
                            <a href="{{ route('view.deal', [$deal->slug]) }}">
                                <img 
                                    class="w-full h-full object-contain transition-transform duration-300 group-hover:scale-110 p-4" 
                                    src="{{ $deal->thumbnail ? url('storage/' . $deal->thumbnail) : asset('images/default-deal.png') }}"
                                    alt="{{ $deal->title }}"
                                    loading="lazy"
                                    onerror="this.src='{{ asset('images/default-deal.png') }}'"
                                >
                            </a>
                            
                            <!-- Quick Action Overlay -->
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                                <button class="bg-white text-gray-700 px-4 py-2 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 text-sm font-medium">
                                    <i class='bx bx-show mr-2'></i>Quick View
                                </button>
                            </div>
                        </div>

                        <!-- Deal Information -->
                        <div class="flex-1 p-4 flex flex-col">
                            <div class="flex-1">
                                <!-- Category -->
                                <div class="mb-2">
                                    <span class="inline-block bg-gray-100 text-gray-600 px-2 py-1 rounded-full text-xs font-medium">
                                        {{ $deal->category->name }}
                                    </span>
                                </div>

                                <!-- Title -->
                                <h3 class="text-lg font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-red-600 transition-colors">
                                    {{ Str::limit($deal->title, 60) }}
                                </h3>
                                
                                <!-- Location -->
                                <div class="flex items-center text-sm text-gray-600 mb-4">
                                    <i class='bx bx-world text-red-500 mr-2'></i>
                                    <span class="truncate">{{ $deal->company->address->country->name }}</span>
                                </div>

                                <!-- Price Section -->
                                <div class="price-display mb-4">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <div class="text-2xl font-bold text-red-600">
                                                ${{ HelperFunctions::formatCurrency($deal->discount_price) }}
                                            </div>
                                            <div class="text-sm text-gray-500 line-through">
                                                ${{ HelperFunctions::formatCurrency($deal->original_price) }}
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <div class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-bold">
                                                Save ${{ HelperFunctions::formatCurrency($deal->original_price - $deal->discount_price) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Time & Action -->
                            <div class="mt-auto space-y-3">
                                <!-- Posted Time -->
                                <div class="flex items-center justify-center text-xs text-gray-500">
                                    <i class='bx bx-time mr-1'></i>
                                    <span>{{ $deal->created_at->diffForHumans() }}</span>
                                </div>

                                <!-- Action Button -->
                                <a 
                                    href="{{ route('view.deal', [$deal->slug]) }}" 
                                    class="block w-full text-center px-4 py-2 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-semibold rounded-lg transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-red-500"
                                >
                                    <i class='bx bx-cart mr-2'></i>
                                    Get Deal
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- List View -->
            <div id="listView" class="deals-container space-y-6 hidden">
                @foreach($deals as $deal)
                    <div class="deal-card bg-white rounded-xl shadow-md hover:shadow-xl border border-gray-100 overflow-hidden group transition-all duration-300 hover:-translate-y-1 relative">
                        <!-- Discount Ribbon -->
                        <div class="discount-ribbon absolute top-4 left-4 z-10 px-3 py-2 rounded-lg">
                            <p class="text-white text-sm font-bold">
                                {{ HelperFunctions::getDiscountedPercentage($deal->discount_price, $deal->original_price) }}% OFF
                            </p>
                        </div>

                        <div class="flex flex-col md:flex-row">
                            <!-- Deal Image -->
                            <div class="md:w-80 bg-gray-50 relative overflow-hidden">
                                <a href="{{ route('view.deal', [$deal->slug]) }}">
                                    <img 
                                        class="w-full h-64 md:h-full object-contain transition-transform duration-300 group-hover:scale-110 p-6" 
                                        src="{{ $deal->thumbnail ? url('storage/' . $deal->thumbnail) : asset('images/default-deal.png') }}"
                                        alt="{{ $deal->title }}"
                                        loading="lazy"
                                        onerror="this.src='{{ asset('images/default-deal.png') }}'"
                                    >
                                </a>
                            </div>

                            <!-- Deal Details -->
                            <div class="flex-1 p-6">
                                <div class="grid md:grid-cols-3 gap-6 h-full">
                                    <!-- Column 1: Basic Info -->
                                    <div class="space-y-4">
                                        <div>
                                            <!-- Category Badge -->
                                            <span class="inline-block bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-sm font-medium mb-3">
                                                {{ $deal->category->name }}
                                            </span>

                                            <h3 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-red-600 transition-colors">
                                                {{ $deal->title }}
                                            </h3>
                                            
                                            <div class="space-y-2">
                                                <div class="flex items-center text-sm text-gray-600">
                                                    <i class='bx bx-world text-red-500 mr-2'></i>
                                                    <span>{{ $deal->company->address->country->name }}</span>
                                                </div>
                                                <div class="flex items-center text-sm text-gray-600">
                                                    <i class='bx bx-time text-blue-500 mr-2'></i>
                                                    <span>{{ $deal->created_at->diffForHumans() }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Column 2: Pricing & Savings -->
                                    <div>
                                        <h4 class="font-semibold text-gray-700 mb-4 flex items-center">
                                            <i class='bx bx-dollar text-green-500 mr-2'></i>
                                            Pricing Details
                                        </h4>
                                        
                                        <div class="space-y-4">
                                            <!-- Current Price -->
                                            <div>
                                                <div class="text-3xl font-bold text-red-600 mb-1">
                                                    ${{ HelperFunctions::formatCurrency($deal->discount_price) }}
                                                </div>
                                                <div class="text-lg text-gray-500 line-through">
                                                    ${{ HelperFunctions::formatCurrency($deal->original_price) }}
                                                </div>
                                            </div>

                                            <!-- Savings Breakdown -->
                                            <div class="bg-green-50 p-3 rounded-lg">
                                                <div class="text-sm text-green-800 font-semibold mb-1">You Save:</div>
                                                <div class="text-lg font-bold text-green-600">
                                                    ${{ HelperFunctions::formatCurrency($deal->original_price - $deal->discount_price) }}
                                                </div>
                                                <div class="text-xs text-green-600">
                                                    ({{ HelperFunctions::getDiscountedPercentage($deal->discount_price, $deal->original_price) }}% discount)
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Column 3: Actions & Info -->
                                    <div class="flex flex-col justify-between">
                                        <div class="space-y-3">
                                            <a 
                                                href="{{ route('view.deal', [$deal->slug]) }}" 
                                                class="block w-full text-center px-4 py-3 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-semibold rounded-lg transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-red-500"
                                            >
                                                <i class='bx bx-cart mr-2'></i>
                                                Get This Deal
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

                                        <!-- Deal Status -->
                                        <div class="mt-4 p-3 bg-red-50 rounded-lg">
                                            <div class="flex justify-between text-xs text-red-600">
                                                <span>🔥 Hot Deal</span>
                                                <i class='bx bx-trending-up text-red-500'></i>
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
                {{ $deals->appends(request()->query())->links() }}
            </div>
        @else
            <!-- Enhanced Empty State -->
            <div class="text-center py-16">
                <div class="max-w-md mx-auto">
                    <div class="mb-6">
                        <i class='bx bx-gift text-6xl text-gray-300'></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">No Deals Found</h3>
                    <p class="text-gray-600 mb-6">
                        We couldn't find any deals matching your criteria. Try adjusting your search or filters.
                    </p>
                    <button 
                        onclick="clearFilters()" 
                        class="inline-flex items-center px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-colors"
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
            <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-red-600 mb-4"></div>
            <p class="text-gray-600 font-medium">Loading deals...</p>
        </div>
    </div>

    <x-related-keywords :seo="$seo" :route="'deals'"/>
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
                
                gridBtn.classList.add('active', 'bg-red-100', 'text-red-700');
                gridBtn.classList.remove('text-gray-600');
                
                listBtn.classList.remove('active', 'bg-red-100', 'text-red-700');
                listBtn.classList.add('text-gray-600');
            } else {
                listView.classList.remove('hidden');
                gridView.classList.add('hidden');
                
                listBtn.classList.add('active', 'bg-red-100', 'text-red-700');
                listBtn.classList.remove('text-gray-600');
                
                gridBtn.classList.remove('active', 'bg-red-100', 'text-red-700');
                gridBtn.classList.add('text-gray-600');
            }

            // Save preference to localStorage
            localStorage.setItem('dealViewPreference', viewType);
        }

        // Load saved view preference
        document.addEventListener('DOMContentLoaded', function() {
            const savedView = localStorage.getItem('dealViewPreference') || 'grid';
            switchView(savedView);
        });

        // Enhanced filter functionality with loading states
        function applyFilters() {
            showLoading();
            
            const categoryValue = document.getElementById('deals-category-filter').value;
            const countryValue = document.getElementById('deals-country').value;
            const sortValue = document.getElementById('deals-sort').value;
            const searchValue = document.getElementById('searchInput').value;
            
            let url = '{{ route('deals') }}';
            let params = [];

            if (categoryValue !== 'all') {
                params.push('category=' + encodeURIComponent(categoryValue));
            }

            if (countryValue && countryValue !== '') {
                params.push('country=' + encodeURIComponent(countryValue));
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
            window.location.href = '{{ route('deals') }}';
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
                
                const searchURL = "{{ route('api.search.deals', ['search' => '__input__']) }}".replace('__input__', encodeURIComponent(query));
                
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
                        <i class='bx bx-gift text-2xl mb-2'></i>
                        <p>No deals found</p>
                    </div>
                `;
            } else {
                results.forEach((result, index) => {
                    const resultElement = document.createElement('a');
                    resultElement.href = "{{ route('deals', ['q' => '__slug__']) }}".replace('__slug__', encodeURIComponent(result));
                    resultElement.className = 'block px-4 py-3 hover:bg-gray-50 transition-colors border-b border-gray-100 last:border-b-0';
                    resultElement.innerHTML = `
                        <div class="flex items-center">
                            <i class='bx bx-gift text-gray-400 mr-3'></i>
                            <span class="text-gray-900">${escapeHtml(result)}</span>
                            <span class="ml-auto text-xs text-red-600 font-medium">🔥 Deal</span>
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

        // Auto-refresh deals every 5 minutes to show new offers
        setInterval(function() {
            if (document.visibilityState === 'visible') {
                // Optional: Check for new deals and show notification
                console.log('Checking for new deals...');
            }
        }, 300000); // 5 minutes
    </script>
@endsection