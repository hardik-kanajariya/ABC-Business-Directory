@extends('layouts.user')

@section('head')
    <style>
        /* Enhanced search animations */
        .search-container {
            background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
        }
        
        .search-input:focus {
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
        }
        
        /* Job card hover effects */
        .job-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .job-card:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        /* Job type badges */
        .job-type-full-time {
            background: linear-gradient(45deg, #10b981, #059669);
        }
        
        .job-type-part-time {
            background: linear-gradient(45deg, #f59e0b, #d97706);
        }
        
        .job-type-contract {
            background: linear-gradient(45deg, #8b5cf6, #7c3aed);
        }
        
        .job-type-remote {
            background: linear-gradient(45deg, #06b6d4, #0891b2);
        }
        
        .job-type-internship {
            background: linear-gradient(45deg, #ec4899, #db2777);
        }
        
        /* Salary highlight animation */
        .salary-highlight {
            background: linear-gradient(45deg, #fbbf24, #f59e0b);
            animation: salaryGlow 2s ease-in-out infinite;
        }
        
        @keyframes salaryGlow {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }
        
        /* View switcher animations */
        .view-switcher button {
            transition: all 0.2s ease-in-out;
        }
        
        .view-switcher button.active {
            transform: scale(1.05);
        }
        
        /* Company logo animations */
        .company-logo {
            transition: all 0.3s ease;
        }
        
        .job-card:hover .company-logo {
            transform: scale(1.1) rotate(3deg);
        }
        
        /* Briefcase floating animation */
        .briefcase-float {
            animation: briefcaseFloat 3s ease-in-out infinite;
        }
        
        @keyframes briefcaseFloat {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-10px) rotate(5deg); }
        }
    </style>
@endsection

@section('content')
    <x-user.bread-crumb :data="['Home', 'Jobs', 'List']"/>
    
    <!-- Enhanced Hero Search Section -->
    <div class="search-container relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-20"></div>
        <!-- Floating career icons animation -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-20 left-10 text-white opacity-20 briefcase-float">💼</div>
            <div class="absolute top-32 right-20 text-white opacity-20 animate-pulse">🚀</div>
            <div class="absolute bottom-20 left-20 text-white opacity-20 briefcase-float delay-1000">💻</div>
            <div class="absolute bottom-32 right-10 text-white opacity-20 animate-pulse delay-500">🎯</div>
        </div>
        
        <div class="relative z-10 container mx-auto px-4 py-16 lg:py-20 bg-transparent">
            <div class="text-center mb-8">
                <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold text-white mb-4 leading-tight">
                    Find Your Dream <span class="text-yellow-300">Career</span>
                </h1>
                <p class="text-lg md:text-xl text-white opacity-90 max-w-2xl mx-auto">
                    Explore thousands of opportunities and take the next step in your professional journey
                </p>
                
                <!-- Job Stats -->
                <div class="flex justify-center gap-8 mt-6 text-white">
                    <div class="text-center">
                        <div class="text-2xl font-bold">{{ $jobs->total() }}+</div>
                        <div class="text-sm opacity-75">Open Positions</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold">500+</div>
                        <div class="text-sm opacity-75">Companies</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold">100%</div>
                        <div class="text-sm opacity-75">Free to Apply</div>
                    </div>
                </div>
            </div>
            
            <!-- Enhanced Search Form -->
            <div class="max-w-4xl mx-auto relative">
                <form action="{{ route('jobs') }}" method="GET" class="bg-white rounded-2xl shadow-2xl p-2">
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
                                placeholder="Search jobs, companies, or skills..." 
                                autocomplete="off"
                                class="search-input w-full pl-12 pr-4 py-4 text-lg border-0 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300"
                            >
                            
                            <!-- Enhanced Search Results Dropdown -->
                            <div id="searchResults" class="search-results absolute top-full left-0 right-0 bg-white mt-1 rounded-lg shadow-lg border max-h-80 overflow-y-auto z-50 hidden">
                                <div id="searchResultsContent"></div>
                                <div id="searchLoading" class="hidden p-4 text-center">
                                    <div class="inline-block animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600"></div>
                                    <span class="ml-2 text-gray-600">Searching jobs...</span>
                                </div>
                            </div>
                        </div>
                        
                        <button 
                            type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-xl font-semibold text-lg transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                        >
                            <span class="hidden md:inline">Find Jobs</span>
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
                        <label for="job-category-filter" class="text-gray-700 font-medium whitespace-nowrap">
                            <i class='bx bx-filter-alt text-lg'></i>
                            <span class="hidden md:inline ml-1">Category:</span>
                        </label>
                        <select 
                            name="category" 
                            id="job-category-filter" 
                            class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white min-w-32"
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
                        <label for="job-country" class="text-gray-700 font-medium whitespace-nowrap">
                            <i class='bx bx-world text-lg'></i>
                            <span class="hidden md:inline ml-1">Location:</span>
                        </label>
                        <select 
                            name="country" 
                            id="job-country" 
                            class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white min-w-32"
                            onchange="applyFilters()"
                        >
                            <option value="">All Locations</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}" {{ request('country') == $country->id ? 'selected' : '' }}>
                                    {{ $country->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Clear Filters -->
                    @if(request('category') || request('country') || request('type') || request('q'))
                        <button 
                            onclick="clearFilters()" 
                            class="text-sm text-blue-600 hover:text-blue-800 font-medium flex items-center gap-1 transition-colors"
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
                            Showing {{ $jobs->firstItem() ?: 0 }} - {{ $jobs->lastItem() ?: 0 }} of {{ $jobs->total() }} jobs
                        </span>
                        <span class="sm:hidden">
                            {{ $jobs->total() }} jobs found
                        </span>
                    </div>

                    <!-- View Switcher -->
                    <div class="view-switcher flex items-center bg-white rounded-lg border border-gray-300 p-1">
                        <button 
                            onclick="switchView('grid')" 
                            id="gridViewBtn"
                            class="active flex items-center px-3 py-2 rounded-md text-sm font-medium transition-all duration-200 bg-blue-100 text-blue-700"
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

    <!-- Jobs Container -->
    <div class="container mx-auto px-4 py-8">
        @if($jobs->count() > 0)
            <!-- Grid View -->
            <div id="gridView" class="jobs-container grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 md:gap-8">
                @foreach($jobs as $job)
                    <div class="job-card bg-white rounded-xl shadow-md hover:shadow-xl border border-gray-100 overflow-hidden group h-full flex flex-col transition-all duration-300 hover:-translate-y-2 relative">
                        <!-- Job Type Badge -->
                        <div class="absolute top-3 right-3 z-10">
                            @php
                                $typeClass = match(strtolower($job->employment_type)) {
                                    'full time', 'full-time' => 'job-type-full-time',
                                    'part time', 'part-time' => 'job-type-part-time',
                                    'contract' => 'job-type-contract',
                                    'remote' => 'job-type-remote',
                                    'internship' => 'job-type-internship',
                                    default => 'bg-gray-500'
                                };
                            @endphp
                            <span class="{{ $typeClass }} px-3 py-1 rounded-full text-white text-xs font-bold">
                                {{ $job->employment_type }}
                            </span>
                        </div>

                        <!-- Company Logo -->
                        <div class="relative bg-gray-50 h-32 flex items-center justify-center p-6">
                            <div class="company-logo w-20 h-20 relative">
                                <img 
                                    class="w-full h-full object-contain transition-transform duration-300" 
                                    src="{{ $job->thumbnail ? url('storage/' . $job->thumbnail) : asset('images/default-company.png') }}"
                                    alt="{{ $job->organization }} logo"
                                    loading="lazy"
                                    onerror="this.src='{{ asset('images/default-company.png') }}'"
                                >
                            </div>
                        </div>

                        <!-- Job Information -->
                        <div class="flex-1 p-6 flex flex-col">
                            <div class="flex-1">
                                <!-- Job Title -->
                                <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors">
                                    <a href="{{ route('view.job', [$job->slug]) }}">
                                        {{ $job->title }}
                                    </a>
                                </h3>
                                
                                <!-- Company Name -->
                                <div class="text-lg font-semibold text-purple-600 mb-3">
                                    {{ $job->organization }}
                                </div>

                                <!-- Location -->
                                <div class="flex items-center text-sm text-gray-600 mb-4">
                                    <i class='bx bx-map text-red-500 mr-2'></i>
                                    <span class="truncate">
                                        {{ $job->address->state->name ?? 'N/A' }}, {{ $job->address->country->name ?? 'N/A' }}
                                    </span>
                                </div>

                                <!-- Job Details -->
                                <div class="space-y-2 mb-4">
                                    @if(isset($job->salary) && $job->salary)
                                        <div class="flex items-center text-sm">
                                            <i class='bx bx-dollar text-green-500 mr-2'></i>
                                            <span class="font-semibold text-green-600">${{ number_format($job->salary) }}/year</span>
                                        </div>
                                    @endif
                                    
                                    @if(isset($job->experience_level))
                                        <div class="flex items-center text-sm text-gray-600">
                                            <i class='bx bx-user text-blue-500 mr-2'></i>
                                            <span>{{ $job->experience_level }} Level</span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Posted Time -->
                                <div class="text-xs text-gray-500 mb-4">
                                    <i class='bx bx-time mr-1'></i>
                                    Posted {{ $job->created_at->diffForHumans() }}
                                </div>
                            </div>

                            <!-- Action Button -->
                            <div class="mt-auto">
                                <a 
                                    href="{{ route('view.job', [$job->slug]) }}" 
                                    class="block w-full text-center px-4 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-lg transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                >
                                    <i class='bx bx-paper-plane mr-2'></i>
                                    Apply Now
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- List View -->
            <div id="listView" class="jobs-container space-y-6 hidden">
                @foreach($jobs as $job)
                    <div class="job-card bg-white rounded-xl shadow-md hover:shadow-xl border border-gray-100 overflow-hidden group transition-all duration-300 hover:-translate-y-1 relative">
                        <div class="flex flex-col md:flex-row">
                            <!-- Company Logo -->
                            <div class="md:w-48 bg-gray-50 flex items-center justify-center p-6 relative">
                                <div class="company-logo w-24 h-24 relative">
                                    <img 
                                        class="w-full h-full object-contain transition-transform duration-300" 
                                        src="{{ $job->thumbnail ? url('storage/' . $job->thumbnail) : asset('images/default-company.png') }}"
                                        alt="{{ $job->organization }} logo"
                                        loading="lazy"
                                        onerror="this.src='{{ asset('images/default-company.png') }}'"
                                    >
                                </div>
                                
                                <!-- Job Type Badge -->
                                @php
                                    $typeClass = match(strtolower($job->employment_type)) {
                                        'full time', 'full-time' => 'job-type-full-time',
                                        'part time', 'part-time' => 'job-type-part-time',
                                        'contract' => 'job-type-contract',
                                        'remote' => 'job-type-remote',
                                        'internship' => 'job-type-internship',
                                        default => 'bg-gray-500'
                                    };
                                @endphp
                                <div class="absolute top-3 right-3">
                                    <span class="{{ $typeClass }} px-2 py-1 rounded-full text-white text-xs font-bold">
                                        {{ $job->employment_type }}
                                    </span>
                                </div>
                            </div>

                            <!-- Job Details -->
                            <div class="flex-1 p-6">
                                <div class="grid md:grid-cols-3 gap-6 h-full">
                                    <!-- Column 1: Basic Info -->
                                    <div class="space-y-4">
                                        <div>
                                            <h3 class="text-2xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors">
                                                <a href="{{ route('view.job', [$job->slug]) }}">
                                                    {{ $job->title }}
                                                </a>
                                            </h3>
                                            
                                            <div class="text-lg font-semibold text-purple-600 mb-3">
                                                {{ $job->organization }}
                                            </div>
                                            
                                            <div class="space-y-2">
                                                <div class="flex items-center text-sm text-gray-600">
                                                    <i class='bx bx-map text-red-500 mr-2'></i>
                                                    <span>{{ $job->address->state->name ?? 'N/A' }}, {{ $job->address->country->name ?? 'N/A' }}</span>
                                                </div>
                                                <div class="flex items-center text-sm text-gray-600">
                                                    <i class='bx bx-time text-blue-500 mr-2'></i>
                                                    <span>Posted {{ $job->created_at->diffForHumans() }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Column 2: Job Requirements & Benefits -->
                                    <div>
                                        <h4 class="font-semibold text-gray-700 mb-4 flex items-center">
                                            <i class='bx bx-info-circle text-blue-500 mr-2'></i>
                                            Job Details
                                        </h4>
                                        
                                        <div class="space-y-3">
                                            @if(isset($job->salary) && $job->salary)
                                                <div class="flex items-center">
                                                    <i class='bx bx-dollar text-green-500 mr-2'></i>
                                                    <span class="font-semibold text-green-600">${{ number_format($job->salary) }}/year</span>
                                                </div>
                                            @endif
                                            
                                            @if(isset($job->experience_level))
                                                <div class="flex items-center text-sm text-gray-600">
                                                    <i class='bx bx-user text-purple-500 mr-2'></i>
                                                    <span>{{ $job->experience_level }} Level</span>
                                                </div>
                                            @endif
                                            
                                            @if(isset($job->category))
                                                <div class="mt-3">
                                                    <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-sm font-medium">
                                                        {{ $job->category->name ?? 'General' }}
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Column 3: Actions -->
                                    <div class="flex flex-col justify-between">
                                        <div class="space-y-3">
                                            <a 
                                                href="{{ route('view.job', [$job->slug]) }}" 
                                                class="block w-full text-center px-4 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-lg transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            >
                                                <i class='bx bx-paper-plane mr-2'></i>
                                                Apply Now
                                            </a>
                                            
                                            <div class="grid grid-cols-2 gap-2">
                                                <button class="px-3 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors text-sm font-medium">
                                                    <i class='bx bx-bookmark mr-1'></i>
                                                    Save
                                                </button>
                                                <button class="px-3 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors text-sm font-medium">
                                                    <i class='bx bx-share mr-1'></i>
                                                    Share
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Job Status -->
                                        <div class="mt-4 p-3 bg-blue-50 rounded-lg">
                                            <div class="flex justify-between text-xs text-blue-600">
                                                <span>🚀 Apply Today</span>
                                                <i class='bx bx-briefcase text-blue-500'></i>
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
                {{ $jobs->appends(request()->query())->links() }}
            </div>
        @else
            <!-- Enhanced Empty State -->
            <div class="text-center py-16">
                <div class="max-w-md mx-auto">
                    <div class="mb-6">
                        <i class='bx bx-briefcase text-6xl text-gray-300'></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">No Jobs Found</h3>
                    <p class="text-gray-600 mb-6">
                        We couldn't find any jobs matching your criteria. Try adjusting your search or filters.
                    </p>
                    <button 
                        onclick="clearFilters()" 
                        class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors"
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
            <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mb-4"></div>
            <p class="text-gray-600 font-medium">Loading jobs...</p>
        </div>
    </div>

    <x-related-keywords :seo="$seo" :route="'jobs'"/>
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
                
                gridBtn.classList.add('active', 'bg-blue-100', 'text-blue-700');
                gridBtn.classList.remove('text-gray-600');
                
                listBtn.classList.remove('active', 'bg-blue-100', 'text-blue-700');
                listBtn.classList.add('text-gray-600');
            } else {
                listView.classList.remove('hidden');
                gridView.classList.add('hidden');
                
                listBtn.classList.add('active', 'bg-blue-100', 'text-blue-700');
                listBtn.classList.remove('text-gray-600');
                
                gridBtn.classList.remove('active', 'bg-blue-100', 'text-blue-700');
                gridBtn.classList.add('text-gray-600');
            }

            // Save preference to localStorage
            localStorage.setItem('jobViewPreference', viewType);
        }

        // Load saved view preference
        document.addEventListener('DOMContentLoaded', function() {
            const savedView = localStorage.getItem('jobViewPreference') || 'grid';
            switchView(savedView);
        });

        // Enhanced filter functionality with loading states
        function applyFilters() {
            showLoading();
            
            const categoryValue = document.getElementById('job-category-filter').value;
            const countryValue = document.getElementById('job-country').value;
            const typeValue = document.getElementById('job-type').value;
            const searchValue = document.getElementById('searchInput').value;
            
            let url = '{{ route('jobs') }}';
            let params = [];

            if (categoryValue !== 'all') {
                params.push('category=' + encodeURIComponent(categoryValue));
            }

            if (countryValue && countryValue !== '') {
                params.push('country=' + encodeURIComponent(countryValue));
            }

            if (typeValue && typeValue !== '') {
                params.push('type=' + encodeURIComponent(typeValue));
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
            window.location.href = '{{ route('jobs') }}';
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
                
                const searchURL = "{{ route('api.search.jobs', ['search' => '__input__']) }}".replace('__input__', encodeURIComponent(query));
                
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
                        <i class='bx bx-briefcase text-2xl mb-2'></i>
                        <p>No jobs found</p>
                    </div>
                `;
            } else {
                results.forEach((result, index) => {
                    const resultElement = document.createElement('a');
                    resultElement.href = "{{ route('jobs', ['q' => '__slug__']) }}".replace('__slug__', encodeURIComponent(result));
                    resultElement.className = 'block px-4 py-3 hover:bg-gray-50 transition-colors border-b border-gray-100 last:border-b-0';
                    resultElement.innerHTML = `
                        <div class="flex items-center">
                            <i class='bx bx-briefcase text-gray-400 mr-3'></i>
                            <span class="text-gray-900">${escapeHtml(result)}</span>
                            <span class="ml-auto text-xs text-blue-600 font-medium">💼 Job</span>
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

        // Job application tracking
        document.querySelectorAll('a[href*="view.job"]').forEach(link => {
            link.addEventListener('click', function() {
                // Optional: Track job views for analytics
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'job_view', {
                        event_category: 'jobs',
                        event_label: this.href,
                        value: 1
                    });
                }
            });
        });
    </script>
@endsection