@php use App\classes\HelperFunctions; @endphp
@extends('layouts.user')

@section('head')
    <style>
        /* Custom Product Page Styles */
        .product-hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .product-image {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .product-image:hover {
            transform: scale(1.05);
        }
        
        .thumbnail-button {
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        
        .thumbnail-button:hover,
        .thumbnail-button.active {
            border-color: #6366f1;
            transform: scale(1.05);
        }
        
        .product-info-card {
            background: linear-gradient(145deg, #f8fafc, #e2e8f0);
            transition: all 0.3s ease;
        }
        
        .product-info-card:hover {
            background: linear-gradient(145deg, #e2e8f0, #cbd5e1);
            transform: translateY(-2px);
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
        
        .price-highlight {
            background: linear-gradient(45deg, #10b981, #059669);
            background-size: 200% 200%;
            animation: gradientShift 3s ease infinite;
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .gallery-zoom {
            cursor: zoom-in;
        }
        
        .review-card {
            background: linear-gradient(145deg, #f1f5f9, #e2e8f0);
            transition: all 0.3s ease;
        }
        
        .review-card:hover {
            background: linear-gradient(145deg, #e2e8f0, #cbd5e1);
        }
        
        .related-product-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .related-product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }
    </style>
    
    <x-seo :modal="$product" title="name"/>
@endsection

@section('content')
    <div class="container mx-auto px-4 max-w-7xl">
        <x-user.bread-crumb :data="['Home', 'Products', $product->name]"/>
        
        <!-- Product Hero Section -->
        <div class="grid lg:grid-cols-2 gap-8 mb-12">
            <!-- Product Images -->
            <div class="space-y-4">
                <!-- Main Image -->
                <div class="relative bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                    @if($product->is_featured)
                        <div class="floating-badge absolute top-4 left-4 z-10 bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-3 py-2 rounded-full text-sm font-bold shadow-lg">
                            <i class='bx bx-star mr-1'></i>
                            Featured
                        </div>
                    @endif
                    
                    <img src="{{ url('storage/'.$product->thumbnail) }}" 
                         alt="{{ $product->name }}" 
                         id="main-image"
                         class="product-image gallery-zoom h-80 w-full object-contain p-8 cursor-zoom-in">
                </div>

                <!-- Thumbnail Gallery -->
                <div class="flex justify-center">
                    <div class="grid grid-cols-3 md:grid-cols-5 gap-3 max-w-md">
                        <button type="button" 
                                class="thumbnail-button active aspect-square h-20 overflow-hidden rounded-lg bg-white shadow-md"
                                data-image="{{ url('storage/'.$product->thumbnail) }}"
                                onclick="changeMainImage(this)">
                            <img src="{{ url('storage/'.$product->thumbnail) }}" 
                                 alt="Product thumbnail"
                                 class="h-full w-full object-contain p-2">
                        </button>

                        @foreach($product->gallery ?? [] as $image)
                            <button type="button" 
                                    class="thumbnail-button aspect-square h-20 overflow-hidden rounded-lg bg-white shadow-md"
                                    data-image="{{ url('storage/'.$image) }}"
                                    onclick="changeMainImage(this)">
                                <img src="{{ url('storage/'.$image) }}" 
                                     alt="Product gallery image"
                                     class="h-full w-full object-contain p-2">
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Product Information -->
            <div class="space-y-6">
                <!-- Product Header -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">
                                {{ $product->name }}
                            </h1>
                            
                            <!-- Price -->
                            <div class="price-highlight text-white px-4 py-2 rounded-xl inline-block mb-4">
                                <span class="text-2xl font-bold">
                                    ${{ HelperFunctions::formatCurrency($product->price) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Product Meta -->
                    <div class="space-y-3 mb-6">
                        <div class="flex items-center text-sm text-gray-600">
                            <i class='bx bx-category text-indigo-500 mr-2'></i>
                            <span>Category: <span class="font-medium text-gray-900">{{ $product->category->name ?? 'N/A' }}</span></span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class='bx bx-building text-blue-500 mr-2'></i>
                            <span>Brand: <span class="font-medium text-gray-900">{{ $product->brand ?? 'N/A' }}</span></span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class='bx bx-check-circle text-green-500 mr-2'></i>
                            <span>Condition: <span class="font-medium text-gray-900">{{ $product->condition ?? 'New' }}</span></span>
                        </div>
                    </div>

                    <!-- Seller Information -->
                    <div class="bg-gradient-to-r from-purple-50 to-indigo-50 rounded-xl p-4 mb-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Sold by</h3>
                                <p class="text-purple-600 font-medium">{{ $product->company->name }}</p>
                                <p class="text-sm text-gray-600">
                                    <i class='bx bx-calendar mr-1'></i>
                                    Listed {{ $product->created_at->diffForHumans() }}
                                </p>
                            </div>
                            <a href="{{ route('view.company', [$product->company->slug]) }}"
                               class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-300 flex items-center">
                                <i class='bx bx-store mr-2'></i>
                                View Store
                            </a>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="grid md:grid-cols-2 gap-4">
                        <a href="{{ route('view.company', [$product->company->slug]) }}"
                           class="block w-full text-center bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold py-3 rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                            <i class='bx bx-message-dots mr-2'></i>
                            Contact Seller
                        </a>
                        <button onclick="addToWishlist({{ $product->id }})"
                                class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 rounded-xl transition-colors duration-300 border border-gray-300">
                            <i class='bx bx-heart mr-2'></i>
                            Add to Wishlist
                        </button>
                    </div>
                </div>

                <!-- Quick Specs -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                    <h3 class="font-bold text-gray-900 mb-4 flex items-center">
                        <i class='bx bx-info-circle text-indigo-600 mr-2'></i>
                        Quick Specifications
                    </h3>
                    <div class="grid grid-cols-2 gap-4">
                        @if($product->color)
                            <div class="text-center p-3 bg-gray-50 rounded-lg">
                                <i class='bx bx-palette text-pink-500 text-xl mb-1'></i>
                                <div class="text-xs text-gray-600">Color</div>
                                <div class="font-medium text-gray-900">{{ $product->color }}</div>
                            </div>
                        @endif
                        @if($product->size)
                            <div class="text-center p-3 bg-gray-50 rounded-lg">
                                <i class='bx bx-expand text-blue-500 text-xl mb-1'></i>
                                <div class="text-xs text-gray-600">Size</div>
                                <div class="font-medium text-gray-900">{{ $product->size }}</div>
                            </div>
                        @endif
                        @if($product->material)
                            <div class="text-center p-3 bg-gray-50 rounded-lg">
                                <i class='bx bxs-layer text-green-500 text-xl mb-1'></i>
                                <div class="text-xs text-gray-600">Material</div>
                                <div class="font-medium text-gray-900">{{ $product->material }}</div>
                            </div>
                        @endif
                        <div class="text-center p-3 bg-gray-50 rounded-lg">
                            <i class='bx bx-shield-check text-purple-500 text-xl mb-1'></i>
                            <div class="text-xs text-gray-600">Warranty</div>
                            <div class="font-medium text-gray-900">1 Year</div>
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
                        class="tab-button active flex-1 px-6 py-4 font-semibold text-gray-700 hover:text-indigo-600 hover:bg-white transition-all duration-200 border-b-2 border-transparent">
                    <i class='bx bx-file-blank mr-2'></i>
                    Description
                </button>
                <button onclick="switchTab('specifications')" 
                        id="tab-specifications" 
                        class="tab-button flex-1 px-6 py-4 font-semibold text-gray-700 hover:text-indigo-600 hover:bg-white transition-all duration-200 border-b-2 border-transparent">
                    <i class='bx bx-list-ul mr-2'></i>
                    Specifications
                </button>
                <button onclick="switchTab('reviews')" 
                        id="tab-reviews" 
                        class="tab-button flex-1 px-6 py-4 font-semibold text-gray-700 hover:text-indigo-600 hover:bg-white transition-all duration-200 border-b-2 border-transparent">
                    <i class='bx bx-star mr-2'></i>
                    Reviews ({{ $product->getReviews()->count() }})
                </button>
            </div>

            <!-- Tab Content -->
            <div class="p-6">
                <!-- Description Tab -->
                <div id="content-description" class="tab-content active">
                    <div class="max-w-4xl">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                            <i class='bx bx-info-circle text-indigo-600 mr-3'></i>
                            Product Description
                        </h3>
                        
                        <div class="prose prose-gray max-w-none bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6">
                            {!! $product->description !!}
                        </div>

                        <!-- Additional Product Info -->
                        <div class="grid md:grid-cols-2 gap-6 mt-8">
                            <div class="bg-blue-50 rounded-xl p-6 border border-blue-100">
                                <h4 class="font-bold text-gray-900 mb-3 flex items-center">
                                    <i class='bx bx-shield-check text-blue-600 mr-2'></i>
                                    Quality Assurance
                                </h4>
                                <ul class="space-y-2 text-sm text-gray-700">
                                    <li class="flex items-center">
                                        <i class='bx bx-check text-green-600 mr-2'></i>
                                        Verified product quality
                                    </li>
                                    <li class="flex items-center">
                                        <i class='bx bx-check text-green-600 mr-2'></i>
                                        Authentic brand guarantee
                                    </li>
                                    <li class="flex items-center">
                                        <i class='bx bx-check text-green-600 mr-2'></i>
                                        Secure payment options
                                    </li>
                                </ul>
                            </div>
                            
                            <div class="bg-green-50 rounded-xl p-6 border border-green-100">
                                <h4 class="font-bold text-gray-900 mb-3 flex items-center">
                                    <i class='bx bx-truck text-green-600 mr-2'></i>
                                    Shipping & Returns
                                </h4>
                                <ul class="space-y-2 text-sm text-gray-700">
                                    <li class="flex items-center">
                                        <i class='bx bx-check text-green-600 mr-2'></i>
                                        Fast shipping available
                                    </li>
                                    <li class="flex items-center">
                                        <i class='bx bx-check text-green-600 mr-2'></i>
                                        30-day return policy
                                    </li>
                                    <li class="flex items-center">
                                        <i class='bx bx-check text-green-600 mr-2'></i>
                                        Secure packaging
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Specifications Tab -->
                <div id="content-specifications" class="tab-content">
                    <div class="max-w-4xl">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                            <i class='bx bx-list-ul text-indigo-600 mr-3'></i>
                            Detailed Specifications
                        </h3>
                        
                        <div class="space-y-4">
                            <div class="product-info-card rounded-xl p-6 border border-gray-200">
                                <div class="grid md:grid-cols-3 gap-6">
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center mr-4">
                                            <i class='bx bx-category text-indigo-600 text-xl'></i>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-700">Category</div>
                                            <div class="text-gray-600 text-sm">Product classification</div>
                                        </div>
                                    </div>
                                    <div class="md:col-span-2">
                                        <span class="text-purple-600 font-medium">{{ $product->category->name ?? 'N/A' }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="product-info-card rounded-xl p-6 border border-gray-200">
                                <div class="grid md:grid-cols-3 gap-6">
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                                            <i class='bx bx-building text-blue-600 text-xl'></i>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-700">Brand</div>
                                            <div class="text-gray-600 text-sm">Manufacturer</div>
                                        </div>
                                    </div>
                                    <div class="md:col-span-2">
                                        <span class="text-gray-900 font-medium">{{ $product->brand ?? 'N/A' }}</span>
                                    </div>
                                </div>
                            </div>

                            @if($product->color)
                            <div class="product-info-card rounded-xl p-6 border border-gray-200">
                                <div class="grid md:grid-cols-3 gap-6">
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 bg-pink-100 rounded-full flex items-center justify-center mr-4">
                                            <i class='bx bx-palette text-pink-600 text-xl'></i>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-700">Color</div>
                                            <div class="text-gray-600 text-sm">Available color</div>
                                        </div>
                                    </div>
                                    <div class="md:col-span-2">
                                        <span class="text-gray-900 font-medium">{{ $product->color }}</span>
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if($product->size)
                            <div class="product-info-card rounded-xl p-6 border border-gray-200">
                                <div class="grid md:grid-cols-3 gap-6">
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                                            <i class='bx bx-expand text-green-600 text-xl'></i>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-700">Size</div>
                                            <div class="text-gray-600 text-sm">Product dimensions</div>
                                        </div>
                                    </div>
                                    <div class="md:col-span-2">
                                        <span class="text-gray-900 font-medium">{{ $product->size }}</span>
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if($product->material)
                            <div class="product-info-card rounded-xl p-6 border border-gray-200">
                                <div class="grid md:grid-cols-3 gap-6">
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mr-4">
                                            <i class='bx bxs-layer text-yellow-600 text-xl'></i>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-700">Material</div>
                                            <div class="text-gray-600 text-sm">Construction material</div>
                                        </div>
                                    </div>
                                    <div class="md:col-span-2">
                                        <span class="text-gray-900 font-medium">{{ $product->material }}</span>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Reviews Tab -->
                <div id="content-reviews" class="tab-content">
                    <div class="grid gap-8 lg:grid-cols-3">
                        <!-- Review Summary -->
                        <div class="lg:col-span-1">
                            <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl p-6 border border-indigo-100 sticky top-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                                    <i class='bx bx-star text-yellow-500 mr-2'></i>
                                    Customer Reviews
                                </h3>

                                <div class="text-center mb-6">
                                    <div class="text-4xl font-bold text-gray-900 mb-2">
                                        {{ number_format(HelperFunctions::getRatingAverage('product', $product->id), 1) }}
                                    </div>
                                    
                                    <!-- Custom Star Rating Display -->
                                    <div class="flex items-center justify-center mb-2">
                                        @php $rating = HelperFunctions::getRatingAverage('product', $product->id); @endphp
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
                                        Based on {{ $product->getReviews()->count() }} {{ Str::plural('review', $product->getReviews()->count()) }}
                                    </p>
                                </div>

                                @auth
                                    @if(auth()->user()->hasRated("product", $product->id))
                                        <div class="bg-green-100 text-green-800 p-4 rounded-xl text-center">
                                            <i class='bx bx-check-circle text-2xl mb-2'></i>
                                            <p class="font-medium">Thank you for your review!</p>
                                        </div>
                                    @else
                                        <button onclick="showReviewModal()"
                                                class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold py-3 rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105">
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
                            
                            @if($product->getReviews()->count() > 0)
                                <div class="space-y-4">
                                    @foreach($product->getReviews() as $item)
                                        <div class="review-card rounded-2xl p-6 border border-gray-200 hover:shadow-lg transition-all duration-300">
                                            <div class="flex items-start justify-between mb-4">
                                                <div class="flex items-center">
                                                    <div class="w-12 h-12 bg-gradient-to-br from-indigo-400 to-purple-600 rounded-full flex items-center justify-center text-white font-bold mr-4">
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
                                    {{ $product->getReviews()->links() }}
                                </div>
                            @else
                                <div class="text-center py-12 bg-gray-50 rounded-2xl">
                                    <i class='bx bx-message-dots text-6xl text-gray-300 mb-4'></i>
                                    <h4 class="text-lg font-semibold text-gray-600 mb-2">No Reviews Yet</h4>
                                    <p class="text-gray-500">Be the first to review this product!</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products Section -->
        @if($related_products && $related_products->count() > 0)
        <section class="mb-12">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-3xl font-bold text-gray-900 flex items-center">
                    <i class='bx bx-package text-indigo-600 mr-3'></i>
                    Related Products
                </h2>
                <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-medium">
                    {{ $related_products->count() }} {{ Str::plural('Product', $related_products->count()) }}
                </span>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($related_products as $item)
                    <div class="related-product-card bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden group relative">
                        @if($item->is_featured)
                            <div class="absolute top-3 left-3 z-10 bg-gradient-to-r from-red-500 to-pink-600 text-white px-2 py-1 rounded-full text-xs font-bold shadow-lg">
                                <i class='bx bx-star mr-1'></i>
                                Featured
                            </div>
                        @endif

                        <!-- Product Image -->
                        <div class="relative h-48 bg-gray-50 overflow-hidden">
                            <a href="{{ route('view.product', [$item->slug]) }}">
                                <img alt="{{ $item->name }}" 
                                     src="{{ url('storage/' . $item->thumbnail) }}"
                                     class="w-full h-full object-contain p-4 group-hover:scale-110 transition-transform duration-300">
                            </a>
                        </div>

                        <!-- Product Info -->
                        <div class="p-4">
                            <div class="flex items-center text-xs text-indigo-600 mb-2">
                                <i class='bx bx-category mr-1'></i>
                                {{ $item->category->name ?? 'General' }}
                            </div>

                            <h4 class="font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-indigo-600 transition-colors">
                                <a href="{{ route('view.product', [$item->slug]) }}">
                                    {{ $item->name }}
                                </a>
                            </h4>

                            <div class="text-sm text-gray-600 mb-3 space-y-1">
                                <div class="flex items-center">
                                    <i class='bx bx-building text-red-500 mr-2'></i>
                                    {{ $item->company->name ?? '' }}
                                </div>
                                <div class="flex items-center">
                                    <i class='bx bx-map text-blue-500 mr-2'></i>
                                    {{ $item->company->address->country->name ?? '' }}
                                </div>
                            </div>

                            <div class="flex items-center justify-between mb-4">
                                <span class="text-lg font-bold text-green-600">
                                    ${{ HelperFunctions::formatCurrency($item->price) }}
                                </span>
                                @if($item->condition)
                                    <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded-full text-xs">
                                        {{ $item->condition }}
                                    </span>
                                @endif
                            </div>

                            <a href="{{ route('view.product', [$item->slug]) }}"
                               class="block w-full text-center bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-semibold py-3 rounded-xl hover:from-purple-700 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105">
                                <i class='bx bx-cart mr-2'></i>
                                View Product
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
                    <h3 class="text-2xl font-bold text-gray-900">Rate This Product</h3>
                    <button onclick="hideReviewModal()" class="text-gray-400 hover:text-gray-600 text-2xl">
                        <i class='bx bx-x'></i>
                    </button>
                </div>
                
                <form id="reviewForm" onsubmit="submitReview(event)">
                    @csrf
                    <div class="space-y-6">
                        <div class="text-center">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Rate this product</label>
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
                                      placeholder="Share your experience with this product..."
                                      class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 resize-none"
                                      required></textarea>
                        </div>
                    </div>
                    
                    <input type="hidden" name="item_id" value="{{ $product->id }}">
                    
                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" onclick="hideReviewModal()" 
                                class="px-6 py-3 text-gray-600 hover:text-gray-800 font-medium transition-colors">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105">
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
            <img id="zoomedImage" src="" alt="Zoomed product image" class="max-w-full max-h-full object-contain">
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
                button.classList.remove('active', 'text-indigo-600', 'bg-white', 'border-indigo-600');
                button.classList.add('text-gray-700');
            });
            
            // Show selected tab content
            const selectedContent = document.getElementById('content-' + tabName);
            const selectedButton = document.getElementById('tab-' + tabName);
            
            if (selectedContent && selectedButton) {
                selectedContent.classList.add('active');
                selectedButton.classList.add('active', 'text-indigo-600', 'bg-white', 'border-indigo-600');
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
                const response = await fetch('{{ route('api.product.rate', ['type' => 'product']) }}', {
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

        // Wishlist Function
        async function addToWishlist(productId) {
            try {
                // Show loading state
                const button = event.target;
                const originalText = button.innerHTML;
                button.innerHTML = '<i class="bx bx-loader-alt animate-spin mr-2"></i>Adding...';
                
                // Simulate API call (replace with actual endpoint)
                await new Promise(resolve => setTimeout(resolve, 1000));
                
                button.innerHTML = '<i class="bx bxs-heart mr-2"></i>Added to Wishlist';
                button.classList.add('bg-green-100', 'text-green-700');
                
                showNotification('Product added to wishlist!', 'success');
                
                setTimeout(() => {
                    button.innerHTML = originalText;
                    button.classList.remove('bg-green-100', 'text-green-700');
                }, 3000);
                
            } catch (error) {
                console.error('Error adding to wishlist:', error);
                showNotification('Failed to add to wishlist. Please try again.', 'error');
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
            
            // Add smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

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
            document.querySelectorAll('.related-product-card, .review-card').forEach(el => {
                observer.observe(el);
            });
        });

        // Performance optimization: Lazy load related products
        const relatedProductsObserver = new IntersectionObserver((entries) => {
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

        document.querySelectorAll('.related-product-card').forEach(card => {
            relatedProductsObserver.observe(card);
        });
    </script>
@endsection