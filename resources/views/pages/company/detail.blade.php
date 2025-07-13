@php
    use App\classes\HelperFunctions;
@endphp
@extends('layouts.user')

@section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.css"
        integrity="sha512-eG8C/4QWvW9MQKJNw2Xzr0KW7IcfBSxljko82RuSs613uOAg/jHEeuez4dfFgto1u6SRI/nXmTr9YPCjs1ozBg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.js"
        integrity="sha512-MdZwHb4u4qCy6kVoTLL8JxgPnARtbNCUIjTCihWcgWhCsLfDaQJib4+OV0O8IS+ea+3Xv/6pH3vYY4LWpU/gbQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        /* Custom animations and effects */
        .company-hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .company-logo {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .company-logo:hover {
            transform: scale(1.05);
        }

        .stats-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .stats-card:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .tab-content {
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

        .product-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .gallery-item {
            transition: all 0.3s ease;
        }

        .gallery-item:hover {
            transform: scale(1.02);
        }

        .floating-badge {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .review-card {
            background: linear-gradient(145deg, #f8fafc, #e2e8f0);
            transition: all 0.3s ease;
        }

        .review-card:hover {
            background: linear-gradient(145deg, #e2e8f0, #cbd5e1);
        }

        .info-row {
            background: linear-gradient(90deg, transparent, rgba(99, 102, 241, 0.03), transparent);
            transition: all 0.3s ease;
        }

        .info-row:hover {
            background: linear-gradient(90deg, transparent, rgba(99, 102, 241, 0.08), transparent);
        }
    </style>

    {{-- Tab Navigation CSS --}}
    <style>
    /* Custom Tab Styles */
    .tab-button {
        position: relative;
    }

    .tab-button.active {
        color: #4f46e5;
        background-color: white;
        border-bottom-color: #4f46e5;
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

    /* Review Modal Animation */
    #reviewModal {
        backdrop-filter: blur(4px);
    }

    #reviewModal .bg-white {
        animation: modalSlideIn 0.3s ease-out;
    }

    @keyframes modalSlideIn {
        from {
            opacity: 0;
            transform: scale(0.9) translateY(-20px);
        }
        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    /* Star Rating Hover Effects */
    .rating-star:hover,
    .rating-star.active {
        transform: scale(1.1);
    }

    .rating-star.filled i {
        color: #fbbf24 !important;
    }

    /* Product Card Hover Effects */
    .product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    /* Info Row Hover Effects */
    .info-row:hover {
        background: linear-gradient(90deg, transparent, rgba(99, 102, 241, 0.08), transparent);
    }

    /* Review Card Hover Effects */
    .review-card:hover {
        background: linear-gradient(145deg, #e2e8f0, #cbd5e1);
    }
    </style>

    {{-- Contact Tab Specific CSS --}}
    <style>
    /* Enhanced Contact Tab Styles */
    .contact-card {
        position: relative;
        overflow: hidden;
    }

    .contact-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        transition: left 0.5s;
    }

    .contact-card:hover::before {
        left: 100%;
    }

    /* Form Animation */
    #quickContactForm input:focus,
    #quickContactForm textarea:focus {
        transform: scale(1.02);
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }

    /* FAQ Hover Effect */
    .md\:grid-cols-2 > div:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .contact-card {
            margin-bottom: 1rem;
        }
        
        .sticky {
            position: static;
        }
    }
    </style>

    <x-seo :modal="$company" title="name" />
@endsection

@section('content')
    <!-- Enhanced Company Hero Section -->
    <section class="company-hero relative overflow-hidden py-8 md:py-16">
        <!-- Background Elements -->
        <div class="absolute inset-0 bg-black opacity-20"></div>
        <div class="absolute top-10 left-10 w-32 h-32 bg-white opacity-10 rounded-full blur-xl"></div>
        <div class="absolute bottom-10 right-10 w-48 h-48 bg-yellow-300 opacity-10 rounded-full blur-xl"></div>

        <div class="relative z-10 container mx-auto px-4 bg-transparent">
            <div class="flex flex-col lg:flex-row items-center lg:items-start gap-8">
                <!-- Company Logo & Basic Info -->
                <div class="flex flex-col md:flex-row items-center lg:items-start gap-6 lg:gap-8 flex-1">
                    <!-- Logo -->
                    <div class="relative">
                        <div
                            class="company-logo w-24 h-24 md:w-32 md:h-32 lg:w-40 lg:h-40 bg-white rounded-2xl p-4 shadow-xl">
                            <img alt="{{ $company->name }} logo" src="{{ url('storage/', $company->logo) }}"
                                class="w-full h-full object-contain">
                        </div>

                        <!-- Floating Badges -->
                        @if($company->is_featured)
                            <div
                                class="floating-badge absolute -top-2 -right-2 bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                                <i class='bx bx-star mr-1'></i>
                                Featured
                            </div>
                        @endif

                        @if($company->is_approved)
                            <div
                                class="absolute -bottom-2 -right-2 bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                                <i class='bx bx-badge-check mr-1'></i>
                                Verified
                            </div>
                        @endif
                    </div>

                    <!-- Company Info -->
                    <div class="flex-1 text-center lg:text-left">
                        <div class="mb-4">
                            <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-white mb-2">
                                {{ $company->name }}
                            </h1>
                            <div class="flex items-center justify-center lg:justify-start text-white opacity-90 mb-2">
                                <i class='bx bx-map text-lg mr-2'></i>
                                <span class="text-sm md:text-base">
                                    {{ $company->address->country->name }}, {{ $company->address->zip_code }}
                                </span>
                            </div>
                            <div class="flex items-center justify-center lg:justify-start text-white opacity-90">
                                <i class='bx bx-category text-lg mr-2'></i>
                                <span class="text-sm md:text-base">{{ $company->category->name ?? 'Business' }}</span>
                            </div>
                        </div>

                        <!-- Stats Cards -->
                        <div class="grid grid-cols-3 gap-4 max-w-md mx-auto lg:mx-0">
                            <div class="stats-card rounded-xl p-4 text-center text-white backdrop-blur-sm">
                                <div class="text-lg md:text-xl font-bold">
                                    {{ HelperFunctions::getRatingCount('company', $company->id) }}
                                </div>
                                <div class="text-xs md:text-sm opacity-90">Reviews</div>
                            </div>
                            <div class="stats-card rounded-xl p-4 text-center text-white backdrop-blur-sm">
                                <div class="text-lg md:text-xl font-bold">
                                    {{ number_format(HelperFunctions::getRatingAverage('company', $company->id), 1) }}
                                </div>
                                <div class="text-xs md:text-sm opacity-90">Rating</div>
                            </div>
                            <div class="stats-card rounded-xl p-4 text-center text-white backdrop-blur-sm">
                                <div class="text-lg md:text-xl font-bold">{{ $company->products->count() }}</div>
                                <div class="text-xs md:text-sm opacity-90">Products</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col gap-3 min-w-fit">
                    <div class="flex flex-col sm:flex-row lg:flex-col gap-3">
                        <a href="{{ route('direct-message', ['company_id' => $company->id]) }}"
                            class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-semibold rounded-xl hover:from-purple-700 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                            <i class='bx bx-message-dots mr-2'></i>
                            Send Message
                        </a>

                        @if($user->isCompanyBookmarked($company))
                            <a href="{{ route('remove.from.bookmark', ['company_id' => $company->id]) }}"
                                class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-semibold rounded-xl hover:from-green-600 hover:to-emerald-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                                <i class='bx bx-bookmark mr-2'></i>
                                Bookmarked
                            </a>
                        @else
                            <a href="{{ route('add.to.bookmark', ['company_id' => $company->id]) }}"
                                class="inline-flex items-center justify-center px-6 py-3 bg-white text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition-all duration-300 transform hover:scale-105 shadow-lg border">
                                <i class='bx bx-bookmark mr-2'></i>
                                Bookmark
                            </a>
                        @endif
                    </div>

                    @if($user->id != $company->user_id && !$company->is_claimed)
                        <a href="{{ route('view.claim.company', ['company_id' => $company->id]) }}"
                            class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-amber-400 to-orange-500 text-white font-medium rounded-lg hover:from-amber-500 hover:to-orange-600 transition-all duration-300 text-sm shadow-lg">
                            <i class='bx bx-user-check mr-2'></i>
                            Claim This Business
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <div class="container mx-auto px-4 py-8 max-w-7xl">
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden mb-8">
            <!-- Custom Tab Navigation -->
            <div class="flex flex-wrap border-b border-gray-200 bg-gray-50">
                <button onclick="switchTab('desc')" id="tab-desc" 
                        class="tab-button active flex-1 min-w-0 px-4 py-4 text-center font-semibold text-gray-700 hover:text-indigo-600 hover:bg-white transition-all duration-200 border-b-2 border-transparent">
                    <i class='bx bx-info-circle mr-2'></i>
                    <span class="hidden sm:inline">About</span>
                </button>
                <button onclick="switchTab('product')" id="tab-product" 
                        class="tab-button flex-1 min-w-0 px-4 py-4 text-center font-semibold text-gray-700 hover:text-indigo-600 hover:bg-white transition-all duration-200 border-b-2 border-transparent">
                    <i class='bx bx-package mr-2'></i>
                    <span class="hidden sm:inline">Products</span>
                </button>
                <button onclick="switchTab('contact')" id="tab-contact" 
                        class="tab-button flex-1 min-w-0 px-4 py-4 text-center font-semibold text-gray-700 hover:text-indigo-600 hover:bg-white transition-all duration-200 border-b-2 border-transparent">
                    <i class='bx bx-phone mr-2'></i>
                    <span class="hidden sm:inline">Contact</span>
                </button>
                <button onclick="switchTab('rate')" id="tab-rate" 
                        class="tab-button flex-1 min-w-0 px-4 py-4 text-center font-semibold text-gray-700 hover:text-indigo-600 hover:bg-white transition-all duration-200 border-b-2 border-transparent">
                    <i class='bx bx-star mr-2'></i>
                    <span class="hidden sm:inline">Reviews</span>
                </button>
            </div>

            <!-- Tab Content Container -->
            <div class="tab-content-container">
                <!-- About Tab -->
                <div id="content-desc" class="tab-content active">
                    <div class="p-6">
                        <!-- Company Information Grid -->
                        <div class="space-y-4 mb-8">
                            <div class="info-row flex flex-col md:flex-row md:items-center py-4 px-6 rounded-xl border border-gray-100">
                                <div class="flex items-center mb-2 md:mb-0 md:w-1/3">
                                    <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center mr-4">
                                        <i class='bx bx-category text-indigo-600 text-xl'></i>
                                    </div>
                                    <span class="font-semibold text-gray-700">Business Type</span>
                                </div>
                                <div class="md:w-2/3">
                                    <span class="text-purple-600 font-medium">{{ $company->business_type }}</span>
                                </div>
                            </div>

                            <div class="info-row flex flex-col md:flex-row md:items-center py-4 px-6 rounded-xl border border-gray-100">
                                <div class="flex items-center mb-2 md:mb-0 md:w-1/3">
                                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                                        <i class='bx bx-calendar text-green-600 text-xl'></i>
                                    </div>
                                    <span class="font-semibold text-gray-700">Established</span>
                                </div>
                                <div class="md:w-2/3">
                                    <span class="text-gray-600">{{ $company->established_at }}</span>
                                </div>
                            </div>

                            <div class="info-row flex flex-col md:flex-row md:items-center py-4 px-6 rounded-xl border border-gray-100">
                                <div class="flex items-center mb-2 md:mb-0 md:w-1/3">
                                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                                        <i class='bx bx-group text-blue-600 text-xl'></i>
                                    </div>
                                    <span class="font-semibold text-gray-700">Team Size</span>
                                </div>
                                <div class="md:w-2/3">
                                    <span class="text-gray-600">
                                        {{ $company->number_of_employees ? $company->number_of_employees . ' employees' : 'Not Disclosed' }}
                                    </span>
                                </div>
                            </div>

                            <div class="info-row flex flex-col md:flex-row md:items-center py-4 px-6 rounded-xl border border-gray-100">
                                <div class="flex items-center mb-2 md:mb-0 md:w-1/3">
                                    <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mr-4">
                                        <i class='bx bx-trending-up text-yellow-600 text-xl'></i>
                                    </div>
                                    <span class="font-semibold text-gray-700">Annual Turnover</span>
                                </div>
                                <div class="md:w-2/3">
                                    <span class="text-gray-600">{{ $company->turnover ? '$' . number_format($company->turnover) : 'Not Disclosed' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Company Description -->
                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                                <i class='bx bx-info-circle text-indigo-600 mr-3'></i>
                                About {{ $company->name }}
                            </h3>
                            <div class="prose prose-gray max-w-none text-gray-700 leading-relaxed">
                                {!! $company->description !!}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Products Tab -->
                <div id="content-product" class="tab-content">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-2xl font-bold text-gray-900">Our Products</h3>
                            <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-medium">
                                {{ $company->products->count() }} {{ Str::plural('Product', $company->products->count()) }}
                            </span>
                        </div>

                        @if($company->products->count() > 0)
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                                @foreach($company->products as $item)
                                    <div class="product-card bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden group relative">
                                        <!-- Featured Badge -->
                                        @if($item->is_featured)
                                            <div class="absolute top-3 left-3 z-10 bg-gradient-to-r from-red-500 to-pink-600 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                                                <i class='bx bx-star mr-1'></i>
                                                Featured
                                            </div>
                                        @endif

                                        <!-- Product Image -->
                                        <div class="relative h-48 bg-gray-50 overflow-hidden">
                                            <a href="{{ route('view.product', [$item->slug]) }}">
                                                <img alt="{{ $item->name }}" src="{{ url('storage/' . $item->thumbnail) }}"
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
                                                    {{ $item->company->name ?? $company->name }}
                                                </div>
                                                <div class="flex items-center">
                                                    <i class='bx bx-map text-blue-500 mr-2'></i>
                                                    {{ $item->company->address->country->name ?? $company->address->country->name }}
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
                                                Enquire Now
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-12 bg-gray-50 rounded-2xl">
                                <i class='bx bx-package text-6xl text-gray-300 mb-4'></i>
                                <h4 class="text-lg font-semibold text-gray-600 mb-2">No Products Found</h4>
                                <p class="text-gray-500">This company hasn't listed any products yet.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Contact Tab -->
                <div id="content-contact" class="tab-content">
                    <div class="p-6">
                        <div class="max-w-6xl mx-auto">
                            <!-- Header Section -->
                            <div class="text-center mb-8">
                                <h3 class="text-3xl font-bold text-gray-900 mb-3 flex items-center justify-center">
                                    <i class='bx bx-phone text-indigo-600 mr-3'></i>
                                    Get In Touch
                                </h3>
                                <p class="text-gray-600 max-w-2xl mx-auto">
                                    Ready to connect with {{ $company->name }}? Choose your preferred way to reach out and start the conversation.
                                </p>
                            </div>

                            <div class="grid lg:grid-cols-3 gap-8">
                                <!-- Contact Information Cards -->
                                <div class="lg:col-span-2">
                                    <div class="grid gap-6">
                                        <!-- Address Card -->
                                        <div class="contact-card group bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-100 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                                            <div class="flex items-start">
                                                <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mr-4 mt-1 group-hover:bg-blue-200 transition-colors duration-300">
                                                    <i class='bx bx-map text-blue-600 text-2xl group-hover:scale-110 transition-transform duration-300'></i>
                                                </div>
                                                <div class="flex-1">
                                                    <h4 class="font-bold text-gray-900 mb-2 text-lg">Visit Our Office</h4>
                                                    <p class="text-gray-700 leading-relaxed mb-3">{{ $company->fullAddress() }}</p>
                                                    <div class="flex flex-wrap gap-2">
                                                        <button onclick="copyToClipboard('{{ $company->fullAddress() }}', this)" 
                                                                class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm hover:bg-blue-200 transition-colors">
                                                            <i class='bx bx-copy mr-1'></i>
                                                            Copy Address
                                                        </button>
                                                        <a href="https://maps.google.com?q={{ urlencode($company->fullAddress()) }}" 
                                                        target="_blank"
                                                        class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm hover:bg-blue-200 transition-colors">
                                                            <i class='bx bx-map-pin mr-1'></i>
                                                            View on Map
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Email Card -->
                                        <div class="contact-card group bg-gradient-to-r from-green-50 to-emerald-50 rounded-2xl p-6 border border-green-100 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                                            <div class="flex items-start">
                                                <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center mr-4 mt-1 group-hover:bg-green-200 transition-colors duration-300">
                                                    <i class='bx bx-envelope text-green-600 text-2xl group-hover:scale-110 transition-transform duration-300'></i>
                                                </div>
                                                <div class="flex-1">
                                                    <h4 class="font-bold text-gray-900 mb-2 text-lg">Email Us</h4>
                                                    <p class="text-gray-700 mb-3">{{ HelperFunctions::secureEmailAddress($company->email) }}</p>
                                                    <div class="flex flex-wrap gap-2">
                                                        <button onclick="copyToClipboard('{{ $company->email }}', this)" 
                                                                class="inline-flex items-center px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm hover:bg-green-200 transition-colors">
                                                            <i class='bx bx-copy mr-1'></i>
                                                            Copy Email
                                                        </button>
                                                        <a href="mailto:{{ $company->email }}" 
                                                        class="inline-flex items-center px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm hover:bg-green-200 transition-colors">
                                                            <i class='bx bx-send mr-1'></i>
                                                            Send Email
                                                        </a>
                                                    </div>
                                                    <div class="mt-3 text-sm text-gray-600">
                                                        <i class='bx bx-time mr-1'></i>
                                                        We typically respond within 24 hours
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Phone Card -->
                                        <div class="contact-card group bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl p-6 border border-purple-100 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                                            <div class="flex items-start">
                                                <div class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center mr-4 mt-1 group-hover:bg-purple-200 transition-colors duration-300">
                                                    <i class='bx bx-phone text-purple-600 text-2xl group-hover:scale-110 transition-transform duration-300'></i>
                                                </div>
                                                <div class="flex-1">
                                                    <h4 class="font-bold text-gray-900 mb-2 text-lg">Call Us</h4>
                                                    <p class="text-gray-700 mb-3">{{ HelperFunctions::securePhoneNumber($company->phone) }}</p>
                                                    <div class="flex flex-wrap gap-2">
                                                        <button onclick="copyToClipboard('{{ $company->phone }}', this)" 
                                                                class="inline-flex items-center px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-sm hover:bg-purple-200 transition-colors">
                                                            <i class='bx bx-copy mr-1'></i>
                                                            Copy Number
                                                        </a>
                                                        <a href="tel:{{ $company->phone }}" 
                                                        class="inline-flex items-center px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-sm hover:bg-purple-200 transition-colors">
                                                            <i class='bx bx-phone-call mr-1'></i>
                                                            Call Now
                                                        </a>
                                                    </div>
                                                    <div class="mt-3 text-sm text-gray-600">
                                                        <i class='bx bx-clock mr-1'></i>
                                                        Business Hours: Mon-Fri 9AM-6PM
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Website Card -->
                                        <div class="contact-card group bg-gradient-to-r from-orange-50 to-yellow-50 rounded-2xl p-6 border border-orange-100 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                                            <div class="flex items-start">
                                                <div class="w-14 h-14 bg-orange-100 rounded-full flex items-center justify-center mr-4 mt-1 group-hover:bg-orange-200 transition-colors duration-300">
                                                    <i class='bx bx-globe text-orange-600 text-2xl group-hover:scale-110 transition-transform duration-300'></i>
                                                </div>
                                                <div class="flex-1">
                                                    <h4 class="font-bold text-gray-900 mb-2 text-lg">Visit Our Website</h4>
                                                    <p class="text-gray-700 mb-3">{{ HelperFunctions::secureWebsiteUrl($company->website) }}</p>
                                                    <div class="flex flex-wrap gap-2">
                                                        <button onclick="copyToClipboard('{{ $company->website }}', this)" 
                                                                class="inline-flex items-center px-3 py-1 bg-orange-100 text-orange-700 rounded-full text-sm hover:bg-orange-200 transition-colors">
                                                            <i class='bx bx-copy mr-1'></i>
                                                            Copy URL
                                                        </button>
                                                        <a href="{{ $company->website }}" target="_blank" 
                                                        class="inline-flex items-center px-3 py-1 bg-orange-100 text-orange-700 rounded-full text-sm hover:bg-orange-200 transition-colors">
                                                            <i class='bx bx-link-external mr-1'></i>
                                                            Visit Site
                                                        </a>
                                                    </div>
                                                    <div class="mt-3 text-sm text-gray-600">
                                                        <i class='bx bx-info-circle mr-1'></i>
                                                        Learn more about our services and portfolio
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Quick Actions Sidebar -->
                                <div class="lg:col-span-1">
                                    <div class="sticky top-6 space-y-6">
                                        <!-- Quick Contact Card -->
                                        <div class="bg-gradient-to-br from-indigo-600 to-purple-700 rounded-2xl p-6 text-white">
                                            <h4 class="text-xl font-bold mb-4 flex items-center">
                                                <i class='bx bx-rocket mr-2'></i>
                                                Quick Connect
                                            </h4>
                                            <p class="text-indigo-100 mb-6 text-sm">
                                                Get instant responses and personalized assistance through our direct messaging system.
                                            </p>
                                            <a href="{{ route('direct-message', ['company_id' => $company->id]) }}"
                                            class="block w-full text-center bg-white bg-opacity-20 backdrop-blur-sm text-white font-semibold py-3 rounded-xl hover:bg-opacity-30 transition-all duration-300 transform hover:scale-105 border border-white border-opacity-20">
                                                <i class='bx bx-message-dots mr-2'></i>
                                                Send Direct Message
                                            </a>
                                        </div>

                                        <!-- Business Hours Card -->
                                        <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm">
                                            <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                                                <i class='bx bx-time text-green-600 mr-2'></i>
                                                Business Hours
                                            </h4>
                                            <div class="space-y-2 text-sm">
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">Monday - Friday</span>
                                                    <span class="font-medium text-gray-900">9:00 AM - 6:00 PM</span>
                                                </div>
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">Saturday</span>
                                                    <span class="font-medium text-gray-900">10:00 AM - 4:00 PM</span>
                                                </div>
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">Sunday</span>
                                                    <span class="font-medium text-red-600">Closed</span>
                                                </div>
                                            </div>
                                            <div class="mt-4 p-3 bg-green-50 rounded-lg">
                                                <div class="flex items-center text-green-800">
                                                    <i class='bx bx-check-circle mr-2'></i>
                                                    <span class="text-sm font-medium">We're currently open!</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Response Time Card -->
                                        <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm">
                                            <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                                                <i class='bx bx-stopwatch text-blue-600 mr-2'></i>
                                                Response Time
                                            </h4>
                                            <div class="space-y-3">
                                                <div class="flex items-center">
                                                    <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900">Direct Messages</div>
                                                        <div class="text-xs text-gray-600">Usually within 1 hour</div>
                                                    </div>
                                                </div>
                                                <div class="flex items-center">
                                                    <div class="w-3 h-3 bg-blue-500 rounded-full mr-3"></div>
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900">Email Inquiries</div>
                                                        <div class="text-xs text-gray-600">Within 24 hours</div>
                                                    </div>
                                                </div>
                                                <div class="flex items-center">
                                                    <div class="w-3 h-3 bg-purple-500 rounded-full mr-3"></div>
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900">Phone Calls</div>
                                                        <div class="text-xs text-gray-600">Immediate during business hours</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Social Media Links (if available) -->
                                        @if($company->facebook || $company->twitter || $company->linkedin || $company->instagram)
                                        <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm">
                                            <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                                                <i class='bx bx-share-alt text-indigo-600 mr-2'></i>
                                                Follow Us
                                            </h4>
                                            <div class="flex flex-wrap gap-3">
                                                @if($company->facebook)
                                                    <a href="{{ $company->facebook }}" target="_blank" 
                                                    class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center text-white hover:bg-blue-700 transition-colors">
                                                        <i class='bx bxl-facebook'></i>
                                                    </a>
                                                @endif
                                                @if($company->twitter)
                                                    <a href="{{ $company->twitter }}" target="_blank" 
                                                    class="w-10 h-10 bg-sky-500 rounded-full flex items-center justify-center text-white hover:bg-sky-600 transition-colors">
                                                        <i class='bx bxl-twitter'></i>
                                                    </a>
                                                @endif
                                                @if($company->linkedin)
                                                    <a href="{{ $company->linkedin }}" target="_blank" 
                                                    class="w-10 h-10 bg-blue-700 rounded-full flex items-center justify-center text-white hover:bg-blue-800 transition-colors">
                                                        <i class='bx bxl-linkedin'></i>
                                                    </a>
                                                @endif
                                                @if($company->instagram)
                                                    <a href="{{ $company->instagram }}" target="_blank" 
                                                    class="w-10 h-10 bg-gradient-to-br from-purple-600 to-pink-600 rounded-full flex items-center justify-center text-white hover:from-purple-700 hover:to-pink-700 transition-all">
                                                        <i class='bx bxl-instagram'></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Form Section -->
                            <div class="mt-12">
                                <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-2xl p-8">
                                    <div class="max-w-2xl mx-auto text-center">
                                        <h4 class="text-2xl font-bold text-gray-900 mb-4">
                                            <i class='bx bx-envelope-open text-indigo-600 mr-2'></i>
                                            Send Us a Message
                                        </h4>
                                        <p class="text-gray-600 mb-8">
                                            Have a specific question or inquiry? Fill out our quick contact form and we'll get back to you promptly.
                                        </p>
                                        
                                        <form id="quickContactForm" class="space-y-6">
                                            <div class="grid md:grid-cols-2 gap-6">
                                                <div>
                                                    <label for="contactName" class="block text-sm font-medium text-gray-700 mb-2">Your Name</label>
                                                    <input type="text" id="contactName" name="name" required
                                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                                                </div>
                                                <div>
                                                    <label for="contactEmail" class="block text-sm font-medium text-gray-700 mb-2">Your Email</label>
                                                    <input type="email" id="contactEmail" name="email" required
                                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                                                </div>
                                            </div>
                                            <div>
                                                <label for="contactSubject" class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                                                <input type="text" id="contactSubject" name="subject" required
                                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                                            </div>
                                            <div>
                                                <label for="contactMessage" class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                                                <textarea id="contactMessage" name="message" rows="4" required
                                                        placeholder="Tell us how we can help you..."
                                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors resize-none"></textarea>
                                            </div>
                                            <button type="submit" 
                                                    class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold py-4 rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                                                <i class='bx bx-send mr-2'></i>
                                                Send Message
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- FAQ Section -->
                            <div class="mt-12">
                                <div class="text-center mb-8">
                                    <h4 class="text-2xl font-bold text-gray-900 mb-3">
                                        <i class='bx bx-help-circle text-indigo-600 mr-2'></i>
                                        Frequently Asked Questions
                                    </h4>
                                    <p class="text-gray-600">Quick answers to common questions about {{ $company->name }}</p>
                                </div>
                                
                                <div class="grid md:grid-cols-2 gap-6">
                                    <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                                        <h5 class="font-semibold text-gray-900 mb-2">What are your business hours?</h5>
                                        <p class="text-gray-600 text-sm">We're open Monday through Friday from 9:00 AM to 6:00 PM, and Saturdays from 10:00 AM to 4:00 PM.</p>
                                    </div>
                                    <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                                        <h5 class="font-semibold text-gray-900 mb-2">How quickly do you respond to inquiries?</h5>
                                        <p class="text-gray-600 text-sm">We typically respond to direct messages within an hour and emails within 24 hours during business days.</p>
                                    </div>
                                    <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                                        <h5 class="font-semibold text-gray-900 mb-2">Do you offer consultations?</h5>
                                        <p class="text-gray-600 text-sm">Yes! We offer free initial consultations to discuss your needs and how we can help.</p>
                                    </div>
                                    <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                                        <h5 class="font-semibold text-gray-900 mb-2">What's the best way to reach you?</h5>
                                        <p class="text-gray-600 text-sm">For urgent matters, call us directly. For detailed inquiries, our direct messaging system works best.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reviews Tab -->
                <div id="content-rate" class="tab-content">
                    <div class="p-6">
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
                                            {{ number_format(HelperFunctions::getRatingAverage('company', $company->id), 1) }}
                                        </div>
                                        
                                        <!-- Custom Star Rating Display -->
                                        <div class="flex items-center justify-center mb-2">
                                            @php $rating = HelperFunctions::getRatingAverage('company', $company->id); @endphp
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
                                            Based on {{ $company->getReviews()->count() }} {{ Str::plural('review', $company->getReviews()->count()) }}
                                        </p>
                                    </div>

                                    @auth
                                        @if(auth()->user()->hasRated("company", $company->id))
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

                                @if($company->getReviews()->count() > 0)
                                    <div class="space-y-4">
                                        @foreach($company->getReviews() as $item)
                                            <div class="review-card rounded-2xl p-6 border border-gray-200 hover:shadow-lg transition-all duration-300">
                                                <div class="flex items-start justify-between mb-4">
                                                    <div class="flex items-center">
                                                        <div class="w-12 h-12 bg-gradient-to-br from-indigo-400 to-purple-600 rounded-full flex items-center justify-center text-white font-bold mr-4">
                                                            {{ substr($item->user->name ?? $item->name, 0, 1) }}
                                                        </div>
                                                        <div>
                                                            <h4 class="font-semibold text-gray-900">{{ $item->user->name ?? $item->name }}</h4>
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
                                        {{ $company->getReviews()->links() }}
                                    </div>
                                @else
                                    <div class="text-center py-12 bg-gray-50 rounded-2xl">
                                        <i class='bx bx-message-dots text-6xl text-gray-300 mb-4'></i>
                                        <h4 class="text-lg font-semibold text-gray-600 mb-2">No Reviews Yet</h4>
                                        <p class="text-gray-500">Be the first to review this company!</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Custom Review Modal -->
        <div id="reviewModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
            <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 transform transition-all duration-300">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-2xl font-bold text-gray-900">Share Your Experience</h3>
                        <button onclick="hideReviewModal()" class="text-gray-400 hover:text-gray-600 text-2xl">
                            <i class='bx bx-x'></i>
                        </button>
                    </div>
                    
                    <form id="reviewForm" onsubmit="submitReview(event)">
                        @csrf
                        <div class="space-y-6">
                            <div class="text-center">
                                <label class="block text-sm font-semibold text-gray-700 mb-3">Rate this company</label>
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
                                        placeholder="Share your experience with this company..."
                                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 resize-none"
                                        required></textarea>
                            </div>
                        </div>
                        
                        <input type="hidden" name="item_id" value="{{ $company->id }}">
                        
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

        <!-- Gallery Section -->
        <section class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 mb-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                    <i class='bx bx-image text-indigo-600 mr-3'></i>
                    Gallery
                </h2>
                @if(json_decode($company->gallery ?? '[]'))
                    <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm font-medium">
                        {{ count(json_decode($company->gallery ?? '[]')) }}
                        {{ Str::plural('Image', count(json_decode($company->gallery ?? '[]'))) }}
                    </span>
                @endif
            </div>

            @php
                $galleryItems = json_decode($company->gallery ?? '[]');
            @endphp

            @if($galleryItems && count($galleryItems) > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" id="company-gallery">
                    @foreach($galleryItems as $item)
                        <div class="gallery-item group cursor-pointer rounded-xl overflow-hidden shadow-md hover:shadow-xl">
                            <img alt="Company gallery image" src="{{ url('storage/' . $item) }}"
                                class="w-full h-32 md:h-40 object-cover group-hover:scale-110 transition-transform duration-300">
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 bg-gray-50 rounded-2xl">
                    <i class='bx bx-image text-6xl text-gray-300 mb-4'></i>
                    <h4 class="text-lg font-semibold text-gray-600 mb-2">No Images Found</h4>
                    <p class="text-gray-500">This company hasn't uploaded any gallery images yet.</p>
                </div>
            @endif
        </section>

        <!-- Claim Business CTA -->
        @if($user->id != $company->user_id && !$company->is_claimed)
            <section class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl border border-amber-200 p-6 md:p-8 mb-8">
                <div class="flex flex-col lg:flex-row items-center gap-6">
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                            <i class='bx bx-crown text-amber-600 mr-3'></i>
                            Is this your business?
                        </h2>

                        <div class="grid sm:grid-cols-2 gap-4 mb-6">
                            <div class="flex items-center text-gray-700">
                                <i class='bx bx-check-circle text-green-600 mr-3'></i>
                                Update company information
                            </div>
                            <div class="flex items-center text-gray-700">
                                <i class='bx bx-check-circle text-green-600 mr-3'></i>
                                Respond to customer reviews
                            </div>
                            <div class="flex items-center text-gray-700">
                                <i class='bx bx-check-circle text-green-600 mr-3'></i>
                                Access premium features
                            </div>
                            <div class="flex items-center text-gray-700">
                                <i class='bx bx-check-circle text-green-600 mr-3'></i>
                                Boost your visibility
                            </div>
                        </div>
                    </div>

                    <div class="lg:w-auto">
                        <a href="{{ route('view.claim.company', ['company_id' => $company->id]) }}"
                            class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-amber-500 to-orange-600 text-white font-bold rounded-2xl hover:from-amber-600 hover:to-orange-700 transition-all duration-300 transform hover:scale-105 shadow-lg text-lg">
                            <i class='bx bx-user-check mr-3'></i>
                            Claim This Business
                        </a>
                    </div>
                </div>
            </section>
        @endif
    </div>

    <!-- Review Modal -->
    <x-bladewind::modal backdrop_can_close="false" name="rate" ok_button_action="saveRating('rate-company')"
        ok_button_label="Submit Review" close_after_action="false" center_action_buttons="true" size="medium">

        <div class="p-6">
            <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">Share Your Experience</h3>

            <form method="post" action="" id="rate-form">
                @csrf
                <div class="space-y-6">
                    <div class="text-center">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Rate this company</label>
                        <x-bladewind.rating name="rate-company" rating="1" size="big" />
                    </div>

                    <div>
                        <x-bladewind.textarea name="review" label="Write your review"
                            placeholder="Share your experience with this company..." rows="4" />
                    </div>
                </div>

                <input type="hidden" name="item_id" value="{{ $company->id }}">
            </form>
        </div>

        <x-bladewind::processing name="rate-processing" message="Submitting your review..." />

        <x-bladewind::process-complete name="rate-complete" process_completed_as="passed" button_label="Done"
            button_action="hideModal('rate')" message="Thank you! Your review has been submitted successfully." />
    </x-bladewind::modal>

    <div id="image-viewer"></div>
@endsection

@section('page-scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Initialize image gallery viewer
            const gallery = new Viewer(document.getElementById('company-gallery'), {
                toolbar: {
                    zoomIn: 4,
                    zoomOut: 4,
                    oneToOne: 4,
                    reset: 4,
                    prev: 4,
                    next: 4,
                    rotateLeft: 4,
                    rotateRight: 4,
                    flipHorizontal: 4,
                    flipVertical: 4,
                },
                navbar: 4,
                title: 4,
            });

            // Smooth scrolling for internal links
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

            // Add animation to stats cards on scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.animationPlayState = 'running';
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.stats-card, .product-card, .gallery-item').forEach(el => {
                observer.observe(el);
            });
        });

        @auth
            // Enhanced rating submission function
            saveRating = async function (element) {
                try {
                    showProcessing('rate-processing');

                    let form = document.getElementById('rate-form');
                    let item_id = form.querySelector('input[name="item_id"]').value;
                    let rating = dom_el(`.rating-value-${element}`).value;
                    let review = form.querySelector('textarea[name="review"]').value;

                    if (!review.trim()) {
                        hideProcessing('rate-processing');
                        alert('Please write a review before submitting.');
                        return;
                    }

                    let url = '{{ route('api.product.rate', ['type' => 'company']) }}';
                    let headersList = {
                        "Accept": "application/json",
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                    }

                    let bodyContent = JSON.stringify({
                        "item_id": item_id,
                        "rating": rating,
                        "review": review,
                        "user_id": "{{ auth()->user()->id }}"
                    });

                    let response = await fetch(url, {
                        method: "POST",
                        body: bodyContent,
                        headers: headersList
                    });

                    let data = await response.json();

                    hideProcessing('rate-processing');

                    if (data.status === 'success') {
                        hideModal('rate');
                        showProcessComplete('rate-complete');

                        // Refresh page after a short delay
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    } else {
                        alert('Error submitting review: ' + (data.message || 'Unknown error'));
                    }
                } catch (error) {
                    hideProcessing('rate-processing');
                    console.error('Error:', error);
                    alert('Error submitting review. Please try again.');
                }
            }
        @endauth

        // Enhanced tab switching with analytics
        document.addEventListener('DOMContentLoaded', function () {
            const tabButtons = document.querySelectorAll('[data-tab]');
            tabButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const tabName = this.getAttribute('data-tab');

                    // Optional analytics tracking
                    if (typeof gtag !== 'undefined') {
                        gtag('event', 'tab_view', {
                            event_category: 'company_profile',
                            event_label: tabName,
                            value: 1
                        });
                    }
                });
            });
        });

        // Bookmark functionality with visual feedback
        document.querySelectorAll('a[href*="bookmark"]').forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();

                const icon = this.querySelector('i');
                const text = this.querySelector('span') || this;

                // Show loading state
                icon.className = 'bx bx-loader-alt animate-spin mr-2';

                // Navigate to the URL
                window.location.href = this.href;
            });
        });

        // Product card hover effects
        document.querySelectorAll('.product-card').forEach(card => {
            card.addEventListener('mouseenter', function () {
                this.style.transform = 'translateY(-8px) scale(1.02)';
            });

            card.addEventListener('mouseleave', function () {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Copy contact information functionality
        function copyToClipboard(text, element) {
            navigator.clipboard.writeText(text).then(function () {
                // Show success feedback
                const originalContent = element.innerHTML;
                element.innerHTML = '<i class="bx bx-check mr-2"></i>Copied!';
                element.classList.add('bg-green-100', 'text-green-800');

                setTimeout(() => {
                    element.innerHTML = originalContent;
                    element.classList.remove('bg-green-100', 'text-green-800');
                }, 2000);
            }).catch(function (err) {
                console.error('Failed to copy: ', err);
            });
        }
    </script>

    {{-- Tab Navigation Script --}}
    <script>
        // Tab Switching Functionality
        function switchTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.remove('active');
            });
            
            // Remove active class from all tab buttons
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('active');
            });
            
            // Show selected tab content
            const selectedContent = document.getElementById('content-' + tabName);
            const selectedButton = document.getElementById('tab-' + tabName);
            
            if (selectedContent && selectedButton) {
                selectedContent.classList.add('active');
                selectedButton.classList.add('active');
            }
            
            // Optional: Track tab views for analytics
            if (typeof gtag !== 'undefined') {
                gtag('event', 'tab_view', {
                    event_category: 'company_profile',
                    event_label: tabName,
                    value: 1
                });
            }
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
                } else {
                    star.classList.remove('filled');
                    starIcon.className = 'bx bx-star';
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
                const response = await fetch('{{ route('api.product.rate', ['type' => 'company']) }}', {
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
                    
                    // Show success message
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
        document.getElementById('reviewModal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideReviewModal();
            }
        });

        // Escape key to close modal
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                hideReviewModal();
            }
        });

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            // Set initial active tab
            switchTab('desc');
            
            // Add smooth scrolling for tab switching
            document.querySelectorAll('.tab-button').forEach(button => {
                button.addEventListener('click', function() {
                    this.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                });
            });
        });
    </script>

    {{-- Contact Tab Specific Script --}}
    <script>
    // Enhanced copy to clipboard function
    function copyToClipboard(text, element) {
        navigator.clipboard.writeText(text).then(function() {
            // Show success feedback
            const originalContent = element.innerHTML;
            element.innerHTML = '<i class="bx bx-check mr-1"></i>Copied!';
            element.classList.add('bg-green-100', 'text-green-800');
            
            setTimeout(() => {
                element.innerHTML = originalContent;
                element.classList.remove('bg-green-100', 'text-green-800');
            }, 2000);
            
            // Show notification
            showNotification('Copied to clipboard!', 'success');
        }).catch(function(err) {
            console.error('Failed to copy: ', err);
            showNotification('Failed to copy. Please try again.', 'error');
        });
    }

    // Quick contact form submission
    document.getElementById('quickContactForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const submitButton = this.querySelector('button[type="submit"]');
        const originalText = submitButton.innerHTML;
        
        // Show loading state
        submitButton.innerHTML = '<i class="bx bx-loader-alt animate-spin mr-2"></i>Sending...';
        submitButton.disabled = true;
        
        // Simulate form submission (replace with actual API call)
        setTimeout(() => {
            showNotification('Message sent successfully! We\'ll get back to you soon.', 'success');
            this.reset();
            
            // Reset button
            submitButton.innerHTML = originalText;
            submitButton.disabled = false;
        }, 2000);
    });

    // Business hours status update
    function updateBusinessStatus() {
        const now = new Date();
        const hour = now.getHours();
        const day = now.getDay();
        
        const statusElement = document.querySelector('.bg-green-50');
        const statusText = statusElement.querySelector('span');
        const statusIcon = statusElement.querySelector('i');
        
        // Check if it's business hours (Mon-Fri 9-18, Sat 10-16)
        const isBusinessHours = (
            (day >= 1 && day <= 5 && hour >= 9 && hour < 18) ||
            (day === 6 && hour >= 10 && hour < 16)
        );
        
        if (isBusinessHours) {
            statusElement.className = 'mt-4 p-3 bg-green-50 rounded-lg';
            statusIcon.className = 'bx bx-check-circle mr-2';
            statusText.textContent = "We're currently open!";
            statusText.className = 'text-sm font-medium text-green-800';
        } else {
            statusElement.className = 'mt-4 p-3 bg-red-50 rounded-lg';
            statusIcon.className = 'bx bx-x-circle mr-2';
            statusText.textContent = "We're currently closed";
            statusText.className = 'text-sm font-medium text-red-800';
        }
    }

    // Update business status on page load
    document.addEventListener('DOMContentLoaded', updateBusinessStatus);

    // Auto-focus first form field when contact form comes into view
    const contactForm = document.getElementById('quickContactForm');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    contactForm.querySelector('input').focus();
                }, 500);
            }
        });
    });

    if (contactForm) {
        observer.observe(contactForm);
    }
    </script>
@endsection