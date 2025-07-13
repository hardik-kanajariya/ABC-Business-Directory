@php use App\Models\Category; @endphp
@extends('layouts.user')

@section('head')
    <style>
        /* Animation keyframes */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .animate-scaleIn {
            animation: scaleIn 0.4s ease-out forwards;
        }

        .animate-slideInLeft {
            animation: slideInLeft 0.5s ease-out forwards;
        }

        /* Card hover effects */
        .category-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            transform: translateY(0);
        }

        .category-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .category-image {
            transition: transform 0.3s ease;
        }

        .category-card:hover .category-image {
            transform: scale(1.05);
        }

        /* Custom gradient backgrounds */
        .hero-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .card-gradient {
            background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        }

        /* Floating animation */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .float-animation {
            animation: float 3s ease-in-out infinite;
        }

        /* Featured badge pulse */
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .featured-badge {
            animation: pulse 2s infinite;
        }

        /* Loading skeleton */
        @keyframes shimmer {
            0% { background-position: -200px 0; }
            100% { background-position: calc(200px + 100%) 0; }
        }

        .shimmer {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200px 100%;
            animation: shimmer 1.5s infinite;
        }
    </style>
@endsection

@section('content')
    <x-user.bread-crumb :data="['Home', 'Category', 'List']"/>
    
    <!-- Hero Section -->
    <div class="relative overflow-hidden hero-gradient">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="relative flex flex-col justify-center items-center h-80 px-4">
            <!-- Floating background elements -->
            <div class="absolute top-10 left-10 w-20 h-20 bg-white opacity-10 rounded-full float-animation"></div>
            <div class="absolute top-20 right-20 w-16 h-16 bg-white opacity-10 rounded-full float-animation" style="animation-delay: 1s;"></div>
            <div class="absolute bottom-20 left-1/3 w-12 h-12 bg-white opacity-10 rounded-full float-animation" style="animation-delay: 2s;"></div>
            
            <div class="text-center animate-fadeInUp">
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-4 drop-shadow-lg">
                    Discover Business Categories
                </h1>
                <p class="text-xl md:text-2xl text-white opacity-90 max-w-2xl mx-auto">
                    Explore thousands of businesses across different industries and find what you're looking for
                </p>
            </div>
            
            <!-- Stats or additional info -->
            <div class="mt-8 flex flex-wrap justify-center gap-8 animate-fadeInUp" style="animation-delay: 0.3s;">
                <div class="text-center">
                    <div class="text-3xl font-bold text-white">1000+</div>
                    <div class="text-white opacity-80">Businesses</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-white">50+</div>
                    <div class="text-white opacity-80">Categories</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-white">24/7</div>
                    <div class="text-white opacity-80">Support</div>
                </div>
            </div>
        </div>
        
        <!-- Decorative wave -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1200 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1200 120L0 120L0 0C0 0 218.5 42 600 42C981.5 42 1200 0 1200 0L1200 120Z" fill="white"/>
            </svg>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto py-16 px-4">
        @forelse($type as $index => $itemType)
            <section class="mb-20" style="animation-delay: {{ $index * 0.2 }}s;">
                <!-- Section Header -->
                <div class="flex items-center justify-between mb-12 animate-slideInLeft">
                    <div>
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">
                            {{ ucfirst($itemType) }} Directory
                        </h2>
                        <div class="h-1 w-20 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full"></div>
                    </div>
                    <div class="hidden md:block">
                        <div class="flex items-center space-x-2 text-gray-600">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Verified Businesses</span>
                        </div>
                    </div>
                </div>

                @php
                    $data = Category::where('type', $itemType)->get();
                    $route = match($itemType) {
                        'product' => 'products',
                        'event' => 'events',
                        'blog' => 'blogs',
                        'job' => 'jobs',
                        'forum' => 'forum',
                        default => 'company',
                    };
                @endphp

                @if(is_iterable($data) && $data->count() > 0)
                    <!-- Categories Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-8">
                        @foreach($data as $cardIndex => $item)
                            <div class="animate-scaleIn" style="animation-delay: {{ ($cardIndex * 0.1) + 0.3 }}s;">
                                <a href="{{ route($route, ['category' => $item->name]) }}" 
                                   class="category-card block relative bg-white rounded-2xl shadow-lg overflow-hidden group">
                                    
                                    <!-- Featured Badge -->
                                    @if($item->is_featured)
                                        <div class="absolute top-4 left-4 z-10">
                                            <div class="featured-badge bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                                                ⭐ Featured
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Image Container -->
                                    <div class="relative h-48 overflow-hidden">
                                        @if($item->image)
                                            <img src="{{ url('storage/' . $item->image) }}" 
                                                 alt="{{ $item->name }}" 
                                                 class="category-image w-full h-full object-cover"/>
                                        @else
                                            <div class="category-image w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                                          d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/>
                                                </svg>
                                            </div>
                                        @endif
                                        
                                        <!-- Overlay on hover -->
                                        <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                                    </div>

                                    <!-- Card Content -->
                                    <div class="p-6">
                                        <h3 class="font-bold text-lg text-gray-800 mb-2 group-hover:text-blue-600 transition-colors duration-300">
                                            {{ Str::limit($item->name, 25) }}
                                        </h3>
                                        
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-2 text-gray-600">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2v1a1 1 0 102 0V3a2 2 0 012 0v1a1 1 0 102 0V3a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                                                </svg>
                                                <span class="text-sm font-medium">{{ $item->countItem($item->type) }} Items</span>
                                            </div>
                                            
                                            <div class="flex items-center text-blue-600 group-hover:text-blue-700 transition-colors duration-300">
                                                <span class="text-sm font-medium mr-1">Explore</span>
                                                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="text-center py-16 animate-fadeInUp">
                        <div class="w-32 h-32 mx-auto mb-6">
                            <svg class="w-full h-full text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" 
                                      d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-600 mb-2">No {{ $itemType }} categories available</h3>
                        <p class="text-gray-500">Check back later for new additions to this category.</p>
                    </div>
                @endif
            </section>
        @empty
            <!-- No Types Found -->
            <div class="text-center py-20 animate-fadeInUp">
                <div class="w-40 h-40 mx-auto mb-8">
                    <svg class="w-full h-full text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" 
                              d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.5-1.007-6-2.709M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                </div>
                <h2 class="text-3xl font-bold text-gray-700 mb-4">No Categories Found</h2>
                <p class="text-xl text-gray-500 mb-8 max-w-md mx-auto">
                    We're working hard to bring you amazing business categories. Stay tuned!
                </p>
                <button class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-8 py-3 rounded-full font-semibold hover:shadow-lg transform hover:scale-105 transition-all duration-300">
                    Notify When Available
                </button>
            </div>
        @endforelse
    </div>

    <!-- Call to Action Section -->
    <section class="bg-gradient-to-r from-blue-600 to-purple-700 py-20">
        <div class="container mx-auto px-4 text-center">
            <div class="animate-fadeInUp">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
                    Ready to List Your Business?
                </h2>
                <p class="text-xl text-white opacity-90 mb-8 max-w-2xl mx-auto">
                    Join thousands of businesses already listed in our directory and reach more customers today.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button class="bg-white text-blue-600 px-8 py-4 rounded-full font-bold hover:shadow-lg transform hover:scale-105 transition-all duration-300">
                        List Your Business
                    </button>
                    <button class="border-2 border-white text-white px-8 py-4 rounded-full font-bold hover:bg-white hover:text-blue-600 transition-all duration-300">
                        Learn More
                    </button>
                </div>
            </div>
        </div>
    </section>
@endsection