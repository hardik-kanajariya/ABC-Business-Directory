@php use App\classes\HelperFunctions; @endphp
@extends('layouts.user')

@section('head')
    <style>
        /* Custom Deal Page Styles */
        .deal-hero {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        }
        
        .deal-image {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .deal-image:hover {
            transform: scale(1.05);
        }
        
        .thumbnail-button {
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        
        .thumbnail-button:hover,
        .thumbnail-button.active {
            border-color: #ef4444;
            transform: scale(1.05);
        }
        
        .discount-badge {
            background: linear-gradient(45deg, #ef4444, #dc2626);
            animation: discountPulse 2s ease-in-out infinite;
        }
        
        @keyframes discountPulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.8; transform: scale(1.05); }
        }
        
        .savings-highlight {
            background: linear-gradient(45deg, #10b981, #059669);
            background-size: 200% 200%;
            animation: savingsShimmer 3s ease infinite;
        }
        
        @keyframes savingsShimmer {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .tab-content {
            display: none;
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.3s ease-out;
        }
        
        .tab-content.active {
            display: block;
            opacity: 1;
            transform: translateY(0);
            animation: fadeInUp 0.3s ease-out;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .floating-badge {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
        }
        
        .price-countdown {
            background: linear-gradient(45deg, #f59e0b, #d97706);
        }
        
        .deal-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .deal-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }
        
        .review-card {
            background: linear-gradient(145deg, #f1f5f9, #e2e8f0);
            transition: all 0.3s ease;
        }
        
        .review-card:hover {
            background: linear-gradient(145deg, #e2e8f0, #cbd5e1);
        }
        
        .company-info-card {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            transition: all 0.3s ease;
        }
        
        .company-info-card:hover {
            background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%);
            transform: translateY(-2px);
        }
        
        .gallery-zoom {
            cursor: zoom-in;
        }
        
        .timer-digit {
            background: linear-gradient(145deg, #1f2937, #374151);
            animation: timerFlip 1s ease-in-out;
        }
        
        @keyframes timerFlip {
            0%, 100% { transform: rotateY(0deg); }
            50% { transform: rotateY(180deg); }
        }
    </style>

    {{-- Hero Section CSS --}}
    <style>
    /* Additional styles for the enhanced hero */
    .deal-image {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .thumbnail-button.active {
        border-color: #ef4444 !important;
        transform: scale(1.05);
    }

    .thumbnail-button:hover {
        transform: scale(1.02);
    }

    .savings-highlight {
        background: linear-gradient(45deg, #10b981, #059669);
        background-size: 200% 200%;
        animation: gradientShift 3s ease infinite;
    }

    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .discount-badge {
        background: linear-gradient(45deg, #ef4444, #dc2626);
        animation: discountPulse 2s ease-in-out infinite;
    }

    @keyframes discountPulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.8; transform: scale(1.05); }
    }

    .timer-digit {
        background: linear-gradient(145deg, #1f2937, #374151);
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);
    }

    .company-info-card {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        transition: all 0.3s ease;
    }

    .company-info-card:hover {
        background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%);
        transform: translateY(-2px);
    }
    </style>
    
    <x-seo :modal="$deal" title="title"/>
@endsection

@section('content')
    <div class="container mx-auto px-4 max-w-7xl">
        <x-user.bread-crumb :data="['Home', 'Deals', $deal->title]"/>
        
        <!-- Enhanced Deal Hero Section -->
        <div class="bg-gradient-to-br from-red-50 to-orange-50 rounded-2xl shadow-lg border border-red-100 overflow-hidden mb-8">
            <div class="grid lg:grid-cols-2 gap-8 p-6 md:p-8">
                <!-- Enhanced Left Side - Deal Images & Features -->
                <div class="space-y-6">
                    <!-- Main Image Section -->
                    <div class="relative bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                        <!-- Floating Badges -->
                        <div class="discount-badge absolute top-4 left-4 z-10 text-white px-4 py-2 rounded-xl font-bold shadow-lg">
                            <i class='bx bx-purchase-tag mr-1'></i>
                            {{ HelperFunctions::getDiscountedPercentage($deal->discount_price, $deal->original_price) }}% OFF
                        </div>
                        
                        <div class="absolute top-4 right-4 z-10 bg-gradient-to-r from-orange-500 to-red-600 text-white px-3 py-2 rounded-xl text-sm font-bold shadow-lg">
                            <i class='bx bx-time mr-1'></i>
                            Limited Time
                        </div>
                        
                        <!-- Image with enhanced styling -->
                        <div class="relative group">
                            <img src="{{ url('storage/'.$deal->thumbnail) }}" 
                                alt="{{ $deal->title }}" 
                                id="main-image"
                                class="deal-image gallery-zoom h-80 w-full object-contain p-8 cursor-zoom-in transition-transform duration-300 group-hover:scale-105">
                            
                            <!-- Image overlay with zoom hint -->
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-all duration-300 flex items-center justify-center">
                                <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-black bg-opacity-70 text-white px-4 py-2 rounded-lg">
                                    <i class='bx bx-zoom-in mr-2'></i>
                                    Click to zoom
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Enhanced Thumbnail Gallery -->
                    <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-4">
                        <h4 class="font-semibold text-gray-900 mb-3 flex items-center">
                            <i class='bx bx-image text-red-600 mr-2'></i>
                            Gallery
                        </h4>
                        <div class="flex justify-center">
                            <div class="grid grid-cols-3 md:grid-cols-5 gap-3 max-w-md">
                                <button type="button" 
                                        class="thumbnail-button active aspect-square h-20 overflow-hidden rounded-lg bg-white shadow-md border-2 border-red-300"
                                        data-image="{{ url('storage/'.$deal->thumbnail) }}"
                                        onclick="changeMainImage(this)">
                                    <img src="{{ url('storage/'.$deal->thumbnail) }}" 
                                        alt="Deal thumbnail"
                                        class="h-full w-full object-contain p-2">
                                </button>

                                @foreach($deal->gallery ?? [] as $image)
                                    <button type="button" 
                                            class="thumbnail-button aspect-square h-20 overflow-hidden rounded-lg bg-white shadow-md border-2 border-transparent hover:border-red-300 transition-colors"
                                            data-image="{{ url('storage/'.$image) }}"
                                            onclick="changeMainImage(this)">
                                        <img src="{{ url('storage/'.$image) }}" 
                                            alt="Deal gallery image"
                                            class="h-full w-full object-contain p-2">
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Deal Features/Highlights -->
                    <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6">
                        <h4 class="font-semibold text-gray-900 mb-4 flex items-center">
                            <i class='bx bx-star text-yellow-500 mr-2'></i>
                            Deal Highlights
                        </h4>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-center p-3 bg-green-50 rounded-lg border border-green-100">
                                <i class='bx bx-check-shield text-green-600 text-2xl mb-2'></i>
                                <div class="text-sm font-medium text-gray-900">Verified Deal</div>
                                <div class="text-xs text-gray-600">Authentic & Guaranteed</div>
                            </div>
                            <div class="text-center p-3 bg-blue-50 rounded-lg border border-blue-100">
                                <i class='bx bx-fast-forward text-blue-600 text-2xl mb-2'></i>
                                <div class="text-sm font-medium text-gray-900">Fast Delivery</div>
                                <div class="text-xs text-gray-600">Quick Processing</div>
                            </div>
                            <div class="text-center p-3 bg-purple-50 rounded-lg border border-purple-100">
                                <i class='bx bx-support text-purple-600 text-2xl mb-2'></i>
                                <div class="text-sm font-medium text-gray-900">24/7 Support</div>
                                <div class="text-xs text-gray-600">Customer Assistance</div>
                            </div>
                            <div class="text-center p-3 bg-orange-50 rounded-lg border border-orange-100">
                                <i class='bx bx-money text-orange-600 text-2xl mb-2'></i>
                                <div class="text-sm font-medium text-gray-900">Best Price</div>
                                <div class="text-xs text-gray-600">Guaranteed Low Price</div>
                            </div>
                        </div>
                    </div>

                    <!-- Deal Statistics -->
                    <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6">
                        <h4 class="font-semibold text-gray-900 mb-4 flex items-center">
                            <i class='bx bx-trending-up text-indigo-600 mr-2'></i>
                            Deal Stats
                        </h4>
                        <div class="grid grid-cols-3 gap-4 text-center">
                            <div class="p-3 bg-gradient-to-br from-red-50 to-red-100 rounded-lg">
                                <div class="text-xl font-bold text-red-600">{{ rand(50, 200) }}</div>
                                <div class="text-xs text-gray-600">People Viewed</div>
                            </div>
                            <div class="p-3 bg-gradient-to-br from-green-50 to-green-100 rounded-lg">
                                <div class="text-xl font-bold text-green-600">{{ rand(10, 50) }}</div>
                                <div class="text-xs text-gray-600">Recent Orders</div>
                            </div>
                            <div class="p-3 bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg">
                                <div class="text-xl font-bold text-blue-600">4.{{ rand(5, 9) }}</div>
                                <div class="text-xs text-gray-600">Rating</div>
                            </div>
                        </div>
                    </div>

                    <!-- Social Proof -->
                    <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6">
                        <h4 class="font-semibold text-gray-900 mb-4 flex items-center">
                            <i class='bx bx-user-check text-green-600 mr-2'></i>
                            Customer Trust
                        </h4>
                        <div class="space-y-3">
                            <div class="flex items-center text-sm">
                                <div class="flex -space-x-2 mr-3">
                                    <img src="https://ui-avatars.com/api/?name=User1&background=ef4444&color=fff&size=24" class="w-6 h-6 rounded-full border-2 border-white">
                                    <img src="https://ui-avatars.com/api/?name=User2&background=10b981&color=fff&size=24" class="w-6 h-6 rounded-full border-2 border-white">
                                    <img src="https://ui-avatars.com/api/?name=User3&background=3b82f6&color=fff&size=24" class="w-6 h-6 rounded-full border-2 border-white">
                                </div>
                                <span class="text-gray-700">{{ rand(15, 35) }}+ people bought this today</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <i class='bx bx-check-circle text-green-500 mr-2'></i>
                                <span>Verified purchase reviews</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <i class='bx bx-shield-check text-blue-500 mr-2'></i>
                                <span>Secure payment processing</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Right Side - Deal Information -->
                <div class="space-y-6">
                    <!-- Deal Header -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                        <div class="text-center mb-6">
                            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">
                                {{ $deal->title }}
                            </h1>
                            
                            <!-- Enhanced Price Section -->
                            <div class="space-y-4">
                                <div class="flex items-center justify-center gap-4">
                                    @if($deal->discount_price && $deal->original_price)
                                        <div class="text-center">
                                            <div class="text-3xl md:text-4xl font-bold text-red-600">
                                                ${{ HelperFunctions::formatCurrency($deal->discount_price) }}
                                            </div>
                                            <div class="text-lg text-gray-500 line-through">
                                                ${{ HelperFunctions::formatCurrency($deal->original_price) }}
                                            </div>
                                        </div>
                                        
                                        <!-- Enhanced Savings Badge -->
                                        <div class="savings-highlight text-white px-4 py-3 rounded-xl shadow-lg">
                                            <div class="text-sm font-medium">You Save</div>
                                            <div class="text-xl font-bold">
                                                ${{ HelperFunctions::formatCurrency($deal->original_price - $deal->discount_price) }}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                                    <p class="text-sm text-green-800 flex items-center justify-center">
                                        <i class='bx bx-info-circle mr-1'></i>
                                        Inclusive of all taxes • Free shipping available
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Enhanced Deal Timer -->
                        <div class="bg-gradient-to-r from-red-50 to-orange-50 rounded-xl p-4 mb-6 border border-red-200">
                            <div class="text-center">
                                <h3 class="font-bold text-gray-900 mb-3 flex items-center justify-center">
                                    <i class='bx bx-time text-red-600 mr-2'></i>
                                    Limited Time Offer
                                </h3>
                                <div id="dealTimer" class="flex justify-center space-x-4">
                                    <div class="timer-digit text-white rounded-lg p-3 text-center min-w-16 bg-gradient-to-b from-gray-800 to-gray-900 shadow-lg">
                                        <div class="text-xl font-bold" id="hours">24</div>
                                        <div class="text-xs">Hours</div>
                                    </div>
                                    <div class="timer-digit text-white rounded-lg p-3 text-center min-w-16 bg-gradient-to-b from-gray-800 to-gray-900 shadow-lg">
                                        <div class="text-xl font-bold" id="minutes">59</div>
                                        <div class="text-xs">Minutes</div>
                                    </div>
                                    <div class="timer-digit text-white rounded-lg p-3 text-center min-w-16 bg-gradient-to-b from-gray-800 to-gray-900 shadow-lg">
                                        <div class="text-xl font-bold" id="seconds">59</div>
                                        <div class="text-xs">Seconds</div>
                                    </div>
                                </div>
                                <p class="text-sm text-red-600 mt-3 font-medium">⚡ Hurry! Only a few items left in stock</p>
                            </div>
                        </div>

                        <!-- Enhanced Action Buttons -->
                        <div class="space-y-3">
                            <a href="{{ route('view.company', [$deal->company->slug]) }}"
                            class="block w-full text-center bg-gradient-to-r from-red-600 to-red-700 text-white font-bold py-4 rounded-xl hover:from-red-700 hover:to-red-800 transition-all duration-300 transform hover:scale-105 shadow-lg text-lg">
                                <i class='bx bx-cart mr-2'></i>
                                Get This Deal Now
                            </a>
                            
                            <div class="grid grid-cols-2 gap-3">
                                <button onclick="addToWishlist()" 
                                        class="flex items-center justify-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-3 rounded-lg transition-colors duration-300 border border-gray-300">
                                    <i class='bx bx-heart mr-2'></i>
                                    Save
                                </button>
                                <button onclick="shareDeal()"
                                        class="flex items-center justify-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-3 rounded-lg transition-colors duration-300 border border-gray-300">
                                    <i class='bx bx-share mr-2'></i>
                                    Share
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Seller Information -->
                    <div class="company-info-card rounded-2xl shadow-lg border border-gray-200 p-6">
                        <div class="text-center">
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Offered by</h3>
                            
                            <!-- Company Logo -->
                            <div class="relative inline-block mb-4">
                                <img src="{{ url('storage/'.$deal->company->logo) }}" 
                                    alt="{{ $deal->company->name }} logo"
                                    class="h-20 w-20 object-contain mx-auto rounded-full border-4 border-white shadow-lg">
                            </div>
                            
                            <!-- Company Info -->
                            <h4 class="text-lg font-bold text-gray-900 mb-2">{{ $deal->company->name }}</h4>
                            
                            <!-- Company Badges -->
                            <div class="flex items-center justify-center gap-2 mb-4">
                                @if($deal->company->is_featured)
                                    <span class="floating-badge bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-3 py-1 rounded-full text-xs font-bold">
                                        <i class='bx bx-star mr-1'></i>
                                        Featured
                                    </span>
                                @endif
                                @if($deal->company->is_approved)
                                    <span class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-3 py-1 rounded-full text-xs font-bold">
                                        <i class='bx bx-badge-check mr-1'></i>
                                        Verified
                                    </span>
                                @endif
                            </div>

                            <!-- Location -->
                            <div class="flex items-center justify-center text-gray-600 mb-4">
                                <i class='bx bx-map text-blue-500 mr-2'></i>
                                <span>{{ $deal->company->address->city }}, {{ $deal->company->address->country->name }}</span>
                            </div>

                            <!-- Rating -->
                            <div class="flex items-center justify-center mb-4">
                                <div class="flex items-center bg-green-100 px-3 py-1 rounded-full">
                                    <i class='bx bxs-star text-yellow-500 mr-1'></i>
                                    <span class="font-medium text-gray-900">
                                        {{ number_format(HelperFunctions::getRatingAverage('company', $deal->company->id), 1) }}
                                    </span>
                                    <span class="text-sm text-gray-600 ml-1">
                                        ({{ HelperFunctions::getRatingCount('company', $deal->company->id) }} reviews)
                                    </span>
                                </div>
                            </div>

                            <!-- Contact Button -->
                            <a href="{{ route('view.company', [$deal->company->slug]) }}"
                            class="inline-flex items-center bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-300">
                                <i class='bx bx-store mr-2'></i>
                                Visit Store
                            </a>
                        </div>
                    </div>

                    <!-- Quick Deal Info -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                        <h3 class="font-bold text-gray-900 mb-4 flex items-center">
                            <i class='bx bx-info-circle text-red-600 mr-2'></i>
                            Deal Information
                        </h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Category</span>
                                <span class="font-medium text-red-600">{{ $deal->category->name }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Posted</span>
                                <span class="font-medium text-gray-900">{{ $deal->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Availability</span>
                                <span class="font-medium text-green-600">
                                    <i class='bx bx-check-circle mr-1'></i>
                                    Available Now
                                </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Shipping</span>
                                <span class="font-medium text-blue-600">
                                    <i class='bx bx-truck mr-1'></i>
                                    Free Delivery
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs Section -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden mb-8">
            <!-- Tab Navigation -->
            <div class="flex border-b border-gray-200 bg-gray-50">
                <button onclick="switchTab('description')" 
                        id="tab-description" 
                        class="tab-button active flex-1 px-6 py-4 font-semibold text-gray-700 hover:text-red-600 hover:bg-white transition-all duration-200 border-b-2 border-transparent">
                    <i class='bx bx-file-blank mr-2'></i>
                    Description
                </button>
                <button onclick="switchTab('reviews')" 
                        id="tab-reviews" 
                        class="tab-button flex-1 px-6 py-4 font-semibold text-gray-700 hover:text-red-600 hover:bg-white transition-all duration-200 border-b-2 border-transparent">
                    <i class='bx bx-star mr-2'></i>
                    Reviews ({{ $deal->getReviews()->count() }})
                </button>
                <button onclick="switchTab('terms')" 
                        id="tab-terms" 
                        class="tab-button flex-1 px-6 py-4 font-semibold text-gray-700 hover:text-red-600 hover:bg-white transition-all duration-200 border-b-2 border-transparent">
                    <i class='bx bx-file-blank mr-2'></i>
                    Terms & Conditions
                </button>
            </div>

            <!-- Tab Content -->
            <div class="p-6">
                <!-- Description Tab -->
                <div id="content-description" class="tab-content active">
                    <div class="max-w-4xl">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                            <i class='bx bx-info-circle text-red-600 mr-3'></i>
                            Deal Details
                        </h3>
                        
                        <!-- Category Info -->
                        <div class="bg-gradient-to-r from-red-50 to-orange-50 rounded-xl p-6 mb-6 border border-red-100">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mr-4">
                                    <i class='bx bx-category text-red-600 text-xl'></i>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-700">Category</div>
                                    <div class="text-red-600 font-medium">{{ $deal->category->name }}</div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Deal Description -->
                        <div class="prose prose-gray max-w-none bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6">
                            <h4 class="text-xl font-bold text-gray-900 mb-4">{{ $deal->title }}</h4>
                            {!! $deal->description !!}
                        </div>

                        <!-- Deal Features -->
                        <div class="grid md:grid-cols-2 gap-6 mt-8">
                            <div class="bg-green-50 rounded-xl p-6 border border-green-100">
                                <h4 class="font-bold text-gray-900 mb-3 flex items-center">
                                    <i class='bx bx-check-circle text-green-600 mr-2'></i>
                                    What's Included
                                </h4>
                                <ul class="space-y-2 text-sm text-gray-700">
                                    <li class="flex items-center">
                                        <i class='bx bx-check text-green-600 mr-2'></i>
                                        Authentic product guarantee
                                    </li>
                                    <li class="flex items-center">
                                        <i class='bx bx-check text-green-600 mr-2'></i>
                                        Secure payment processing
                                    </li>
                                    <li class="flex items-center">
                                        <i class='bx bx-check text-green-600 mr-2'></i>
                                        Customer support included
                                    </li>
                                </ul>
                            </div>
                            
                            <div class="bg-blue-50 rounded-xl p-6 border border-blue-100">
                                <h4 class="font-bold text-gray-900 mb-3 flex items-center">
                                    <i class='bx bx-time text-blue-600 mr-2'></i>
                                    Deal Terms
                                </h4>
                                <ul class="space-y-2 text-sm text-gray-700">
                                    <li class="flex items-center">
                                        <i class='bx bx-check text-blue-600 mr-2'></i>
                                        Limited time offer
                                    </li>
                                    <li class="flex items-center">
                                        <i class='bx bx-check text-blue-600 mr-2'></i>
                                        Subject to availability
                                    </li>
                                    <li class="flex items-center">
                                        <i class='bx bx-check text-blue-600 mr-2'></i>
                                        Terms & conditions apply
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reviews Tab -->
                <div id="content-reviews" class="tab-content">
                    <div class="grid gap-8 lg:grid-cols-3">
                        <!-- Review Summary -->
                        <div class="lg:col-span-1">
                            <div class="bg-gradient-to-br from-red-50 to-orange-50 rounded-2xl p-6 border border-red-100 sticky top-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                                    <i class='bx bx-star text-yellow-500 mr-2'></i>
                                    Deal Reviews
                                </h3>

                                <div class="text-center mb-6">
                                    <div class="text-4xl font-bold text-gray-900 mb-2">
                                        {{ number_format(HelperFunctions::getRatingAverage('deal', $deal->id), 1) }}
                                    </div>
                                    
                                    <!-- Custom Star Rating Display -->
                                    <div class="flex items-center justify-center mb-2">
                                        @php $rating = HelperFunctions::getRatingAverage('deal', $deal->id); @endphp
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $rating)
                                                <i class='bx bxs-star text-yellow-400 text-xl'></i>
                                            @elseif ($i - 0.5 <= $rating)
                                                <i class='bx bxs-star-half text-yellow-400 text-xl'></i>
                                            @else
                                                <i class='bx bx-star text-gray-300 text-xl'></i>
                                            @endif
                                        @endfor
                                    </div>
                                    
                                    <p class="text-sm text-gray-600 mt-2">
                                        Based on {{ $deal->getReviews()->count() }} {{ Str::plural('review', $deal->getReviews()->count()) }}
                                    </p>
                                </div>

                                @auth
                                    @if(auth()->user()->hasRated("deal", $deal->id))
                                        <div class="bg-green-100 text-green-800 p-4 rounded-xl text-center">
                                            <i class='bx bx-check-circle text-2xl mb-2'></i>
                                            <p class="font-medium">Thank you for your review!</p>
                                        </div>
                                    @else
                                        <button onclick="showReviewModal()"
                                                class="w-full bg-gradient-to-r from-red-600 to-red-700 text-white font-semibold py-3 rounded-xl hover:from-red-700 hover:to-red-800 transition-all duration-300 transform hover:scale-105">
                                            <i class='bx bx-edit mr-2'></i>
                                            Write a Review
                                        </button>
                                    @endif
                                @else
                                    <a href="{{ route('auth.login') }}"
                                       class="block w-full bg-gray-100 text-gray-700 font-semibold py-3 rounded-xl hover:bg-gray-200 transition-colors text-center">
                                        <i class='bx bx-log-in mr-2'></i>
                                        Login to Review
                                    </a>
                                @endauth
                            </div>
                        </div>

                        <!-- Reviews List -->
                        <div class="lg:col-span-2">
                            <h3 class="text-xl font-bold text-gray-900 mb-6">Recent Reviews</h3>
                            
                            @if($deal->getReviews()->count() > 0)
                                <div class="space-y-4">
                                    @foreach($deal->getReviews() as $item)
                                        <div class="review-card rounded-2xl p-6 border border-gray-200 hover:shadow-lg transition-all duration-300">
                                            <div class="flex items-start justify-between mb-4">
                                                <div class="flex items-center">
                                                    <div class="w-12 h-12 bg-gradient-to-br from-red-400 to-orange-600 rounded-full flex items-center justify-center text-white font-bold mr-4">
                                                        {{ substr($item->user->name, 0, 1) }}
                                                    </div>
                                                    <div>
                                                        <h4 class="font-semibold text-gray-900">{{ $item->user->name }}</h4>
                                                        <p class="text-sm text-gray-500">{{ $item->created_at->diffForHumans() }}</p>
                                                    </div>
                                                </div>
                                                
                                                <!-- Custom Star Rating for Individual Review -->
                                                <div class="flex items-center">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $item->rating)
                                                            <i class='bx bxs-star text-yellow-400'></i>
                                                        @else
                                                            <i class='bx bx-star text-gray-300'></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                            </div>
                                            <p class="text-gray-700 leading-relaxed">{{ $item->review }}</p>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Pagination -->
                                <div class="mt-8">
                                    {{ $deal->getReviews()->links() }}
                                </div>
                            @else
                                <div class="text-center py-12 bg-gray-50 rounded-2xl">
                                    <i class='bx bx-message-dots text-6xl text-gray-300 mb-4'></i>
                                    <h4 class="text-lg font-semibold text-gray-600 mb-2">No Reviews Yet</h4>
                                    <p class="text-gray-500">Be the first to review this deal!</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Terms & Conditions Tab -->
                <div id="content-terms" class="tab-content">
                    <div class="max-w-4xl">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                            <i class='bx bx-file-blank text-red-600 mr-3'></i>
                            Terms & Conditions
                        </h3>
                        
                        <div class="prose prose-gray max-w-none bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6">
                            {!! $deal->terms_and_conditions !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Deals Section -->
        @if($related_deals && $related_deals->count() > 0)
        <section class="mb-12">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-3xl font-bold text-gray-900 flex items-center">
                    <i class='bx bx-purchase-tag text-red-600 mr-3'></i>
                    Related Deals
                </h2>
                <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-medium">
                    {{ $related_deals->count() }} {{ Str::plural('Deal', $related_deals->count()) }}
                </span>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($related_deals as $item)
                    <div class="deal-card bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden group relative">
                        <!-- Discount Badge -->
                        <div class="absolute top-3 left-3 z-10 bg-gradient-to-r from-red-500 to-pink-600 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                            <i class='bx bx-purchase-tag mr-1'></i>
                            {{ HelperFunctions::getDiscountedPercentage($item->discount_price, $item->original_price) }}% OFF
                        </div>

                        <!-- Deal Image -->
                        <div class="relative h-48 bg-gray-50 overflow-hidden">
                            <a href="{{ route('view.deal', [$item->slug]) }}">
                                <img alt="{{ $item->title }}" 
                                     src="{{ url('storage/' . $item->thumbnail) }}"
                                     class="w-full h-full object-contain p-4 group-hover:scale-110 transition-transform duration-300">
                            </a>
                        </div>

                        <!-- Deal Info -->
                        <div class="p-4">
                            <div class="flex items-center text-xs text-red-600 mb-2">
                                <i class='bx bx-category mr-1'></i>
                                {{ $item->category->name }}
                            </div>

                            <h4 class="font-semibold text-gray-900 mb-3 line-clamp-2 group-hover:text-red-600 transition-colors h-12">
                                <a href="{{ route('view.deal', [$item->slug]) }}">
                                    {{ Str::limit($item->title, 60) }}
                                </a>
                            </h4>

                            <!-- Price Section -->
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <div class="text-lg font-bold text-red-600">
                                        ${{ HelperFunctions::formatCurrency($item->discount_price) }}
                                    </div>
                                    <div class="text-sm text-gray-500 line-through">
                                        ${{ HelperFunctions::formatCurrency($item->original_price) }}
                                    </div>
                                </div>
                                <div class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-bold">
                                    Save ${{ HelperFunctions::formatCurrency($item->original_price - $item->discount_price) }}
                                </div>
                            </div>

                            <!-- Posted Time -->
                            <div class="flex items-center text-xs text-gray-500 mb-4">
                                <i class='bx bx-time mr-1'></i>
                                Posted {{ $item->created_at->diffForHumans() }}
                            </div>

                            <a href="{{ route('view.deal', [$item->slug]) }}"
                               class="block w-full text-center bg-gradient-to-r from-red-600 to-red-700 text-white font-semibold py-3 rounded-xl hover:from-red-700 hover:to-red-800 transition-all duration-300 transform hover:scale-105">
                                <i class='bx bx-cart mr-2'></i>
                                Get Deal
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        @endif
    </div>

    <!-- Custom Review Modal -->
    <div id="reviewModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 transform transition-all duration-300">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-bold text-gray-900">Rate This Deal</h3>
                    <button onclick="hideReviewModal()" class="text-gray-400 hover:text-gray-600 text-2xl">
                        <i class='bx bx-x'></i>
                    </button>
                </div>
                
                <form id="reviewForm" onsubmit="submitReview(event)">
                    @csrf
                    <div class="space-y-6">
                        <div class="text-center">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Rate this deal</label>
                            <div class="flex items-center justify-center space-x-1 mb-4">
                                @for ($i = 1; $i <= 5; $i++)
                                    <button type="button" onclick="setRating({{ $i }})" 
                                            class="rating-star text-3xl text-gray-300 hover:text-yellow-400 transition-colors focus:outline-none"
                                            data-rating="{{ $i }}">
                                        <i class='bx bx-star'></i>
                                    </button>
                                @endfor
                            </div>
                            <input type="hidden" id="ratingValue" name="rating" value="1">
                        </div>
                        
                        <div>
                            <label for="reviewText" class="block text-sm font-semibold text-gray-700 mb-2">Write your review</label>
                            <textarea id="reviewText" name="review" rows="4" 
                                      placeholder="Share your experience with this deal..."
                                      class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 resize-none"
                                      required></textarea>
                        </div>
                    </div>
                    
                    <input type="hidden" name="item_id" value="{{ $deal->id }}">
                    
                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" onclick="hideReviewModal()" 
                                class="px-6 py-3 text-gray-600 hover:text-gray-800 font-medium transition-colors">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-6 py-3 bg-gradient-to-r from-red-600 to-red-700 text-white font-semibold rounded-lg hover:from-red-700 hover:to-red-800 transition-all duration-300 transform hover:scale-105">
                            Submit Review
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Image Zoom Modal -->
    <div id="imageZoomModal" class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50 hidden">
        <div class="relative max-w-4xl max-h-4xl">
            <button onclick="hideImageZoom()" class="absolute top-4 right-4 text-white text-3xl hover:text-gray-300 z-10">
                <i class='bx bx-x'></i>
            </button>
            <img id="zoomedImage" src="" alt="Zoomed deal image" class="max-w-full max-h-full object-contain">
        </div>
    </div>
@endsection

@section('page-scripts')
    <script>
        // Tab Switching Functionality
        function switchTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.remove('active');
            });
            
            // Remove active class from all tab buttons
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('active', 'text-red-600', 'bg-white', 'border-red-600');
                button.classList.add('text-gray-700');
            });
            
            // Show selected tab content
            const selectedContent = document.getElementById('content-' + tabName);
            const selectedButton = document.getElementById('tab-' + tabName);
            
            if (selectedContent && selectedButton) {
                selectedContent.classList.add('active');
                selectedButton.classList.add('active', 'text-red-600', 'bg-white', 'border-red-600');
                selectedButton.classList.remove('text-gray-700');
            }
        }

        // Image Gallery Functions
        function changeMainImage(button) {
            const mainImage = document.getElementById('main-image');
            const newImageSrc = button.getAttribute('data-image');
            
            // Update main image
            mainImage.src = newImageSrc;
            
            // Update active thumbnail
            document.querySelectorAll('.thumbnail-button').forEach(btn => {
                btn.classList.remove('active');
            });
            button.classList.add('active');
        }

        // Image Zoom Functions
        document.getElementById('main-image').addEventListener('click', function() {
            showImageZoom(this.src);
        });

        function showImageZoom(imageSrc) {
            document.getElementById('zoomedImage').src = imageSrc;
            document.getElementById('imageZoomModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function hideImageZoom() {
            document.getElementById('imageZoomModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Deal Timer Function
        function startDealTimer() {
            // Set end time (24 hours from now)
            const endTime = new Date().getTime() + (24 * 60 * 60 * 1000);
            
            const timer = setInterval(function() {
                const now = new Date().getTime();
                const timeLeft = endTime - now;
                
                if (timeLeft <= 0) {
                    clearInterval(timer);
                    document.getElementById('dealTimer').innerHTML = '<div class="text-red-600 font-bold">Deal Expired!</div>';
                    return;
                }
                
                const hours = Math.floor(timeLeft / (1000 * 60 * 60));
                const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
                
                document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
                document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
                document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
            }, 1000);
        }

        // Review Modal Functions
        function showReviewModal() {
            document.getElementById('reviewModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function hideReviewModal() {
            document.getElementById('reviewModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
            resetReviewForm();
        }

        function resetReviewForm() {
            document.getElementById('reviewForm').reset();
            document.getElementById('ratingValue').value = '1';
            document.querySelectorAll('.rating-star').forEach(star => {
                star.classList.remove('filled');
                star.querySelector('i').className = 'bx bx-star';
            });
        }

        // Star Rating Functions
        function setRating(rating) {
            document.getElementById('ratingValue').value = rating;
            
            document.querySelectorAll('.rating-star').forEach((star, index) => {
                const starIcon = star.querySelector('i');
                if (index < rating) {
                    star.classList.add('filled');
                    starIcon.className = 'bx bxs-star';
                    starIcon.style.color = '#fbbf24';
                } else {
                    star.classList.remove('filled');
                    starIcon.className = 'bx bx-star';
                    starIcon.style.color = '#d1d5db';
                }
            });
        }

        // Review Submission
        async function submitReview(event) {
            event.preventDefault();
            
            const form = event.target;
            const formData = new FormData(form);
            const submitButton = form.querySelector('button[type="submit"]');
            
            // Show loading state
            const originalText = submitButton.innerHTML;
            submitButton.innerHTML = '<i class="bx bx-loader-alt animate-spin mr-2"></i>Submitting...';
            submitButton.disabled = true;
            
            try {
                const response = await fetch('{{ route('api.product.rate', ['type' => 'deal']) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                    },
                    body: JSON.stringify({
                        item_id: formData.get('item_id'),
                        rating: formData.get('rating'),
                        review: formData.get('review'),
                        user_id: '{{ auth()->id() ?? '' }}'
                    })
                });
                
                const data = await response.json();
                
                if (data.status === 'success') {
                    hideReviewModal();
                    showNotification('Thank you! Your review has been submitted successfully.', 'success');
                    
                    // Refresh page after short delay
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                } else {
                    showNotification('Error submitting review: ' + (data.message || 'Unknown error'), 'error');
                }
            } catch (error) {
                console.error('Error:', error);
                showNotification('Error submitting review. Please try again.', 'error');
            } finally {
                // Reset button state
                submitButton.innerHTML = originalText;
                submitButton.disabled = false;
            }
        }

        // Share Deal Function
        async function shareDeal() {
            const shareData = {
                title: '{{ $deal->title }}',
                text: 'Check out this amazing deal!',
                url: window.location.href
            };

            try {
                if (navigator.share) {
                    await navigator.share(shareData);
                } else {
                    // Fallback: Copy to clipboard
                    await navigator.clipboard.writeText(window.location.href);
                    showNotification('Deal link copied to clipboard!', 'success');
                }
            } catch (error) {
                console.error('Error sharing:', error);
                showNotification('Failed to share deal. Please try again.', 'error');
            }
        }

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

        // Close modals when clicking outside
        document.getElementById('reviewModal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideReviewModal();
            }
        });

        document.getElementById('imageZoomModal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideImageZoom();
            }
        });

        // Escape key to close modals
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                hideReviewModal();
                hideImageZoom();
            }
        });

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            // Set initial active tab
            switchTab('description');
            
            // Start deal timer
            startDealTimer();
            
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
            document.querySelectorAll('.deal-card, .review-card').forEach(el => {
                observer.observe(el);
            });
        });

        // Performance optimization: Lazy load related deals
        const relatedDealsObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target.querySelector('img');
                    if (img && img.dataset.src) {
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                    }
                }
            });
        });

        document.querySelectorAll('.deal-card').forEach(card => {
            relatedDealsObserver.observe(card);
        });
    </script>

    {{-- Hero Section script --}}
    <script>
        // Enhanced functionality
        function addToWishlist() {
            // Add visual feedback
            const button = event.target.closest('button');
            const icon = button.querySelector('i');
            
            if (icon.classList.contains('bx-heart')) {
                icon.classList.remove('bx-heart');
                icon.classList.add('bxs-heart');
                button.classList.add('text-red-500');
                showNotification('Added to wishlist!', 'success');
            } else {
                icon.classList.remove('bxs-heart');
                icon.classList.add('bx-heart');
                button.classList.remove('text-red-500');
                showNotification('Removed from wishlist!', 'info');
            }
        }

        function changeMainImage(button) {
            const mainImage = document.getElementById('main-image');
            const newImageSrc = button.getAttribute('data-image');
            
            // Update main image with fade effect
            mainImage.style.opacity = '0.5';
            setTimeout(() => {
                mainImage.src = newImageSrc;
                mainImage.style.opacity = '1';
            }, 150);
            
            // Update active thumbnail
            document.querySelectorAll('.thumbnail-button').forEach(btn => {
                btn.classList.remove('active');
            });
            button.classList.add('active');
        }

        // Deal timer functionality
        function startDealTimer() {
            // Set end time (24 hours from now)
            const endTime = new Date().getTime() + (24 * 60 * 60 * 1000);
            
            const timer = setInterval(function() {
                const now = new Date().getTime();
                const timeLeft = endTime - now;
                
                if (timeLeft <= 0) {
                    clearInterval(timer);
                    document.getElementById('dealTimer').innerHTML = '<div class="text-red-600 font-bold">Deal Expired!</div>';
                    return;
                }
                
                const hours = Math.floor(timeLeft / (1000 * 60 * 60));
                const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
                
                document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
                document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
                document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
            }, 1000);
        }

        // Initialize timer on page load
        document.addEventListener('DOMContentLoaded', function() {
            startDealTimer();
        });
    </script>
@endsection