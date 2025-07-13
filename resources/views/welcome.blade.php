@php use App\classes\HelperFunctions; @endphp
@php use Carbon\Carbon; @endphp
@extends('layouts.user')

@section('title', 'Welcome to ' . config('app.name') . ' - Your Trusted Business Directory')
@section('description', 'Discover and connect with over 500,000+ verified businesses worldwide. Find products, services, deals, events, and job opportunities in our comprehensive business directory.')
@section('keywords', 'business directory, companies, products, services, deals, jobs, events, local business, worldwide directory')

@section('head')
    <!-- Preload critical resources -->
    <link rel="preload" href="{{ asset('css/boxicons/css/main.css') }}" as="style">
    <link rel="prefetch" href="{{ route('products') }}">
    <link rel="prefetch" href="{{ route('company') }}">
    
    <!-- Critical inline styles for performance -->
    <style>
        .search-input:focus {
            outline: none !important;
            border: none !important;
            --tw-ring-color: rgb(139 92 246 / 0.5) !important;
        }
        
        .card-container {
            min-height: 420px;
        }
        
        .mobile-card-container {
            min-height: 200px;
        }
        
        .category-card {
            height: 280px;
        }
        
        .event-card {
            height: 380px;
        }
        
        .loading-skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }
        
        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
        
        .fade-in {
            opacity: 0;
            animation: fadeIn 0.6s ease-in-out forwards;
        }
        
        @keyframes fadeIn {
            to { opacity: 1; }
        }
    </style>

    <!-- Mobile-specific styles -->
    <style>
        /* Hide scrollbar for mobile horizontal scroll */
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        
        /* Ensure consistent card heights on mobile */
        @media (max-width: 640px) {
            .category-card {
                min-height: 140px;
            }
        }
        
        @media (min-width: 641px) and (max-width: 768px) {
            .category-card {
                min-height: 180px;
            }
        }
        
        @media (min-width: 769px) {
            .category-card {
                min-height: 220px;
            }
        }
    </style>
@endsection

@section('content')
    <!-- Enhanced Hero Section -->
    <section class="relative min-h-content flex items-center justify-center overflow-hidden bg-gradient-to-br from-indigo-900 via-purple-900 to-pink-800 p-5">
        
        <!-- Animated Background Elements -->
        <div class="absolute inset-0">
            <!-- Gradient Orbs -->
            <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-gradient-to-r from-purple-400 to-pink-400 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-pulse"></div>
            <div class="absolute top-1/3 right-1/4 w-96 h-96 bg-gradient-to-r from-yellow-400 to-red-400 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-pulse" style="animation-delay: 2s;"></div>
            <div class="absolute bottom-1/4 left-1/3 w-96 h-96 bg-gradient-to-r from-blue-400 to-green-400 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-pulse" style="animation-delay: 4s;"></div>
            
            <!-- Grid Pattern Overlay -->
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmZmZmYiIGZpbGwtb3BhY2l0eT0iMC4wNSI+PGNpcmNsZSBjeD0iMzAiIGN5PSIzMCIgcj0iMiIvPjwvZz48L2c+PC9zdmc+')] opacity-40"></div>
        </div>

        <!-- Main Content Container -->
        <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8 text-center bg-transparent">
            
            <!-- Headlines -->
            <div class="mb-12 space-y-6 max-w-4xl mx-auto reveal">
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold text-white leading-tight">
                    Discover 
                    <span class="bg-gradient-to-r from-yellow-400 via-pink-500 to-red-500 bg-clip-text text-transparent">
                        Amazing
                    </span>
                    <br class="hidden sm:block">
                    Businesses 
                    <span class="relative">
                        Worldwide
                        <div class="absolute -bottom-2 left-0 right-0 h-1 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full"></div>
                    </span>
                </h1>
                
                <p class="text-xl md:text-2xl text-white/80 font-light leading-relaxed max-w-3xl mx-auto">
                    Connect with over 
                    <span class="text-yellow-400 font-semibold">500,000+</span> 
                    verified businesses, discover amazing products, and unlock endless opportunities.
                </p>
            </div>

            <!-- Enhanced Search Section -->
            <div class="max-w-4xl mx-auto reveal">
                <div class="mb-6">
                    <h2 class="text-2xl md:text-3xl font-bold text-white mb-3">
                        What are you looking for?
                    </h2>
                    <p class="text-white/70">Search from millions of businesses and products</p>
                </div>

                <!-- Search Form -->
                <form action="{{ route('products') }}" method="GET" class="relative group" id="hero-search-form">
                    @csrf
                    <div class="bg-white/95 backdrop-blur-xl rounded-3xl p-2 shadow-2xl border border-white/20 group-hover:shadow-3xl transition-all duration-300 transform group-hover:scale-105">
                        <div class="flex flex-col md:flex-row items-center space-y-2 md:space-y-0 md:space-x-4">
                            
                            <!-- Search Input -->
                            <div class="flex-1 relative w-full">
                                <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </div>
                                <input 
                                    id="searchInput" 
                                    name="search" 
                                    type="text" 
                                    placeholder="Search for businesses, products, services..."
                                    autocomplete="off"
                                    class="search-input w-full pl-12 pr-4 py-4 bg-transparent border-none outline-none text-gray-800 placeholder-gray-500 text-lg font-medium focus:placeholder-gray-400 transition-all duration-300"
                                    aria-label="Search businesses and products"
                                >
                            </div>

                            <!-- Search Button -->
                            <button 
                                type="submit"
                                class="w-full md:w-auto bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 text-white px-8 py-4 rounded-2xl font-semibold text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 flex items-center justify-center space-x-2 group/btn"
                                aria-label="Search"
                            >
                                <span class="md:block hidden">Search Now</span>
                                <span class="md:hidden block">Search</span>
                                <svg class="w-5 h-5 group-hover/btn:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Search Results Dropdown -->
                    <div id="searchResults" class="absolute top-full left-0 right-0 mt-2 bg-white rounded-2xl shadow-2xl border border-gray-200 max-h-96 overflow-y-auto z-50 hidden">
                        <!-- Results will be populated here -->
                    </div>
                </form>

                <!-- Quick Search Tags -->
                <div class="mt-8">
                    <p class="text-white/60 mb-4 text-sm">Popular searches:</p>
                    <div class="flex flex-wrap items-center justify-center gap-3">
                        @php
                            $popularSearches = ['Restaurants', 'Tech Companies', 'Healthcare', 'Automotive', 'E-commerce', 'Fashion'];
                        @endphp
                        @foreach($popularSearches as $search)
                            <a href="{{ route('products', ['search' => strtolower($search)]) }}" 
                               class="bg-white/10 hover:bg-white/20 text-white px-4 py-2 rounded-full text-sm font-medium border border-white/20 hover:border-white/40 transition-all duration-300 transform hover:scale-105">
                                {{ $search }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Stats Counter -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-16 max-w-4xl mx-auto reveal">
                <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-6 border border-white/20 hover:bg-white/20 transition-all duration-300 group">
                    <div class="text-3xl md:text-4xl font-bold text-white mb-2 group-hover:scale-110 transition-transform duration-300">500K+</div>
                    <div class="text-white/70 text-sm">Businesses</div>
                </div>
                <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-6 border border-white/20 hover:bg-white/20 transition-all duration-300 group">
                    <div class="text-3xl md:text-4xl font-bold text-white mb-2 group-hover:scale-110 transition-transform duration-300">1M+</div>
                    <div class="text-white/70 text-sm">Products</div>
                </div>
                <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-6 border border-white/20 hover:bg-white/20 transition-all duration-300 group">
                    <div class="text-3xl md:text-4xl font-bold text-white mb-2 group-hover:scale-110 transition-transform duration-300">150+</div>
                    <div class="text-white/70 text-sm">Categories</div>
                </div>
                <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-6 border border-white/20 hover:bg-white/20 transition-all duration-300 group">
                    <div class="text-3xl md:text-4xl font-bold text-white mb-2 group-hover:scale-110 transition-transform duration-300">50+</div>
                    <div class="text-white/70 text-sm">Countries</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content Container -->
    <div class="bg-gray-50 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">

            <!-- Categories Section -->
            @if(isset($category) && is_iterable($category) && count($category) > 0)
            <section class="mb-12 md:mb-20 reveal">
                <!-- Section Header -->
                <div class="flex flex-col space-y-4 sm:flex-row sm:justify-between sm:items-center sm:space-y-0 mb-6 md:mb-8">
                    <div class="text-center sm:text-left">
                        <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 mb-2">
                            Popular Categories
                        </h2>
                        <p class="text-gray-600 text-base md:text-lg">Explore businesses by categories</p>
                    </div>
                    <a href="{{ route('categories') }}" 
                    class="self-center sm:self-auto bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 md:px-6 md:py-3 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 flex items-center justify-center space-x-2 text-sm md:text-base">
                        <span>View All</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>

                <!-- Categories Grid - Mobile Optimized -->
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3 sm:gap-4 md:gap-6">
                    @foreach($category as $item)
                        @if($loop->index < 10)
                            @php
                                $route = match($item->type ?? 'company') {
                                    'product' => 'products',
                                    'event' => 'events',
                                    'blog' => 'blogs',
                                    'job' => 'jobs',
                                    'forum' => 'forum',
                                    default => 'company',
                                };
                            @endphp
                            <a href="{{ route($route, ['category' => $item->name ?? '']) }}" 
                            class="group bg-white rounded-xl md:rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 md:hover:-translate-y-2 overflow-hidden relative h-auto">
                                
                                <!-- Featured Badge -->
                                @if($item->is_featured ?? false)
                                    <div class="absolute top-2 left-2 md:top-3 md:left-3 bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-2 py-0.5 md:px-2 md:py-1 text-xs font-bold rounded-md md:rounded-lg z-10">
                                        Featured
                                    </div>
                                @endif

                                <!-- Category Image -->
                                <div class="relative overflow-hidden">
                                    @if(isset($item->image) && $item->image)
                                        <img src="{{ url('storage/' . $item->image) }}" 
                                            alt="{{ $item->name ?? 'Category' }}"
                                            class="w-full h-24 sm:h-32 md:h-40 lg:h-48 object-cover group-hover:scale-110 transition-transform duration-300"
                                            loading="lazy"
                                            onerror="this.parentElement.innerHTML='<div class=\'w-full h-24 sm:h-32 md:h-40 lg:h-48 bg-gradient-to-br from-purple-100 to-blue-100 flex items-center justify-center\'><svg class=\'w-8 h-8 sm:w-12 sm:h-12 md:w-16 md:h-16 text-purple-400\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10\'/></svg></div>'"/>
                                    @else
                                        <div class="w-full h-24 sm:h-32 md:h-40 lg:h-48 bg-gradient-to-br from-purple-100 to-blue-100 flex items-center justify-center">
                                            <svg class="w-8 h-8 sm:w-12 sm:h-12 md:w-16 md:h-16 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                <!-- Category Info -->
                                <div class="p-3 md:p-4 flex flex-col justify-between min-h-[60px] md:min-h-[80px]">
                                    <div>
                                        <h3 class="font-bold text-gray-900 text-sm sm:text-base md:text-lg mb-1 group-hover:text-purple-600 transition-colors duration-300 leading-tight">
                                            {{ Str::limit($item->name ?? 'Unknown Category', 15) }}
                                        </h3>
                                        <p class="text-gray-500 text-xs sm:text-sm">
                                            {{ $item->countItem($item->type ?? 'company') ?? 0 }} Items
                                        </p>
                                    </div>
                                    
                                    <!-- Mobile Action Indicator -->
                                    <div class="hidden group-hover:block mt-2">
                                        <span class="text-purple-600 font-semibold text-xs sm:text-sm">
                                            Explore →
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @endif
                    @endforeach
                </div>

                <!-- Mobile View All Button (Duplicate for better UX) -->
                <div class="mt-6 text-center sm:hidden">
                    <a href="{{ route('categories') }}" 
                    class="inline-flex items-center bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 space-x-2">
                        <span>View All Categories</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>

                <!-- Mobile Horizontal Scroll Alternative (Optional) -->
                <div class="block sm:hidden mt-8">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Quick Browse</h3>
                    <div class="flex space-x-3 overflow-x-auto pb-4 scrollbar-hide">
                        @foreach($category->take(8) as $item)
                            @php
                                $route = match($item->type ?? 'company') {
                                    'product' => 'products',
                                    'event' => 'events',
                                    'blog' => 'blogs',
                                    'job' => 'jobs',
                                    'forum' => 'forum',
                                    default => 'company',
                                };
                            @endphp
                            <a href="{{ route($route, ['category' => $item->name ?? '']) }}" 
                            class="flex-shrink-0 bg-white rounded-lg shadow-md p-3 min-w-[120px] text-center hover:shadow-lg transition-all duration-300">
                                <div class="w-12 h-12 bg-gradient-to-br from-purple-100 to-blue-100 rounded-lg flex items-center justify-center mx-auto mb-2">
                                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                    </svg>
                                </div>
                                <h4 class="font-semibold text-xs text-gray-900 mb-1">
                                    {{ Str::limit($item->name ?? 'Category', 12) }}
                                </h4>
                                <p class="text-xs text-gray-500">
                                    {{ $item->countItem($item->type ?? 'company') ?? 0 }}
                                </p>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>
            @endif

            <!-- Featured Companies Section -->
            @if(isset($companies) && count($companies) > 0)
            <section class="mb-20 reveal">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
                    <div>
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">
                            Featured Companies
                        </h2>
                        <p class="text-gray-600 text-lg">Discover trusted business partners</p>
                    </div>
                    <a href="{{ route('company') }}" 
                       class="mt-4 sm:mt-0 bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 flex items-center space-x-2">
                        <span>View All Companies</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($companies as $company)
                        <div class="card-container group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden relative flex flex-col">
                            
                            @if($company->is_featured ?? false)
                                <div class="absolute top-3 left-3 bg-gradient-to-r from-red-500 to-red-600 text-white px-2 py-1 text-xs font-bold rounded-lg z-10">
                                    Featured
                                </div>
                            @endif

                            <!-- Company Logo -->
                            <div class="relative p-6 flex items-center justify-center bg-gray-50 h-48">
                                @if(isset($company->logo) && $company->logo)
                                    <img src="{{ url('storage/' . $company->logo) }}" 
                                         alt="{{ $company->name ?? 'Company' }}"
                                         class="max-w-full max-h-full object-contain group-hover:scale-110 transition-transform duration-300"
                                         loading="lazy"
                                         onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($company->name ?? 'Company') }}&background=6366f1&color=fff&size=150'"/>
                                @else
                                    <div class="w-24 h-24 bg-gradient-to-br from-purple-500 to-blue-500 rounded-full flex items-center justify-center">
                                        <span class="text-white font-bold text-2xl">{{ substr($company->name ?? 'C', 0, 1) }}</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Company Info -->
                            <div class="p-6 flex-1 flex flex-col">
                                <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-purple-600 transition-colors duration-300">
                                    {{ Str::limit($company->name ?? 'Unknown Company', 25) }}
                                </h3>
                                
                                <div class="mb-3">
                                    <div class="flex items-center text-gray-500 text-sm mb-1">
                                        <svg class="w-4 h-4 mr-2 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                        </svg>
                                        {{ $company->address->country->name ?? 'Unknown Location' }}
                                    </div>
                                    
                                    <div class="flex items-center text-gray-500 text-sm">
                                        <svg class="w-4 h-4 mr-2 text-yellow-500" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                        {{ HelperFunctions::getRatingAverage('company', $company->id) ?? '0.0' }}
                                        ({{ HelperFunctions::getRatingCount('company', $company->id) ?? 0 }} reviews)
                                    </div>
                                </div>

                                <div class="mb-4 flex-1">
                                    <h4 class="text-sm font-semibold text-purple-600 mb-2">Deals In:</h4>
                                    <p class="text-gray-700 text-sm line-clamp-3">
                                        {{ Str::limit($company->dealsIn() ?? 'Various products and services', 80) }}
                                    </p>
                                </div>

                                <!-- CTA Button -->
                                <a href="{{ route('view.company', [$company->slug ?? '']) }}" 
                                   class="w-full bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 text-white py-3 px-4 rounded-xl font-semibold text-center transition-all duration-300 transform hover:scale-105 flex items-center justify-center space-x-2">
                                    <span>View Profile</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
            @endif

            <!-- Top Products Section -->
            @if(isset($products) && count($products) > 0)
            <section class="mb-20 reveal">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
                    <div>
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">
                            Top Products
                        </h2>
                        <p class="text-gray-600 text-lg">Discover amazing products from verified sellers</p>
                    </div>
                    <a href="{{ route('products') }}" 
                       class="mt-4 sm:mt-0 bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 flex items-center space-x-2">
                        <span>View All Products</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($products as $item)
                        <div class="card-container group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden relative flex flex-col">
                            
                            @if($item->is_featured ?? false)
                                <div class="absolute top-3 left-3 bg-gradient-to-r from-red-500 to-red-600 text-white px-2 py-1 text-xs font-bold rounded-lg z-10">
                                    Featured
                                </div>
                            @endif

                            <!-- Product Image -->
                            <div class="relative overflow-hidden h-48">
                                @if(isset($item->thumbnail) && $item->thumbnail)
                                    <img src="{{ url('storage/' . $item->thumbnail) }}" 
                                         alt="{{ $item->name ?? 'Product' }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                                         loading="lazy"
                                         onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDIwMCAyMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHJlY3Qgd2lkdGg9IjIwMCIgaGVpZ2h0PSIyMDAiIGZpbGw9IiNGM0Y0RjYiLz48L3N2Zz4='"/>
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <!-- Product Info -->
                            <div class="p-6 flex-1 flex flex-col">
                                <!-- Category -->
                                <div class="flex items-center mb-3">
                                    <span class="bg-purple-100 text-purple-600 px-2 py-1 rounded-lg text-xs font-semibold">
                                        {{ $item->category->name ?? 'Uncategorized' }}
                                    </span>
                                </div>

                                <!-- Product Name -->
                                <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-purple-600 transition-colors duration-300 line-clamp-2">
                                    {{ Str::limit($item->name ?? 'Unknown Product', 40) }}
                                </h3>

                                <!-- Company Info -->
                                <div class="mb-3">
                                    <p class="text-red-600 font-semibold text-sm">{{ $item->company->name ?? 'Unknown Company' }}</p>
                                    <p class="text-gray-500 text-sm">{{ $item->company->address->country->name ?? 'Unknown Location' }}</p>
                                </div>

                                <!-- Price -->
                                <div class="mb-4 flex-1">
                                    <div class="text-2xl font-bold text-green-600">
                                        ${{ HelperFunctions::formatCurrency($item->price ?? 0) }}
                                    </div>
                                </div>

                                <!-- CTA Button -->
                                <a href="{{ route('view.product', [$item->slug ?? '']) }}" 
                                   class="w-full bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white py-3 px-4 rounded-xl font-semibold text-center transition-all duration-300 transform hover:scale-105 flex items-center justify-center space-x-2">
                                    <span>Enquire Now</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
            @endif

            <!-- Featured Events Section -->
            @if(isset($events) && count($events) > 0)
            <section class="mb-20 reveal">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
                    <div>
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">
                            Upcoming Events
                        </h2>
                        <p class="text-gray-600 text-lg">Don't miss these exciting business events</p>
                    </div>
                    <a href="{{ route('events') }}" 
                       class="mt-4 sm:mt-0 bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 flex items-center space-x-2">
                        <span>View All Events</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($events as $event)
                        <div class="event-card group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden relative flex flex-col">
                            
                            <!-- Event Image -->
                            <div class="relative overflow-hidden h-48">
                                @if(isset($event->thumbnail) && $event->thumbnail)
                                    <img src="{{ url('storage/' . $event->thumbnail) }}" 
                                         alt="{{ $event->title ?? 'Event' }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                                         loading="lazy"
                                         onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDIwMCAyMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHJlY3Qgd2lkdGg9IjIwMCIgaGVpZ2h0PSIyMDAiIGZpbGw9IiNGM0Y0RjYiLz48L3N2Zz4='"/>
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-blue-100 to-purple-100 flex items-center justify-center">
                                        <svg class="w-16 h-16 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <!-- Event Info -->
                            <div class="p-6 flex-1 flex flex-col">
                                <!-- Event Organizer -->
                                <div class="flex items-center mb-4">
                                    <img class="w-8 h-8 object-cover rounded-full mr-3" 
                                         src="https://ui-avatars.com/api/?name={{ urlencode($event->company->name ?? 'Organizer') }}&background=6366f1&color=fff&size=32"
                                         alt="Organizer">
                                    <div>
                                        <div class="font-semibold text-sm text-gray-900">{{ $event->company->name ?? 'Unknown Organizer' }}</div>
                                        <div class="text-gray-500 text-xs">{{ $event->created_at->diffForHumans() ?? '' }}</div>
                                    </div>
                                </div>

                                <!-- Event Title -->
                                <h3 class="text-lg font-bold text-gray-900 mb-3 group-hover:text-purple-600 transition-colors duration-300 line-clamp-2 flex-1">
                                    {{ $event->title ?? 'Unknown Event' }}
                                </h3>

                                <!-- Event Details -->
                                <div class="space-y-2 mb-4">
                                    <div class="flex items-center text-gray-600 text-sm">
                                        <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        @php
                                            $eventDate = isset($event->start) ? Carbon::parse($event->start)->format('M d, Y') : 'TBD';
                                        @endphp
                                        {{ $eventDate }}
                                    </div>
                                    
                                    <div class="flex items-center text-gray-600 text-sm">
                                        <svg class="w-4 h-4 mr-2 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                        </svg>
                                        {{ $event->address->country->name ?? 'Unknown Location' }}
                                    </div>
                                </div>

                                <!-- CTA Button -->
                                <a href="{{ route('view.event', [$event->slug ?? '']) }}" 
                                   class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white py-3 px-4 rounded-xl font-semibold text-center transition-all duration-300 transform hover:scale-105 flex items-center justify-center space-x-2">
                                    <span>View Event</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
            @endif

            <!-- Why Choose Us Section -->
            <section class="mb-20 reveal">
                <div class="bg-gradient-to-br from-purple-50 to-blue-50 rounded-3xl p-8 md:p-16">
                    <div class="text-center mb-16">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                            Why Choose Our Platform?
                        </h2>
                        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                            We connect businesses and customers worldwide with our comprehensive directory platform, 
                            offering verified listings and direct communication channels.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="text-center p-6 bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                            <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-blue-500 rounded-2xl flex items-center justify-center mx-auto mb-6">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Global Reach</h3>
                            <p class="text-gray-600">Connect with businesses worldwide and expand your reach to international markets with our comprehensive directory.</p>
                        </div>

                        <div class="text-center p-6 bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                            <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center mx-auto mb-6">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Direct Communication</h3>
                            <p class="text-gray-600">Chat directly with business owners and get instant responses to your inquiries and business needs.</p>
                        </div>

                        <div class="text-center p-6 bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                            <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl flex items-center justify-center mx-auto mb-6">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Verified Listings</h3>
                            <p class="text-gray-600">All business listings are verified to ensure authenticity and quality, giving you confidence in every connection.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Call to Action Section -->
            <section class="reveal">
                <div class="bg-gradient-to-r from-purple-600 to-blue-600 rounded-3xl p-8 md:p-16 text-center text-white">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">
                        Ready to Grow Your Business?
                    </h2>
                    <p class="text-xl mb-8 opacity-90 max-w-2xl mx-auto">
                        Join thousands of businesses already using our platform to connect with customers worldwide.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="#" 
                           class="bg-white text-purple-600 px-8 py-4 rounded-xl font-semibold hover:bg-gray-100 transition-all duration-300 transform hover:scale-105">
                            List Your Business
                        </a>
                        <a href="{{ route('company') }}" 
                           class="border-2 border-white text-white px-8 py-4 rounded-xl font-semibold hover:bg-white hover:text-purple-600 transition-all duration-300 transform hover:scale-105">
                            Browse Businesses
                        </a>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@section('page-scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const searchResults = document.getElementById('searchResults');
    let searchTimeout;
    let currentRequest;

    // Enhanced search with error handling and performance optimization
    searchInput.addEventListener('input', async function() {
        clearTimeout(searchTimeout);
        const inputValue = this.value.trim();

        if (inputValue.length >= 3) {
            searchTimeout = setTimeout(async () => {
                try {
                    // Cancel previous request if still pending
                    if (currentRequest) {
                        currentRequest.abort();
                    }

                    // Create new AbortController for this request
                    const controller = new AbortController();
                    currentRequest = controller;

                    // Show loading state
                    showSearchLoading();

                    const searchURL = "{{ route('api.search.product', ['search' => '__input__']) }}".replace('__input__', encodeURIComponent(inputValue));

                    const response = await fetch(searchURL, {
                        signal: controller.signal,
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    const data = await response.json();
                    displaySearchResults(data, inputValue);

                } catch (error) {
                    if (error.name !== 'AbortError') {
                        console.error('Search error:', error);
                        showSearchError();
                    }
                } finally {
                    currentRequest = null;
                }
            }, 300);
        } else {
            hideSearchResults();
        }
    });

    function showSearchLoading() {
        searchResults.innerHTML = `
            <div class="p-4 flex items-center space-x-3">
                <div class="animate-spin rounded-full h-5 w-5 border-b-2 border-purple-600"></div>
                <span class="text-gray-600">Searching...</span>
            </div>
        `;
        searchResults.classList.remove('hidden');
    }

    function showSearchError() {
        searchResults.innerHTML = `
            <div class="p-4 text-center">
                <div class="text-red-500 mb-2">
                    <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                </div>
                <p class="text-gray-600">Search temporarily unavailable. Please try again.</p>
            </div>
        `;
    }

    function displaySearchResults(data, query) {
        searchResults.innerHTML = '';

        if (!data || !Array.isArray(data) || data.length === 0) {
            searchResults.innerHTML = `
                <div class="p-4 text-center">
                    <div class="text-gray-400 mb-2">
                        <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <p class="text-gray-600">No results found for "${query}"</p>
                    <p class="text-gray-500 text-sm mt-1">Try different keywords or check spelling</p>
                </div>
            `;
            searchResults.classList.remove('hidden');
            return;
        }

        // Display results with enhanced styling
        const resultsHTML = data.map((result, index) => {
            const productUrl = "{{ route('products', ['search' => '__slug__']) }}".replace('__slug__', encodeURIComponent(result));
            
            return `
                <a href="${productUrl}" class="block p-4 hover:bg-gray-50 transition-colors duration-200 border-b border-gray-100 last:border-b-0">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-blue-500 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="font-semibold text-gray-800 truncate">${escapeHtml(result)}</div>
                            <div class="text-sm text-gray-500">Product</div>
                        </div>
                        <div class="text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </div>
                </a>
            `;
        }).join('');

        searchResults.innerHTML = resultsHTML;
        searchResults.classList.remove('hidden');
    }

    function hideSearchResults() {
        searchResults.classList.add('hidden');
    }

    function escapeHtml(text) {
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, function(m) { return map[m]; });
    }

    // Hide results when clicking outside
    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
            hideSearchResults();
        }
    });

    // Handle search form submission
    document.getElementById('hero-search-form').addEventListener('submit', function(e) {
        const searchValue = searchInput.value.trim();
        if (!searchValue) {
            e.preventDefault();
            searchInput.focus();
            return false;
        }
    });

    // Smooth scroll function
    window.scrollToContent = function() {
        const heroHeight = window.innerHeight;
        window.scrollTo({
            top: heroHeight - 100,
            behavior: 'smooth'
        });
    };

    // Performance optimization: Lazy load images
    const images = document.querySelectorAll('img[loading="lazy"]');
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                // Add fade-in class when image loads
                img.addEventListener('load', () => {
                    img.classList.add('fade-in');
                });
                observer.unobserve(img);
            }
        });
    }, {
        rootMargin: '50px'
    });

    images.forEach(img => imageObserver.observe(img));

    // Add loading animation to cards
    const cards = document.querySelectorAll('.reveal');
    cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
    });

    // Handle mobile menu if present
    const mobileMenuButtons = document.querySelectorAll('[data-mobile-menu]');
    mobileMenuButtons.forEach(button => {
        button.addEventListener('click', function() {
            document.body.classList.toggle('overflow-hidden');
        });
    });
});

// Error boundary for unhandled errors
window.addEventListener('error', function(e) {
    console.error('Application error:', e.error);
    // Could send to error reporting service
});

// Performance monitoring
window.addEventListener('load', function() {
    if ('performance' in window) {
        const loadTime = performance.timing.loadEventEnd - performance.timing.navigationStart;
        console.log(`Page load time: ${loadTime}ms`);
        
        // Report slow loading
        if (loadTime > 3000) {
            console.warn('Page loaded slowly:', loadTime + 'ms');
        }
    }
});
</script>
@endsection