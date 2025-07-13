@extends('layouts.user')

@section('head')
    <style>
        /* Enhanced search animations */
        .search-container {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        }
        
        .search-input:focus {
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
        }
        
        /* Event card hover effects */
        .event-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .event-card:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        /* Event status badges */
        .event-status {
            background: linear-gradient(45deg, #10b981, #059669);
        }
        
        .event-upcoming {
            background: linear-gradient(45deg, #f59e0b, #d97706);
        }
        
        .event-live {
            background: linear-gradient(45deg, #ef4444, #dc2626);
            animation: livePulse 2s ease-in-out infinite;
        }
        
        @keyframes livePulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
        
        /* View switcher animations */
        .view-switcher button {
            transition: all 0.2s ease-in-out;
        }
        
        .view-switcher button.active {
            transform: scale(1.05);
        }
        
        /* Date display animations */
        .event-date {
            transition: all 0.3s ease;
        }
        
        .event-card:hover .event-date {
            transform: scale(1.1);
        }
        
        /* Calendar floating animation */
        .calendar-float {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
    </style>
@endsection

@section('content')
    <x-user.bread-crumb :data="['Home', 'Events', 'List']"/>
    
    <!-- Enhanced Hero Search Section -->
    <div class="search-container relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-20"></div>
        <!-- Floating event icons animation -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-20 left-10 text-white opacity-20 calendar-float">📅</div>
            <div class="absolute top-32 right-20 text-white opacity-20 animate-pulse">🎉</div>
            <div class="absolute bottom-20 left-20 text-white opacity-20 calendar-float delay-1000">🎪</div>
            <div class="absolute bottom-32 right-10 text-white opacity-20 animate-pulse delay-500">🎯</div>
        </div>
        
        <div class="relative z-10 container mx-auto px-4 py-16 lg:py-20 bg-transparent">
            <div class="text-center mb-8">
                <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold text-white mb-4 leading-tight">
                    Discover Amazing <span class="text-yellow-300">Events</span>
                </h1>
                <p class="text-lg md:text-xl text-white opacity-90 max-w-2xl mx-auto">
                    Find exciting events, conferences, workshops, and networking opportunities
                </p>
                
                <!-- Event Stats -->
                <div class="flex justify-center gap-8 mt-6 text-white">
                    <div class="text-center">
                        <div class="text-2xl font-bold">{{ $events->total() }}+</div>
                        <div class="text-sm opacity-75">Events</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold">50+</div>
                        <div class="text-sm opacity-75">Categories</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold">24/7</div>
                        <div class="text-sm opacity-75">Live Events</div>
                    </div>
                </div>
            </div>
            
            <!-- Enhanced Search Form -->
            <div class="max-w-4xl mx-auto relative">
                <form action="{{ route('events') }}" method="GET" class="bg-white rounded-2xl shadow-2xl p-2">
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
                                placeholder="Search events, conferences, workshops..." 
                                autocomplete="off"
                                class="search-input w-full pl-12 pr-4 py-4 text-lg border-0 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 transition-all duration-300"
                            >
                            
                            <!-- Enhanced Search Results Dropdown -->
                            <div id="searchResults" class="search-results absolute top-full left-0 right-0 bg-white mt-1 rounded-lg shadow-lg border max-h-80 overflow-y-auto z-50 hidden">
                                <div id="searchResultsContent"></div>
                                <div id="searchLoading" class="hidden p-4 text-center">
                                    <div class="inline-block animate-spin rounded-full h-6 w-6 border-b-2 border-purple-600"></div>
                                    <span class="ml-2 text-gray-600">Searching events...</span>
                                </div>
                            </div>
                        </div>
                        
                        <button 
                            type="submit" 
                            class="bg-purple-600 hover:bg-purple-700 text-white px-8 py-4 rounded-xl font-semibold text-lg transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2"
                        >
                            <span class="hidden md:inline">Find Events</span>
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
                        <label for="event-category-filter" class="text-gray-700 font-medium whitespace-nowrap">
                            <i class='bx bx-filter-alt text-lg'></i>
                            <span class="hidden md:inline ml-1">Category:</span>
                        </label>
                        <select 
                            name="category" 
                            id="event-category-filter" 
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

                    <!-- Country Filter -->
                    <div class="flex items-center gap-2">
                        <label for="event-country" class="text-gray-700 font-medium whitespace-nowrap">
                            <i class='bx bx-world text-lg'></i>
                            <span class="hidden md:inline ml-1">Country:</span>
                        </label>
                        <select 
                            name="country" 
                            id="event-country" 
                            class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 bg-white min-w-32"
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

                    <!-- Date Filter -->
                    <div class="flex items-center gap-2">
                        <label for="event-date" class="text-gray-700 font-medium whitespace-nowrap">
                            <i class='bx bx-calendar text-lg'></i>
                            <span class="hidden md:inline ml-1">When:</span>
                        </label>
                        <select 
                            name="date" 
                            id="event-date" 
                            class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 bg-white min-w-32"
                            onchange="applyFilters()"
                        >
                            <option value="" {{ !request('date') ? 'selected' : '' }}>All Dates</option>
                            <option value="today" {{ request('date') == 'today' ? 'selected' : '' }}>Today</option>
                            <option value="tomorrow" {{ request('date') == 'tomorrow' ? 'selected' : '' }}>Tomorrow</option>
                            <option value="this-week" {{ request('date') == 'this-week' ? 'selected' : '' }}>This Week</option>
                            <option value="this-month" {{ request('date') == 'this-month' ? 'selected' : '' }}>This Month</option>
                            <option value="next-month" {{ request('date') == 'next-month' ? 'selected' : '' }}>Next Month</option>
                        </select>
                    </div>
                    
                    <!-- Clear Filters -->
                    @if(request('category') || request('country') || request('date') || request('q'))
                        <button 
                            onclick="clearFilters()" 
                            class="text-sm text-purple-600 hover:text-purple-800 font-medium flex items-center gap-1 transition-colors"
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
                            Showing {{ $events->firstItem() ?: 0 }} - {{ $events->lastItem() ?: 0 }} of {{ $events->total() }} events
                        </span>
                        <span class="sm:hidden">
                            {{ $events->total() }} events found
                        </span>
                    </div>

                    <!-- View Switcher -->
                    <div class="view-switcher flex items-center bg-white rounded-lg border border-gray-300 p-1">
                        <button 
                            onclick="switchView('grid')" 
                            id="gridViewBtn"
                            class="active flex items-center px-3 py-2 rounded-md text-sm font-medium transition-all duration-200 bg-purple-100 text-purple-700"
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

    <!-- Events Container -->
    <div class="container mx-auto px-4 py-8">
        @if($events->count() > 0)
            <!-- Grid View (4 columns) -->
            <div id="gridView" class="events-container grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($events as $event)
                    <div class="event-card bg-white rounded-xl shadow-md hover:shadow-xl border border-gray-100 overflow-hidden group h-full flex flex-col transition-all duration-300 hover:-translate-y-2 relative">
                        @php
                            $eventDate = \Carbon\Carbon::parse($event->start);
                            $isToday = $eventDate->isToday();
                            $isUpcoming = $eventDate->isFuture();
                            $isLive = $isToday;
                        @endphp

                        <!-- Event Status Badge -->
                        @if($isLive)
                            <div class="event-live absolute top-3 right-3 z-10 px-2 py-1 rounded-full">
                                <p class="text-white text-xs font-bold flex items-center">
                                    <span class="w-2 h-2 bg-white rounded-full mr-1 animate-pulse"></span>
                                    LIVE
                                </p>
                            </div>
                        @elseif($isUpcoming)
                            <div class="event-upcoming absolute top-3 right-3 z-10 px-2 py-1 rounded-full">
                                <p class="text-white text-xs font-bold">UPCOMING</p>
                            </div>
                        @endif

                        <!-- Event Image -->
                        <div class="relative bg-gray-50 h-48 overflow-hidden">
                            <a href="{{ route('view.event', [$event->slug]) }}">
                                <img 
                                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110" 
                                    src="{{ $event->thumbnail ? url('storage/' . $event->thumbnail) : asset('images/default-event.png') }}"
                                    alt="{{ $event->title }}"
                                    loading="lazy"
                                    onerror="this.src='{{ asset('images/default-event.png') }}'"
                                >
                            </a>
                            
                            <!-- Date Overlay -->
                            <div class="event-date absolute bottom-3 left-3 bg-white bg-opacity-95 rounded-lg p-2 min-w-16 text-center">
                                <div class="text-xs font-bold text-purple-600">{{ $eventDate->format('M') }}</div>
                                <div class="text-lg font-bold text-gray-900">{{ $eventDate->format('d') }}</div>
                            </div>
                        </div>

                        <!-- Event Information -->
                        <div class="flex-1 p-4 flex flex-col">
                            <div class="flex-1">
                                <!-- Company Info -->
                                <div class="flex items-center mb-3">
                                    <img 
                                        class="w-8 h-8 object-cover rounded-full" 
                                        alt="Company avatar"
                                        src="https://ui-avatars.com/api/?name={{ urlencode($event->company->name) }}&background=8b5cf6&color=fff"
                                    />
                                    <div class="ml-2">
                                        <div class="text-sm font-medium text-gray-900">{{ $event->company->name }}</div>
                                        <div class="text-xs text-gray-600">{{ $event->created_at->diffForHumans() }}</div>
                                    </div>
                                </div>

                                <!-- Event Title -->
                                <h3 class="text-lg font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-purple-600 transition-colors">
                                    <a href="{{ route('view.event', [$event->slug]) }}">
                                        {{ $event->title }}
                                    </a>
                                </h3>
                                
                                <!-- Event Details -->
                                <div class="space-y-2 mb-4">
                                    <div class="flex items-center text-sm text-gray-600">
                                        <i class='bx bx-calendar text-purple-500 mr-2'></i>
                                        <span>{{ $eventDate->format('M d, Y - g:i A') }}</span>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-600">
                                        <i class='bx bx-map text-red-500 mr-2'></i>
                                        <span class="truncate">{{ $event->address->country->name }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Button -->
                            <div class="mt-auto">
                                <a 
                                    href="{{ route('view.event', [$event->slug]) }}" 
                                    class="block w-full text-center px-4 py-2 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-semibold rounded-lg transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-purple-500"
                                >
                                    <i class='bx bx-calendar-event mr-2'></i>
                                    View Event
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- List View -->
            <div id="listView" class="events-container space-y-6 hidden">
                @foreach($events as $event)
                    @php
                        $eventDate = \Carbon\Carbon::parse($event->start);
                        $isToday = $eventDate->isToday();
                        $isUpcoming = $eventDate->isFuture();
                        $isLive = $isToday;
                    @endphp

                    <div class="event-card bg-white rounded-xl shadow-md hover:shadow-xl border border-gray-100 overflow-hidden group transition-all duration-300 hover:-translate-y-1 relative">
                        <!-- Event Status Badge -->
                        @if($isLive)
                            <div class="event-live absolute top-4 right-4 z-10 px-3 py-2 rounded-lg">
                                <p class="text-white text-sm font-bold flex items-center">
                                    <span class="w-2 h-2 bg-white rounded-full mr-2 animate-pulse"></span>
                                    LIVE NOW
                                </p>
                            </div>
                        @elseif($isUpcoming)
                            <div class="event-upcoming absolute top-4 right-4 z-10 px-3 py-2 rounded-lg">
                                <p class="text-white text-sm font-bold">UPCOMING</p>
                            </div>
                        @endif

                        <div class="flex flex-col md:flex-row">
                            <!-- Event Image -->
                            <div class="md:w-80 bg-gray-50 relative overflow-hidden">
                                <a href="{{ route('view.event', [$event->slug]) }}">
                                    <img 
                                        class="w-full h-64 md:h-full object-cover transition-transform duration-300 group-hover:scale-110" 
                                        src="{{ $event->thumbnail ? url('storage/' . $event->thumbnail) : asset('images/default-event.png') }}"
                                        alt="{{ $event->title }}"
                                        loading="lazy"
                                        onerror="this.src='{{ asset('images/default-event.png') }}'"
                                    >
                                </a>
                                
                                <!-- Date Overlay -->
                                <div class="event-date absolute bottom-4 left-4 bg-white bg-opacity-95 rounded-lg p-3 min-w-20 text-center">
                                    <div class="text-sm font-bold text-purple-600">{{ $eventDate->format('M') }}</div>
                                    <div class="text-2xl font-bold text-gray-900">{{ $eventDate->format('d') }}</div>
                                    <div class="text-xs text-gray-600">{{ $eventDate->format('Y') }}</div>
                                </div>
                            </div>

                            <!-- Event Details -->
                            <div class="flex-1 p-6">
                                <div class="grid md:grid-cols-3 gap-6 h-full">
                                    <!-- Column 1: Basic Info -->
                                    <div class="space-y-4">
                                        <div>
                                            <!-- Company Info -->
                                            <div class="flex items-center mb-4">
                                                <img 
                                                    class="w-10 h-10 object-cover rounded-full" 
                                                    alt="Company avatar"
                                                    src="https://ui-avatars.com/api/?name={{ urlencode($event->company->name) }}&background=8b5cf6&color=fff"
                                                />
                                                <div class="ml-3">
                                                    <div class="font-medium text-gray-900">{{ $event->company->name }}</div>
                                                    <div class="text-sm text-gray-600">{{ $event->created_at->diffForHumans() }}</div>
                                                </div>
                                            </div>

                                            <h3 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-purple-600 transition-colors">
                                                <a href="{{ route('view.event', [$event->slug]) }}">
                                                    {{ $event->title }}
                                                </a>
                                            </h3>
                                        </div>
                                    </div>

                                    <!-- Column 2: Event Details -->
                                    <div>
                                        <h4 class="font-semibold text-gray-700 mb-4 flex items-center">
                                            <i class='bx bx-info-circle text-purple-500 mr-2'></i>
                                            Event Details
                                        </h4>
                                        
                                        <div class="space-y-3">
                                            <div class="flex items-center text-sm text-gray-600">
                                                <i class='bx bx-calendar text-purple-500 mr-2'></i>
                                                <span>{{ $eventDate->format('M d, Y') }}</span>
                                            </div>
                                            <div class="flex items-center text-sm text-gray-600">
                                                <i class='bx bx-time text-blue-500 mr-2'></i>
                                                <span>{{ $eventDate->format('g:i A') }}</span>
                                            </div>
                                            <div class="flex items-center text-sm text-gray-600">
                                                <i class='bx bx-map text-red-500 mr-2'></i>
                                                <span>{{ $event->address->country->name }}</span>
                                            </div>
                                            
                                            @if($event->category)
                                                <div class="mt-3">
                                                    <span class="bg-purple-50 text-purple-700 px-3 py-1 rounded-full text-sm font-medium">
                                                        {{ $event->category->name }}
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Column 3: Actions -->
                                    <div class="flex flex-col justify-between">
                                        <div class="space-y-3">
                                            <a 
                                                href="{{ route('view.event', [$event->slug]) }}" 
                                                class="block w-full text-center px-4 py-3 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-semibold rounded-lg transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-purple-500"
                                            >
                                                <i class='bx bx-calendar-event mr-2'></i>
                                                View Event Details
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

                                        <!-- Event Status -->
                                        <div class="mt-4 p-3 bg-purple-50 rounded-lg">
                                            <div class="flex justify-between text-xs text-purple-600">
                                                <span>
                                                    @if($isLive)
                                                        🔴 Live Event
                                                    @elseif($isUpcoming)
                                                        📅 Upcoming
                                                    @else
                                                        ✅ Completed
                                                    @endif
                                                </span>
                                                <i class='bx bx-calendar text-purple-500'></i>
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
                {{ $events->appends(request()->query())->links() }}
            </div>
        @else
            <!-- Enhanced Empty State -->
            <div class="text-center py-16">
                <div class="max-w-md mx-auto">
                    <div class="mb-6">
                        <i class='bx bx-calendar-x text-6xl text-gray-300'></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">No Events Found</h3>
                    <p class="text-gray-600 mb-6">
                        We couldn't find any events matching your criteria. Try adjusting your search or filters.
                    </p>
                    <button 
                        onclick="clearFilters()" 
                        class="inline-flex items-center px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg transition-colors"
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
            <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-purple-600 mb-4"></div>
            <p class="text-gray-600 font-medium">Loading events...</p>
        </div>
    </div>

    <x-related-keywords :seo="$seo" :route="'events'"/>
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
                
                gridBtn.classList.add('active', 'bg-purple-100', 'text-purple-700');
                gridBtn.classList.remove('text-gray-600');
                
                listBtn.classList.remove('active', 'bg-purple-100', 'text-purple-700');
                listBtn.classList.add('text-gray-600');
            } else {
                listView.classList.remove('hidden');
                gridView.classList.add('hidden');
                
                listBtn.classList.add('active', 'bg-purple-100', 'text-purple-700');
                listBtn.classList.remove('text-gray-600');
                
                gridBtn.classList.remove('active', 'bg-purple-100', 'text-purple-700');
                gridBtn.classList.add('text-gray-600');
            }

            // Save preference to localStorage
            localStorage.setItem('eventViewPreference', viewType);
        }

        // Load saved view preference
        document.addEventListener('DOMContentLoaded', function() {
            const savedView = localStorage.getItem('eventViewPreference') || 'grid';
            switchView(savedView);
        });

        // Enhanced filter functionality with loading states
        function applyFilters() {
            showLoading();
            
            const categoryValue = document.getElementById('event-category-filter').value;
            const countryValue = document.getElementById('event-country').value;
            const dateValue = document.getElementById('event-date').value;
            const searchValue = document.getElementById('searchInput').value;
            
            let url = '{{ route('events') }}';
            let params = [];

            if (categoryValue !== 'all') {
                params.push('category=' + encodeURIComponent(categoryValue));
            }

            if (countryValue && countryValue !== '') {
                params.push('country=' + encodeURIComponent(countryValue));
            }

            if (dateValue && dateValue !== '') {
                params.push('date=' + encodeURIComponent(dateValue));
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
            window.location.href = '{{ route('events') }}';
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
                
                const searchURL = "{{ route('api.search.events', ['search' => '__input__']) }}".replace('__input__', encodeURIComponent(query));
                
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
                        <i class='bx bx-calendar-x text-2xl mb-2'></i>
                        <p>No events found</p>
                    </div>
                `;
            } else {
                results.forEach((result, index) => {
                    const resultElement = document.createElement('a');
                    resultElement.href = "{{ route('events', ['q' => '__slug__']) }}".replace('__slug__', encodeURIComponent(result));
                    resultElement.className = 'block px-4 py-3 hover:bg-gray-50 transition-colors border-b border-gray-100 last:border-b-0';
                    resultElement.innerHTML = `
                        <div class="flex items-center">
                            <i class='bx bx-calendar-event text-gray-400 mr-3'></i>
                            <span class="text-gray-900">${escapeHtml(result)}</span>
                            <span class="ml-auto text-xs text-purple-600 font-medium">📅 Event</span>
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

        // Real-time event status updates
        function updateEventStatuses() {
            const eventCards = document.querySelectorAll('.event-card');
            const now = new Date();
            
            eventCards.forEach(card => {
                // Update live/upcoming badges based on current time
                // This would require event dates to be available in JavaScript
                // Implementation depends on your specific requirements
            });
        }

        // Update event statuses every minute
        setInterval(updateEventStatuses, 60000);
    </script>
@endsection