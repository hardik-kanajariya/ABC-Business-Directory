@php use App\classes\HelperFunctions; @endphp
@php use Carbon\Carbon; @endphp
@extends('layouts.user')

@section('head')
    <style>
        .s-form > [type="text"]:focus {
            outline: none;
            border: none;
            --tw-ring-color: #fff;
        }
    </style>
@endsection

@section('page-scripts')
    <script>
        const searchInput = document.getElementById('searchInput');
        const searchResults = document.getElementById('searchResults');

        searchInput.addEventListener('input', async function () {
            const inputValue = this.value.trim().toLowerCase();

            // Check if inputValue is at least 3 characters
            if (inputValue.length >= 3) {
                const searchURL = "{{ route('api.search.product', ['search' => '__input__']) }}".replace('__input__', inputValue);

                try {
                    await fetch(searchURL)
                        .then(response => response.json())
                        .then(data => {
                            // Clear previous results
                            searchResults.innerHTML = '';
                            // Handle no results
                            if (data.length === 0) {
                                const noResults = document.createElement('p');
                                noResults.textContent = 'No results found';
                                searchResults.appendChild(noResults);
                                // styling padding and margin
                                noResults.style.padding = '8px';
                                noResults.style.margin = '0';
                                searchResults.style.display = 'block';
                                return;
                            }

                            // Filter and display results
                            data.forEach(result => {
                                const resultElement = document.createElement('a');
                                resultElement.textContent = result;
                                resultElement.href = "{{ route('products', ['search' => '__slug__']) }}".replace('__slug__', result);
                                console.log(resultElement.href)

                                searchResults.appendChild(resultElement);
                                // Show or hide the result container based on the input length
                                searchResults.style.display = inputValue.length >= 3 ? 'block' : 'none';
                            });
                        });
                } catch (error) {
                    console.error('Error fetching search results:', error);
                }
            } else {
                searchResults.style.display = 'none';
            }
        });
    </script>
@endsection

@section('content')
    <!-- Search Section -->
    <section class="relative py-8 md:h-[60vh] flex flex-col items-center justify-center overflow-visible">
        <div class="absolute inset-0 bg-gradient-to-r from-purple-500 via-green-300 to-purple-500 opacity-25"></div>
        <div class="mx-auto text-center relative z-10 ">
            <h1 class="md:text-3xl text-xl lg:text-5xl font-semibold text-dark mb-2">Discover Top Companies and
                Products</h1>
            <p class="text-dark text-xs md:text-lg mb-4">Explore a vast network of five lakh+ businesses and products
                for your needs</p>
            <form action="{{ route('products') }}"
                  class="mt-2 md:mt-4 flex items-center justify-center rounded-full p-2 pl-1 relative bg-white w-[80vw] md:w-full m-auto md:p-4 md:pl-2"
                  style="z-index: 99;">
                <div class="relative flex items-center justify-between w-full s-form">
                    <label for="searchInput" class="sr-only">Search</label>
                    <input id="searchInput" name="search" type="text" placeholder="Type at least 3 characters"
                           autocomplete="off"
                           class="search-input focus:outline-none px-1 py-1 rounded-full border-none outline-none focus:border-none transition-all duration-300 ease-in-out w-full placeholder:text-xs md:placeholder:text-base md:px-6 md-py-2">
                    <button type="submit"
                            class="bg-blue-500 text-white py-2 px-4 w-auto rounded-full ml-2 hover:bg-blue-600 transition-all duration-300 ease-in-out flex items-center justify-center flex-row-reverse">
                        <i class='bx bx-search-alt-2 md:hidden'></i>
                        <span class="hidden sm:block md:block lg:block">Search</span>
                    </button>
                </div>
                <div id="searchResults"
                     class="search-results mt-2 overflow-auto max-h-[30vh] md:max-h-[40vh] lg:max-h-[50vh]"></div>
            </form>
        </div>
    </section>
    <!-- Main Content -->
    <section class="container mx-auto">
        <!-- Top Categories -->
        <section class="p-2 my-1 md:p-8 md:my-4">
            <div class="container mx-auto">
                <div class="flex justify-between items-center">
                    <h1 class="text-base sm:text-2xl md:text-3xl font-semibold inline-block text-blue-900">
                        Categories</h1>
                    <a href="{{ route('categories')}}"
                       class="md:bg-purple-700 text-white rounded-full flex items-center hover:bg-purple-600 transition duration-300 ease-in-out underline md:no-underline md:px-4 md:py-2">
                        <span class="text-purple-500 md:text-white">Explore All</span>
                        {{-- Icon --}}
                        <i class='bx bx-link-external p-1 text-purple-500 md:hidden'></i>
                    </a>
                </div>
                <hr class="my-2 md:my-5">
                <div class="grid grid-cols-3 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-5 gap-1 md:gap-3">
                    <!-- Category Card 1 -->
                    @if(is_iterable($category))
                        @forelse($category as $item)
                            @php
                                $route = match($item->type) {
                                    'product' => 'products',
                                    'event' => 'events',
                                    'blog' => 'blogs',
                                    'job' => 'jobs',
                                    'forum' => 'forum',
                                    default => 'company',
                                };
                                $is_featured = $item->is_featured ? 'bg-yellow-200 hover:shadow-gray-400' : 'bg-indigo-100 hover:shadow-gray-400';
                            @endphp
                            <a href="{{ route($route, ['category' => $item->name]) }}"
                               class="flex justify-center items-center w-full mb-6 relative">
                                @if($item->is_featured)
                                    <div
                                        class="absolute top-0 left-0 bg-blue-500 text-white p-1 px-2 text-xs font-bold rounded">
                                        Featured
                                    </div>
                                @endif
                                <div class="w-64 bg-white rounded-lg shadow-lg overflow-hidden">
                                    @if($item->image)
                                        <img src="{{ url('storage/' . $item->image) }}" alt="{{ $item->name }}"
                                             class="w-full h-48 object-cover"/>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-full h-48 object-cover">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/>
                                        </svg>
                                    @endif
                                    <div class="p-4">
                                        <p class="text-gray-700 font-semibold">{{ Str::limit($item->name, 20) }}</p>
                                        <p class="text-gray-600 text-sm mt-1">{{ $item->countItem($item->type) }}
                                            Items</p>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <p class="text-gray-700">No categories available.</p>
                        @endforelse
                    @else
                        <p class="text-gray-700">Invalid category data.</p>
                    @endif
                </div>
            </div>
        </section>

        <!-- Featured Companies -->
        <section class="p-2 my-1 md:p-8 md:my-4">
            <div class="container mx-auto">
                <div class="flex justify-between items-center">
                    <h1 class="text-base sm:text-2xl md:text-3xl font-semibold inline-block text-blue-900">Featured
                        Companies</h1>
                    <a href="{{ route('company') }}"
                       class="md:bg-purple-700 text-white rounded-full flex items-center hover:bg-purple-600 transition duration-300 ease-in-out underline md:no-underline md:px-4 md:py-2">
                        <span class="text-purple-500 md:text-white">Explore All</span>
                        {{-- Icon --}}
                        <i class='bx bx-link-external p-1 text-purple-500 md:hidden'></i>
                    </a>
                </div>
                <hr class="my-5">
                <div class="md:grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-2 md:gap-6 mx-auto">
                    @forelse($companies as $company)
                        <div
                            class="reveal hidden md:flex items-center justify-stretch flex-col bg-white rounded-lg shadow-md overflow-hidden transform transition-transform duration-300 ease-in-out hover:-translate-y-2 m-auto w-[90vw] md:w-full h-full">
                            @if($company->is_featured)
                                <div
                                    class="absolute top-0 left-0 bg-red-500 text-white p-1 px-2 text-xs font-bold rounded">
                                    Featured
                                </div>
                            @endif
                            <a href="{{ route('view.company', [$company->slug]) }}"
                               class="w-[150px] h-[150px] md:w-full md:h-48 md:p-4 md:block object-contain">
                                <img alt="company photo" src="{{ url('storage/' . $company->logo) }}"
                                     class="w-[150px] h-[150px] object-contain md:w-full md:h-full"/>
                            </a>
                            <div class="flex flex-col items-center justify-center h-auto my-auto">
                                <div class="p-2 flex flex-col items-center justify-center m-auto">
                                    <h3 class="text-base md:text-lg font-bold text-justify text-indigo-900 mb-2">{{ $company->name }}</h3>
                                    <p class="text-red-700 text-center text-xs md:text-sm">{{ $company->address?->country?->name }}</p>
                                    <h2 class="text-sm md:text-base bold italic underline text-indigo-700 mt-2">Deals
                                        In</h2>
                                    @php
                                        $limitedText = Str::limit($company->dealsIn(), 30, '...');
                                    @endphp
                                    <p class="text-gray-700 text-center text-xs md:text-sm">{{ $limitedText }}</p>
                                </div>
                            </div>
                            <div class="w-[calc(80%-1rem)] m-auto">
                                <a href="{{ route('view.company', [$company->slug]) }}"
                                   class="text-purple-500 mb-1 bg-purple-100 hover:bg-purple-500 hover:text-white rounded-full p-1 transition duration-300 ease-in-out flex items-center justify-center transform hover:-translate-y-1 hover:scale-60 text-center text-xs md:text-base">
                                    <span class="ml-1">View Profile &nbsp;</span>
                                    <i class='bx bx-link-external mr-2'></i>
                                </a>
                            </div>

                        </div>
                        <!-- Mobile Version Card -->
                        <div
                            class="md:hidden company-card bg-white rounded-lg shadow-md overflow-hidden transform transition-transform duration-300 ease-in-out hover:-translate-y-2 flex flex-col items-center justify-center p-2 mx-2 my-5">
                            <div class="overflow-hidden mb-4 p-2 md:border-r border-r-1 border-solid border-gray-300">
                                <img class="w-full h-40 object-contain overflow-hidden"
                                     src="{{ url('storage/' . $company->logo) }}"
                                     alt="">
                            </div>
                            <ul class="w-full mx-3 ml-5">
                                <li class="flex flex-nowrap items-center">
                                    <span class="text-lg md:text-2xl mr-3">{{$company->name}}</span>
                                    @if($company->is_featured)
                                        <span>
                                        <button
                                            class="inline-flex items-center bg-neutral-100 mr-1 text-white border border-solid-400 rounded">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor"
                                                 class="w-4 h-4 text-white bg-green-500">
                                              <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z"/>
                                            </svg>
                                            <span class="mx-1 text-gray-500 text-xs">Featured</span>
                                        </button>
                                    </span>
                                    @endif
                                </li>
                                <li class="text-sm md:text-base text-gray-500">
                                    <i class='bx bx-been-here text-red-500'></i> {{$company->address?->state?->name}}
                                    , {{$company->address?->country?->name}}
                                </li>
                                <li class="w-full flex items-center">
                                    <button class="inline-flex items-center mr-1 text-gray-500">
                                        <i class='bx bxs-star text-green-400 text-sm'></i>
                                        <span
                                            class="mx-1 text-gray-500 text-sm">{{HelperFunctions::getRatingAverage('company', $company->id)}}</span>
                                        <span class="mx-1 text-gray-500 text-sm">({{HelperFunctions::getRatingCount('company', $company->id)}} Review)</span>
                                    </button>
                                </li>
                                <li>
                                    <p class="text-gray-500 text-sm"><span class="font-bold">Deals In</span>:
                                        @forelse($company->extra_things as $item)
                                            @php
                                                $limitedText = Str::limit($item, 80, '...');
                                            @endphp
                                            <span class="text-gray-500 text-sm">
                                            {{ $limitedText }}
                                                @if (strlen($item) > 80)
                                                    <a href="#" class="text-blue-500"
                                                       onclick="showFullText(this)">...More</a>
                                                    <span class="full-text" style="display: none;">{{ $item }}</span>
                                                @endif
                                                @if (!$loop->last)
                                                    |
                                                @endif
                                        </span>
                                        @empty
                                            <span class="text-gray-500 text-sm">No Products</span>
                                        @endforelse
                                        <script>
                                            function showFullText(link) {
                                                let fullTextSpan = link.nextElementSibling;
                                                link.style.display = 'none';
                                                fullTextSpan.style.display = 'inline';
                                            }
                                        </script>
                                    </p>
                                </li>
                                <li>
                                    <div class="md:w-[calc(20%-1rem)] mt-5">
                                        <a href="{{ route('view.company', [$company->slug]) }}"
                                           class="text-purple-500 bg-purple-100 hover:bg-purple-500 hover:text-white rounded-full p-1 mt-1 transition duration-300 ease-in-out flex items-center justify-center transform hover:-translate-y-1 hover:scale-60 text-center">
                                            View Profile &nbsp;
                                            <i class='bx bx-link-external text-2xl mr-2'></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    @empty
                </div>
                <p class="text-gray-700 w-100">No featured companies available.</p>
                @endforelse
            </div>
        </section>

        <!-- Top Products -->
        <section class="p-2 my-1 md:p-8 md:my-4">
            <div class="flex justify-between items-center">
                <h1 class="text-base sm:text-2xl md:text-3xl font-semibold inline-block text-blue-900">Explore Top Products</h1>
                <a href="{{ route('products') }}"
                   class="md:bg-purple-700 text-white rounded-full flex items-center hover:bg-purple-600 transition duration-300 ease-in-out underline md:no-underline md:px-4 md:py-2">
                    <span class="text-purple-500 md:text-white">Explore All</span>
                    {{-- Icon --}}
                    <i class='bx bx-link-external p-1 text-purple-500 md:hidden'></i>
                </a>
            </div>
            <hr class="my-5">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($products as $item)
                    <div
                        class="reveal hidden md:flex bg-white rounded-lg shadow-md overflow-hidden transform transition-transform duration-300 ease-in-out hover:-translate-y-2 flex-col items-center justify-center w-[90vw] md:w-full">
                        @if($item->is_featured)
                            <div class="absolute top-0 left-0 bg-red-500 text-white p-1 px-2 text-xs font-bold rounded">
                                Featured
                            </div>
                        @endif
                        <a href="{{ route('view.product', [$item->slug]) }}"
                           class="w-[150px] h-[150px] md:w-full md:p-4 md:m-auto md:block md:h-full object-contain">
                            <img alt="company photo" src="{{ url('storage/' . $item->thumbnail) }}"
                                 class="w-[150px] h-[150px] md:w-full md:h-48 object-contain"/>
                        </a>
                        <div class="p-2 flex flex-col items-center justify-center">
                            <header class="flex my-2 font-light text-sm items-center">
                                <i class="bx bx-category text-indigo-500 mr-1"></i>
                                <p>{{ $item->category->name }}</p>
                            </header>
                            <p class="text-base font-medium mb-2 text-center">{{ Str::limit($item->name, 30, '...') }}</p>
                            <p class="text-red-700 text-center text-xs md:text-sm">{{ $item->company->name }}</p>
                            <p class="text-gray-700 text-center text-xs md:text-sm">{{ $item->company->address->country->name }}</p>
                            <p class="text-gray-700 text-center text-xs md:text-sm">Price:
                                ${{ HelperFunctions::formatCurrency($item->price) }}</p>
                        </div>
                        <div class="relative bottom-0 md:static right-1 mb-2 w-auto md:w-[calc(80%-1rem)]">
                            <a href="{{ route('view.product', [$item->slug]) }}"
                               class="text-purple-500 mb-1 bg-purple-100 hover:bg-purple-500 hover:text-white rounded-full p-1 transition duration-300 ease-in-out flex items-center justify-center transform hover:-translate-y-1 hover:scale-60 text-center text-xs md:text-base">
                                <span class="ml-1">Enquire Now &nbsp;</span>
                                <i class='bx bx-link-external mr-2'></i>
                            </a>
                        </div>
                    </div>
                    <div
                        class="reveal md:hidden bg-white rounded-lg shadow-md overflow-hidden transform transition-transform duration-300 ease-in-out hover:-translate-y-2 flex md:flex-col items-start md:items-center md:justify-center">
                        @if($item->is_featured)
                            <div class="absolute top-0 left-0 bg-red-500 text-white p-1 px-2 text-xs font-bold rounded"
                                 style="z-index: 99">
                                Featured
                            </div>
                        @endif
                        <a href="{{ route('view.product', [$item->slug]) }}"
                           class="w-[100px] md:w-full h-[80px] md:p-4 md:m-auto md:block md:h-full object-contain">
                            <img alt="company photo" src="{{ url('storage/' . $item->thumbnail) }}"
                                 class="w-full h-full object-cover img-remove-bg"/>
                        </a>
                        <div class="p-1 ml-2 md:p-2 flex flex-col items-start md:items-center md:justify-center w-full">
                            <header class="flex my-2 font-light text-xs md:text-base items-center">
                                <i class="bx bx-category text-indigo-500 mr-1"></i>
                                <p>{{ $item->category->name }}</p>
                            </header>
                            <p class="text-sm md:text-xl font-medium mb-2">{{ $item->name }}</p>
                            <p class="text-red-700 text-xs md:text-sm">{{ $item->company ? $item->company->name: '' }}</p>
                            <p class="text-gray-700 text-xs md:text-sm">{{ $item->company? $item->company->address->country->name : '' }}</p>
                            <p class="text-gray-700 text-xs md:text-sm">Price:
                                ${{ HelperFunctions::formatCurrency($item->price) }}</p>
                            <div class="block md:hidden md:static mb-2 w-full">
                                <a href="{{ route('view.product', [$item->slug]) }}"
                                   class="text-purple-500 mb-1 rounded-full p-1 transition duration-300 ease-in-out flex items-center justify-center transform hover:-translate-y-1 hover:scale-60 text-center text-xs md:text-base">
                                    <span class="ml-1">Enquire Now &nbsp;</span>
                                    <i class='bx bx-link-external mr-2'></i>
                                </a>
                            </div>
                        </div>
                        <div
                            class="hidden md:block absolute bottom-0 md:static right-1 mb-2 w-full md:w-[calc(80%-1rem)]">
                            <a href="{{ route('view.product', [$item->slug]) }}"
                               class="text-purple-500 mb-1 bg-purple-100 hover:bg-purple-500 hover:text-white rounded-full p-1 transition duration-300 ease-in-out flex items-center justify-center transform hover:-translate-y-1 hover:scale-60 text-center text-xs md:text-base">
                                <span class="ml-1">Enquire Now &nbsp;</span>
                                <i class='bx bx-link-external mr-2'></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-700 col-span-full">No listings found.</p>
                @endforelse
            </div>
        </section>

        <!-- Featured Events -->
        <section class="p-2 my-1 md:p-8 md:my-4">
            <div class="container mx-auto">
                <div class="flex justify-between items-center">
                    <h1 class="text-base sm:text-2xl md:text-3xl font-semibold inline-block text-blue-900">Featured Events</h1>
                    <a href="{{ route('events') }}"
                       class="md:bg-purple-700 text-white rounded-full flex items-center hover:bg-purple-600 transition duration-300 ease-in-out underline md:no-underline md:px-4 md:py-2">
                        <span class="text-purple-500 md:text-white">Explore All</span>
                        {{-- Icon --}}
                        <i class='bx bx-link-external p-1 text-purple-500 md:hidden'></i>
                    </a>
                </div>
                <hr class="my-5">
                <div class="owl-carousel grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @forelse($events as $event)
                        <div
                            class="reveal bg-white rounded-lg shadow-md overflow-hidden transform transition-transform duration-300 ease-in-out hover:-translate-y-2">
                            <div class="each relative flex flex-col items-stretch justify-center">
                                <img src="{{ url('storage/'.$event->thumbnail) }}"
                                     class="w-full h-48 object-cover rounded-t-lg" alt="Event">
                                <div class="desc p-4 text-gray-800">
                                    <div class="flex items-center mt-2">
                                        <img class='w-8 h-8 object-cover rounded-full' alt='User avatar' src='https://ui-avatars.com/api/?name={{$event->company?->name}}'/>
                                        <div class="pl-3">
                                            <div class="font-medium text-sm">
                                                {{$event->company?->name}}
                                            </div>
                                            <div class="text-gray-600 text-sm">
                                                {{$event->created_at->diffForHumans()}}
                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{route('view.event', [$event->slug])}}" target="_new"
                                       class="my-3 title font-bold block cursor-pointer hover:underline">{{$event->title}}</a>
                                    <div class="md:block flex items-center justify-between">
                                        <div class="flex items-center justify-between mt-4">
                                            <div class="flex items-center">
                                                <i class='bx bx-calendar text-gray-600'></i>
                                                @php
                                                    $date = Carbon::parse($event->start);
                                                    $date = $date->format('M d, Y');
                                                @endphp
                                                <span class="text-gray-600 text-sm ml-1">{{$date}}</span>
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-between mt-4">
                                            <div class="flex items-center">
                                                <i class='bx bx-current-location text-gray-600'></i>
                                                <span class="text-gray-600 text-sm ml-1">{{$event->address->country->name}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-700">No featured events available.</p>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- Why Choose Us -->
        <section class="text-gray-600 body-font mt-3">
            <div class="container px-5 py-4 mx-auto">
                <div class="text-center mb-10">
                    <h1 class="sm:text-3xl text-2xl font-medium title-font text-gray-900 mb-4">
                        Why Choose Us
                    </h1>
                    <p class="text-base leading-relaxed xl:w-2/4 lg:w-3/4 mx-auto text-gray-500">
                        In the picturesque village of Jam Kalyanpur, we take pride in our commitment to excellence.
                        Explore why choosing us is a decision you won't regret.
                    </p>
                    <div class="flex mt-6 justify-center">
                        <div class="w-16 h-1 rounded-full bg-indigo-500 inline-flex"></div>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="p-4 flex flex-col text-center items-center card reveal">
                        <div
                            class="w-20 h-20 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-4 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
                            </svg>
                        </div>
                        <div class="flex-grow">
                            <h2 class="text-gray-900 text-lg title-font font-medium mb-3">Promote your business worldwide</h2>
                            <p class="leading-relaxed text-base">
                                As a full-stack apprentice intern in the heart of Kathiawar, specializing in Angular and
                                .NET Core,
                                I bring the world to your business.
                            </p>
                        </div>
                    </div>
                    <div class="p-4 flex flex-col text-center items-center card reveal">
                        <div
                            class="w-20 h-20 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-4 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                            </svg>
                        </div>
                        <div class="flex-grow">
                            <h2 class="text-gray-900 text-lg title-font font-medium mb-3">Direct Chat with business
                                lister</h2>
                            <p class="leading-relaxed text-base">
                                Engage in direct conversations with me, your dedicated full-stack developer, ensuring
                                your requirements are met efficiently.
                            </p>
                        </div>
                    </div>
                    <div class="p-4 flex flex-col text-center items-center card reveal">
                        <div
                            class="w-20 h-20 inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 mb-4 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                            </svg>
                        </div>
                        <div class="flex-grow">
                            <h2 class="text-gray-900 text-lg title-font font-medium mb-3">Find Millions of buyers</h2>
                            <p class="leading-relaxed text-base">
                                With a dream to become the best game developer and full-stack developer globally, my
                                skills attract millions of potential buyers to your projects.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
@endsection
