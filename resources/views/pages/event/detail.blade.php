@php use App\classes\HelperFunctions; @endphp
@php use Carbon\Carbon; @endphp
@extends('layouts.user')

@section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.css"
          integrity="sha512-eG8C/4QWvW9MQKJNw2Xzr0KW7IcfBSxljko82RuSs613uOAg/jHEeuez4dfFgto1u6SRI/nXmTr9YPCjs1ozBg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.js"
            integrity="sha512-MdZwHb4u4qCy6kVoTLL8JxgPnARtbNCUIjTCihWcgWhCsLfDaQJib4+OV0O8IS+ea+3Xv/6pH3vYY4LWpU/gbQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <style>
        /* Custom Event Page Styles */
        .event-hero {
            background: linear-gradient(135deg, #7c3aed 0%, #5b21b6 100%);
        }
        
        .event-image {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .event-image:hover {
            transform: scale(1.02);
        }
        
        .event-status-live {
            background: linear-gradient(45deg, #ef4444, #dc2626);
            animation: livePulse 2s ease-in-out infinite;
        }
        
        .event-status-upcoming {
            background: linear-gradient(45deg, #f59e0b, #d97706);
        }
        
        .event-status-past {
            background: linear-gradient(45deg, #6b7280, #4b5563);
        }
        
        @keyframes livePulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
        
        .countdown-timer {
            background: linear-gradient(135deg, #1f2937 0%, #374151 100%);
        }
        
        .countdown-digit {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }
        
        .countdown-digit:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.05);
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
        
        .gallery-item {
            transition: all 0.3s ease;
            cursor: zoom-in;
        }
        
        .gallery-item:hover {
            transform: scale(1.05);
        }
        
        .organizer-card {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            transition: all 0.3s ease;
        }
        
        .organizer-card:hover {
            background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%);
            transform: translateY(-2px);
        }
        
        .review-card {
            background: linear-gradient(145deg, #f1f5f9, #e2e8f0);
            transition: all 0.3s ease;
        }
        
        .review-card:hover {
            background: linear-gradient(145deg, #e2e8f0, #cbd5e1);
        }
        
        .related-event-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .related-event-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }
        
        .event-date-badge {
            background: linear-gradient(145deg, #7c3aed, #5b21b6);
        }
        
        .calendar-float {
            animation: calendarFloat 3s ease-in-out infinite;
        }
        
        @keyframes calendarFloat {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-10px) rotate(3deg); }
        }
    </style>
    
    <x-seo :modal="$event" title="title"/>
@endsection

@section('content')
    <div class="container mx-auto px-4 max-w-7xl">
        <x-user.bread-crumb :data="['Home', 'Events', $event->title]"/>
        
        @php
            $eventDate = Carbon::parse($event->start);
            $isLive = $eventDate->isToday();
            $isUpcoming = $eventDate->isFuture();
            $isPast = $eventDate->isPast() && !$isLive;
        @endphp
        
        <!-- Event Hero Section -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden mb-8">
            <!-- Event Image -->
            <div class="relative">
                <!-- Event Status Badge -->
                @if($isLive)
                    <div class="event-status-live absolute top-4 left-4 z-10 text-white px-4 py-2 rounded-xl font-bold shadow-lg">
                        <i class='bx bx-radio-circle-marked mr-1 animate-pulse'></i>
                        LIVE NOW
                    </div>
                @elseif($isUpcoming)
                    <div class="event-status-upcoming absolute top-4 left-4 z-10 text-white px-4 py-2 rounded-xl font-bold shadow-lg">
                        <i class='bx bx-calendar mr-1'></i>
                        UPCOMING
                    </div>
                @else
                    <div class="event-status-past absolute top-4 left-4 z-10 text-white px-4 py-2 rounded-xl font-bold shadow-lg">
                        <i class='bx bx-check-circle mr-1'></i>
                        COMPLETED
                    </div>
                @endif
                
                <!-- Event Date Badge -->
                <div class="event-date-badge absolute top-4 right-4 z-10 text-white p-3 rounded-xl shadow-lg text-center min-w-16">
                    <div class="text-xs font-medium">{{ $eventDate->format('M') }}</div>
                    <div class="text-xl font-bold">{{ $eventDate->format('d') }}</div>
                    <div class="text-xs">{{ $eventDate->format('Y') }}</div>
                </div>
                
                <img src="{{ url('storage/' . $event->thumbnail) }}" 
                     alt="{{ $event->title }}" 
                     class="event-image w-full h-64 md:h-80 object-cover">
            </div>

            <!-- Event Information -->
            <div class="p-6 md:p-8">
                <div class="grid lg:grid-cols-3 gap-8">
                    <!-- Event Details -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Title & Basic Info -->
                        <div>
                            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ $event->title }}</h1>
                            
                            <!-- Event Meta -->
                            <div class="space-y-3">
                                <div class="flex items-center text-lg text-gray-700">
                                    <i class='bx bx-calendar text-purple-600 mr-3 text-xl'></i>
                                    <span class="font-medium">{{ $eventDate->format('l, F j, Y') }}</span>
                                </div>
                                <div class="flex items-center text-lg text-gray-700">
                                    <i class='bx bx-time text-blue-600 mr-3 text-xl'></i>
                                    <span class="font-medium">{{ $eventDate->format('g:i A') }} onwards</span>
                                </div>
                                <div class="flex items-center text-lg text-gray-700">
                                    <i class='bx bx-map text-green-600 mr-3 text-xl'></i>
                                    <span class="font-medium">{{ $event->address->country->name ?? 'Online Event' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Countdown Timer (for upcoming events) -->
                        @if($isUpcoming)
                        <div class="countdown-timer rounded-2xl p-6 text-white">
                            <h3 class="text-xl font-bold mb-4 text-center flex items-center justify-center">
                                <i class='bx bx-time mr-2'></i>
                                Event Starts In
                            </h3>
                            <div id="eventCountdown" class="flex justify-center space-x-4">
                                <div class="countdown-digit rounded-lg p-4 text-center min-w-20">
                                    <div class="text-2xl font-bold" id="days">00</div>
                                    <div class="text-sm opacity-75">Days</div>
                                </div>
                                <div class="countdown-digit rounded-lg p-4 text-center min-w-20">
                                    <div class="text-2xl font-bold" id="hours">00</div>
                                    <div class="text-sm opacity-75">Hours</div>
                                </div>
                                <div class="countdown-digit rounded-lg p-4 text-center min-w-20">
                                    <div class="text-2xl font-bold" id="minutes">00</div>
                                    <div class="text-sm opacity-75">Minutes</div>
                                </div>
                                <div class="countdown-digit rounded-lg p-4 text-center min-w-20">
                                    <div class="text-2xl font-bold" id="seconds">00</div>
                                    <div class="text-sm opacity-75">Seconds</div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="grid md:grid-cols-2 gap-4">
                            @if($isUpcoming)
                                <button onclick="addToCalendar()" 
                                        class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-semibold py-3 rounded-xl hover:from-purple-700 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                                    <i class='bx bx-calendar-plus mr-2'></i>
                                    Add to Calendar
                                </button>
                            @endif
                            <button onclick="shareEvent()" 
                                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 rounded-xl transition-colors duration-300 border border-gray-300">
                                <i class='bx bx-share mr-2'></i>
                                Share Event
                            </button>
                        </div>
                    </div>

                    <!-- Organizer Information -->
                    <div class="lg:col-span-1">
                        <div class="organizer-card rounded-2xl shadow-lg border border-gray-200 p-6 sticky top-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-4 text-center">Event Organizer</h3>
                            
                            <!-- Organizer Avatar -->
                            <div class="text-center mb-4">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($event->company->name) }}&background=7c3aed&color=fff&size=80" 
                                     alt="{{ $event->company->name }}"
                                     class="w-20 h-20 rounded-full mx-auto border-4 border-purple-100 shadow-lg">
                            </div>
                            
                            <!-- Organizer Details -->
                            <div class="text-center space-y-3">
                                <h4 class="text-lg font-bold text-gray-900">{{ $event->company->name }}</h4>
                                <p class="text-sm text-gray-600">Event published {{ $event->created_at->diffForHumans() }}</p>
                                
                                <!-- Organizer Stats (if available) -->
                                <div class="grid grid-cols-2 gap-4 py-4">
                                    <div class="text-center">
                                        <div class="text-lg font-bold text-purple-600">{{ $event->company->events_count ?? '1' }}</div>
                                        <div class="text-xs text-gray-600">Events</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-lg font-bold text-blue-600">{{ $event->getReviews()->count() }}</div>
                                        <div class="text-xs text-gray-600">Reviews</div>
                                    </div>
                                </div>
                                
                                <!-- Contact Organizer Button -->
                                <a href="{{ route('view.company', [$event->company->slug]) }}"
                                   class="block w-full text-center bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 rounded-lg transition-colors duration-300">
                                    <i class='bx bx-message-dots mr-2'></i>
                                    Contact Organizer
                                </a>
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
                        class="tab-button active flex-1 px-6 py-4 font-semibold text-gray-700 hover:text-purple-600 hover:bg-white transition-all duration-200 border-b-2 border-transparent">
                    <i class='bx bx-file-blank mr-2'></i>
                    Description
                </button>
                <button onclick="switchTab('gallery')" 
                        id="tab-gallery" 
                        class="tab-button flex-1 px-6 py-4 font-semibold text-gray-700 hover:text-purple-600 hover:bg-white transition-all duration-200 border-b-2 border-transparent">
                    <i class='bx bx-image mr-2'></i>
                    Gallery
                </button>
                <button onclick="switchTab('reviews')" 
                        id="tab-reviews" 
                        class="tab-button flex-1 px-6 py-4 font-semibold text-gray-700 hover:text-purple-600 hover:bg-white transition-all duration-200 border-b-2 border-transparent">
                    <i class='bx bx-star mr-2'></i>
                    Reviews ({{ $event->getReviews()->count() }})
                </button>
            </div>

            <!-- Tab Content -->
            <div class="p-6">
                <!-- Description Tab -->
                <div id="content-description" class="tab-content active">
                    <div class="max-w-4xl">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                            <i class='bx bx-info-circle text-purple-600 mr-3'></i>
                            About This Event
                        </h3>
                        
                        <div class="prose prose-gray max-w-none bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6">
                            {!! $event->description !!}
                        </div>

                        <!-- Event Highlights -->
                        <div class="grid md:grid-cols-2 gap-6 mt-8">
                            <div class="bg-purple-50 rounded-xl p-6 border border-purple-100">
                                <h4 class="font-bold text-gray-900 mb-3 flex items-center">
                                    <i class='bx bx-star text-purple-600 mr-2'></i>
                                    Event Highlights
                                </h4>
                                <ul class="space-y-2 text-sm text-gray-700">
                                    <li class="flex items-center">
                                        <i class='bx bx-check text-purple-600 mr-2'></i>
                                        Interactive sessions
                                    </li>
                                    <li class="flex items-center">
                                        <i class='bx bx-check text-purple-600 mr-2'></i>
                                        Networking opportunities
                                    </li>
                                    <li class="flex items-center">
                                        <i class='bx bx-check text-purple-600 mr-2'></i>
                                        Expert speakers
                                    </li>
                                </ul>
                            </div>
                            
                            <div class="bg-blue-50 rounded-xl p-6 border border-blue-100">
                                <h4 class="font-bold text-gray-900 mb-3 flex items-center">
                                    <i class='bx bx-info-circle text-blue-600 mr-2'></i>
                                    What to Expect
                                </h4>
                                <ul class="space-y-2 text-sm text-gray-700">
                                    <li class="flex items-center">
                                        <i class='bx bx-check text-blue-600 mr-2'></i>
                                        Professional networking
                                    </li>
                                    <li class="flex items-center">
                                        <i class='bx bx-check text-blue-600 mr-2'></i>
                                        Industry insights
                                    </li>
                                    <li class="flex items-center">
                                        <i class='bx bx-check text-blue-600 mr-2'></i>
                                        Q&A sessions
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Gallery Tab -->
                <div id="content-gallery" class="tab-content">
                    <div class="max-w-6xl">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                            <i class='bx bx-image text-purple-600 mr-3'></i>
                            Event Gallery
                        </h3>
                        
                        @php
                            $galleryItems = is_string($event->gallery) ? json_decode($event->gallery) : $event->gallery;
                        @endphp

                        @if($galleryItems && count($galleryItems) > 0)
                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" id="event-gallery">
                                @foreach($galleryItems as $item)
                                    <div class="gallery-item group rounded-xl overflow-hidden shadow-md hover:shadow-xl">
                                        <img alt="Event gallery image" 
                                             src="{{ url('storage/' . $item) }}"
                                             class="w-full h-32 md:h-40 object-cover group-hover:scale-110 transition-transform duration-300">
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-16 bg-gray-50 rounded-2xl">
                                <i class='bx bx-image text-6xl text-gray-300 mb-4'></i>
                                <h4 class="text-lg font-semibold text-gray-600 mb-2">No Gallery Images</h4>
                                <p class="text-gray-500">Gallery images will be available soon.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Reviews Tab -->
                <div id="content-reviews" class="tab-content">
                    <div class="grid gap-8 lg:grid-cols-3">
                        <!-- Review Summary -->
                        <div class="lg:col-span-1">
                            <div class="bg-gradient-to-br from-purple-50 to-indigo-50 rounded-2xl p-6 border border-purple-100 sticky top-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                                    <i class='bx bx-star text-yellow-500 mr-2'></i>
                                    Event Reviews
                                </h3>

                                <div class="text-center mb-6">
                                    <div class="text-4xl font-bold text-gray-900 mb-2">
                                        {{ number_format(HelperFunctions::getRatingAverage('event', $event->id), 1) }}
                                    </div>
                                    
                                    <!-- Custom Star Rating Display -->
                                    <div class="flex items-center justify-center mb-2">
                                        @php $rating = HelperFunctions::getRatingAverage('event', $event->id); @endphp
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
                                        Based on {{ $event->getReviews()->count() }} {{ Str::plural('review', $event->getReviews()->count()) }}
                                    </p>
                                </div>

                                @auth
                                    @if(auth()->user()->hasRated("event", $event->id))
                                        <div class="bg-green-100 text-green-800 p-4 rounded-xl text-center">
                                            <i class='bx bx-check-circle text-2xl mb-2'></i>
                                            <p class="font-medium">Thank you for your review!</p>
                                        </div>
                                    @else
                                        <button onclick="showReviewModal()"
                                                class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-semibold py-3 rounded-xl hover:from-purple-700 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105">
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
                            
                            @if($event->getReviews()->count() > 0)
                                <div class="space-y-4">
                                    @foreach($event->getReviews() as $item)
                                        <div class="review-card rounded-2xl p-6 border border-gray-200 hover:shadow-lg transition-all duration-300">
                                            <div class="flex items-start justify-between mb-4">
                                                <div class="flex items-center">
                                                    <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold mr-4">
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
                                    {{ $event->getReviews()->links() }}
                                </div>
                            @else
                                <div class="text-center py-12 bg-gray-50 rounded-2xl">
                                    <i class='bx bx-message-dots text-6xl text-gray-300 mb-4'></i>
                                    <h4 class="text-lg font-semibold text-gray-600 mb-2">No Reviews Yet</h4>
                                    <p class="text-gray-500">Be the first to review this event!</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Events Section -->
        @if($related_events && $related_events->count() > 0)
        <section class="mb-12">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-3xl font-bold text-gray-900 flex items-center">
                    <i class='bx bx-calendar-event text-purple-600 mr-3'></i>
                    Related Events
                </h2>
                <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm font-medium">
                    {{ $related_events->count() }} {{ Str::plural('Event', $related_events->count()) }}
                </span>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($related_events as $relatedEvent)
                    @php
                        $relatedEventDate = Carbon::parse($relatedEvent->start);
                        $relatedIsLive = $relatedEventDate->isToday();
                        $relatedIsUpcoming = $relatedEventDate->isFuture();
                    @endphp
                    
                    <div class="related-event-card bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden group relative">
                        <!-- Event Status Badge -->
                        @if($relatedIsLive)
                            <div class="event-status-live absolute top-3 left-3 z-10 text-white px-3 py-1 rounded-full text-xs font-bold">
                                <i class='bx bx-radio-circle-marked mr-1'></i>
                                LIVE
                            </div>
                        @elseif($relatedIsUpcoming)
                            <div class="event-status-upcoming absolute top-3 left-3 z-10 text-white px-3 py-1 rounded-full text-xs font-bold">
                                UPCOMING
                            </div>
                        @endif

                        <!-- Time Badge -->
                        <div class="absolute top-3 right-3 z-10 bg-purple-600 text-white px-3 py-1 rounded-full text-xs font-bold">
                            {{ $relatedEventDate->diffForHumans() }}
                        </div>

                        <!-- Event Image -->
                        <div class="relative h-48 bg-gray-50 overflow-hidden">
                            <a href="{{ route('view.event', [$relatedEvent->slug]) }}">
                                <img alt="{{ $relatedEvent->title }}" 
                                     src="{{ url('storage/' . $relatedEvent->thumbnail) }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            </a>
                        </div>

                        <!-- Event Info -->
                        <div class="p-4">
                            <!-- Organizer Info -->
                            <div class="flex items-center mb-3">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($relatedEvent->company->name) }}&background=7c3aed&color=fff&size=32" 
                                     alt="{{ $relatedEvent->company->name }}"
                                     class="w-8 h-8 rounded-full mr-3">
                                <div>
                                    <div class="font-medium text-gray-900 text-sm">{{ $relatedEvent->company->name }}</div>
                                    <div class="text-xs text-gray-600">{{ $relatedEvent->created_at->diffForHumans() }}</div>
                                </div>
                            </div>

                            <h4 class="font-semibold text-gray-900 mb-3 line-clamp-2 group-hover:text-purple-600 transition-colors">
                                <a href="{{ route('view.event', [$relatedEvent->slug]) }}">
                                    {{ $relatedEvent->title }}
                                </a>
                            </h4>

                            <!-- Event Description -->
                            <div class="text-sm text-gray-600 mb-4 line-clamp-3">
                                @php
                                    $description = strip_tags($relatedEvent->description);
                                    $description = strlen($description) > 100 ? substr($description, 0, 100) . "..." : $description;
                                @endphp
                                {!! $description !!}
                            </div>

                            <!-- Event Date -->
                            <div class="flex items-center justify-between text-sm text-gray-600 mb-4">
                                <div class="flex items-center">
                                    <i class='bx bx-calendar text-purple-500 mr-1'></i>
                                    {{ $relatedEventDate->format('M j, Y') }}
                                </div>
                                <div class="flex items-center">
                                    <i class='bx bx-time text-blue-500 mr-1'></i>
                                    {{ $relatedEventDate->format('g:i A') }}
                                </div>
                            </div>

                            <a href="{{ route('view.event', [$relatedEvent->slug]) }}"
                               class="block w-full text-center bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-semibold py-3 rounded-xl hover:from-purple-700 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105">
                                <i class='bx bx-calendar-event mr-2'></i>
                                View Event
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
                    <h3 class="text-2xl font-bold text-gray-900">Rate This Event</h3>
                    <button onclick="hideReviewModal()" class="text-gray-400 hover:text-gray-600 text-2xl">
                        <i class='bx bx-x'></i>
                    </button>
                </div>
                
                <form id="reviewForm" onsubmit="submitReview(event)">
                    @csrf
                    <div class="space-y-6">
                        <div class="text-center">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Rate this event</label>
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
                                      placeholder="Share your experience with this event..."
                                      class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 resize-none"
                                      required></textarea>
                        </div>
                    </div>
                    
                    <input type="hidden" name="item_id" value="{{ $event->id }}">
                    
                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" onclick="hideReviewModal()" 
                                class="px-6 py-3 text-gray-600 hover:text-gray-800 font-medium transition-colors">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-semibold rounded-lg hover:from-purple-700 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105">
                            Submit Review
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="image-viewer"></div>
@endsection

@section('page-scripts')
    <script>
        // Initialize Viewer.js for gallery
        document.addEventListener('DOMContentLoaded', function() {
            const gallery = new Viewer(document.getElementById('event-gallery'), {
                navbar: true,
                toolbar: true,
                title: true,
            });
        });

        // Tab Switching Functionality
        function switchTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.remove('active');
            });
            
            // Remove active class from all tab buttons
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('active', 'text-purple-600', 'bg-white', 'border-purple-600');
                button.classList.add('text-gray-700');
            });
            
            // Show selected tab content
            const selectedContent = document.getElementById('content-' + tabName);
            const selectedButton = document.getElementById('tab-' + tabName);
            
            if (selectedContent && selectedButton) {
                selectedContent.classList.add('active');
                selectedButton.classList.add('active', 'text-purple-600', 'bg-white', 'border-purple-600');
                selectedButton.classList.remove('text-gray-700');
            }
        }

        // Event Countdown Timer
        function startEventCountdown() {
            const eventDate = new Date('{{ $eventDate->toISOString() }}').getTime();
            
            const timer = setInterval(function() {
                const now = new Date().getTime();
                const timeLeft = eventDate - now;
                
                if (timeLeft <= 0) {
                    clearInterval(timer);
                    document.getElementById('eventCountdown').innerHTML = '<div class="text-center text-lg font-bold">Event has started!</div>';
                    return;
                }
                
                const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
                
                document.getElementById('days').textContent = days.toString().padStart(2, '0');
                document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
                document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
                document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
            }, 1000);
        }

        // Add to Calendar Function
        function addToCalendar() {
            const title = encodeURIComponent('{{ $event->title }}');
            const startDate = '{{ $eventDate->format('Ymd\THis') }}';
            const endDate = '{{ $eventDate->addHours(2)->format('Ymd\THis') }}'; // Assume 2 hour duration
            const details = encodeURIComponent('{{ strip_tags($event->description) }}');
            const location = encodeURIComponent('{{ $event->address->country->name ?? "Online" }}');
            
            const googleCalendarUrl = `https://calendar.google.com/calendar/render?action=TEMPLATE&text=${title}&dates=${startDate}/${endDate}&details=${details}&location=${location}`;
            
            window.open(googleCalendarUrl, '_blank');
        }

        // Share Event Function
        async function shareEvent() {
            const shareData = {
                title: '{{ $event->title }}',
                text: 'Check out this amazing event!',
                url: window.location.href
            };

            try {
                if (navigator.share) {
                    await navigator.share(shareData);
                } else {
                    // Fallback: Copy to clipboard
                    await navigator.clipboard.writeText(window.location.href);
                    showNotification('Event link copied to clipboard!', 'success');
                }
            } catch (error) {
                console.error('Error sharing:', error);
                showNotification('Failed to share event. Please try again.', 'error');
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
                const response = await fetch('{{ route('api.product.rate', ['type' => 'event']) }}', {
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
            switchTab('description');
            
            // Start countdown timer for upcoming events
            @if($isUpcoming)
                startEventCountdown();
            @endif
            
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
            document.querySelectorAll('.related-event-card, .review-card').forEach(el => {
                observer.observe(el);
            });
        });
    </script>
@endsection