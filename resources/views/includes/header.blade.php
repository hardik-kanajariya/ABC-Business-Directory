@auth
    @php
    $name = auth()->user()->name;
    $image = "https://ui-avatars.com/api/?name=$name";
    // check if user has a company
    if(auth()->user()->company != null && auth()->user()->company->logo != null){
        $image = url('storage/' . auth()->user()->company->logo);
    }
    @endphp
@endauth

<!-- Modern Header -->
<header class="bg-white/95 backdrop-blur-lg border-b border-gray-200/50 sticky top-0 z-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            
            <!-- Logo Section -->
            <div class="flex items-center space-x-4">
                <!-- Desktop Logo -->
                <a href="{{ url('/') }}" class="hidden md:flex items-center space-x-2 group">
                    <img src="{{ asset('storage/image/logo.png') }}" 
                         alt="Company Logo" 
                         class="h-[27px] w-[150px] md:h-[27px] md:w-[150px] transition-transform duration-300 group-hover:scale-105">
                </a>
                
                <!-- Mobile Logo -->
                <a href="{{ url('/') }}" class="md:hidden flex items-center group">
                    <img src="{{ asset('storage/image/logo.png') }}" 
                         alt="Company Logo" 
                         class="h-[27px] w-[140px] transition-transform duration-300 group-hover:scale-105">
                </a>
            </div>

            <!-- Desktop Navigation -->
            <nav class="hidden lg:flex items-center justify-center flex-1 max-w-4xl mx-8">
                <div class="bg-gray-50/80 backdrop-blur-sm rounded-2xl shadow-sm border border-gray-200/30 px-3 py-2">
                    <ul class="flex items-center space-x-1">
                        <li>
                            <a href="{{ url('/') }}" 
                               class="{{ session()->get('menu') == 'home' ? 'bg-gradient-to-r from-purple-500 to-purple-600 text-white shadow-lg' : 'text-gray-600 hover:text-purple-600 hover:bg-white/60' }} 
                                      flex items-center px-4 py-2 rounded-xl transition-all duration-300 font-medium text-sm">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('company') }}" 
                               class="{{ session()->get('menu') == 'company' ? 'bg-gradient-to-r from-purple-500 to-purple-600 text-white shadow-lg' : 'text-gray-600 hover:text-purple-600 hover:bg-white/60' }} 
                                      flex items-center px-4 py-2 rounded-xl transition-all duration-300 font-medium text-sm">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                Companies
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('products') }}" 
                               class="{{ session()->get('menu') == 'product' ? 'bg-gradient-to-r from-purple-500 to-purple-600 text-white shadow-lg' : 'text-gray-600 hover:text-purple-600 hover:bg-white/60' }} 
                                      flex items-center px-4 py-2 rounded-xl transition-all duration-300 font-medium text-sm">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                                Products
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('deals') }}" 
                               class="{{ session()->get('menu') == 'deal' ? 'bg-gradient-to-r from-purple-500 to-purple-600 text-white shadow-lg' : 'text-gray-600 hover:text-purple-600 hover:bg-white/60' }} 
                                      flex items-center px-4 py-2 rounded-xl transition-all duration-300 font-medium text-sm relative">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                                Deals
                                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold">3</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('events') }}" 
                               class="{{ session()->get('menu') == 'event' ? 'bg-gradient-to-r from-purple-500 to-purple-600 text-white shadow-lg' : 'text-gray-600 hover:text-purple-600 hover:bg-white/60' }} 
                                      flex items-center px-4 py-2 rounded-xl transition-all duration-300 font-medium text-sm">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Events
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('jobs') }}" 
                               class="{{ session()->get('menu') == 'job' ? 'bg-gradient-to-r from-purple-500 to-purple-600 text-white shadow-lg' : 'text-gray-600 hover:text-purple-600 hover:bg-white/60' }} 
                                      flex items-center px-4 py-2 rounded-xl transition-all duration-300 font-medium text-sm">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0H8m8 0v2a2 2 0 01-2 2H10a2 2 0 01-2-2V6m8 0H8"/>
                                </svg>
                                Jobs
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('blogs') }}" 
                               class="{{ session()->get('menu') == 'blog' ? 'bg-gradient-to-r from-purple-500 to-purple-600 text-white shadow-lg' : 'text-gray-600 hover:text-purple-600 hover:bg-white/60' }} 
                                      flex items-center px-4 py-2 rounded-xl transition-all duration-300 font-medium text-sm">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                                Blogs
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('forum') }}" 
                               class="{{ session()->get('menu') == 'forum' ? 'bg-gradient-to-r from-purple-500 to-purple-600 text-white shadow-lg' : 'text-gray-600 hover:text-purple-600 hover:bg-white/60' }} 
                                      flex items-center px-4 py-2 rounded-xl transition-all duration-300 font-medium text-sm">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a2 2 0 01-2-2v-6a2 2 0 012-2h8z"/>
                                </svg>
                                Forum
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Right Section -->
            <div class="flex items-center space-x-4">
                
                <!-- Mobile Menu Button -->
                <button id="menu-toggle" 
                        class="lg:hidden p-2 rounded-lg text-gray-600 hover:text-purple-600 hover:bg-gray-100 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                    <svg class="w-6 h-6 transition-transform duration-300" id="menu-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <!-- User Authentication Section -->
                @auth
                    <!-- Desktop User Menu -->
                    <div class="hidden md:flex items-center space-x-3">
                        <a href="{{ auth()->user()->type == 'Admin' ? url('admin') : url('user') }}" 
                           class="flex items-center space-x-3 px-3 py-2 rounded-xl hover:bg-gray-100 transition-all duration-300 group">
                            <div class="text-right hidden lg:block">
                                <div class="text-sm font-semibold text-gray-800 group-hover:text-purple-600">
                                    {{ Str::limit(auth()->user()->name, 20) }}
                                </div>
                                <div class="text-xs text-gray-500 capitalize">
                                    {{ auth()->user()->type ?? 'User' }}
                                </div>
                            </div>
                            <div class="relative">
                                <img src="{{ $image }}" 
                                     alt="User Avatar"
                                     class="w-10 h-10 rounded-full object-cover border-2 border-white shadow-sm group-hover:border-purple-200 transition-all duration-300">
                                <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></div>
                            </div>
                        </a>
                    </div>

                    <!-- Mobile User Avatar -->
                    <div class="md:hidden">
                        <a href="{{ auth()->user()->type == 'Admin' ? url('admin') : url('user') }}" 
                           class="relative">
                            <img src="{{ $image }}" 
                                 alt="User Avatar"
                                 class="w-9 h-9 rounded-full object-cover border-2 border-white shadow-sm">
                            <div class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-green-500 border border-white rounded-full"></div>
                        </a>
                    </div>
                @else
                    <!-- Desktop Authentication -->
                    <div class="hidden lg:flex items-center space-x-3">
                        <a href="{{ url('user/login') }}" 
                           class="text-gray-600 hover:text-purple-600 font-medium text-sm px-4 py-2 rounded-lg hover:bg-gray-100 transition-all duration-300">
                            Login
                        </a>
                        <a href="{{ url('user/register') }}" 
                           class="bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-medium text-sm px-6 py-2 rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300">
                            Register
                        </a>
                    </div>

                    <!-- Mobile Authentication -->
                    <div class="md:hidden">
                        <a href="{{ url('user/login') }}" 
                           class="bg-gradient-to-r from-purple-600 to-purple-700 text-white font-medium text-sm px-4 py-2 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300">
                            Login
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>

    <!-- Enhanced Mobile Menu -->
    <div id="mobile-menu" 
         class="lg:hidden hidden bg-white border-t border-gray-200 shadow-xl">
        <div class="max-w-7xl mx-auto px-4 py-6">
            
            <!-- Mobile Navigation Links -->
            <nav class="space-y-2">
                <a href="{{ url('/') }}" 
                   class="{{ session()->get('menu') == 'home' ? 'bg-purple-50 text-purple-600 border-l-4 border-purple-600' : 'text-gray-700 hover:text-purple-600 hover:bg-gray-50' }} 
                          flex items-center px-4 py-3 rounded-lg transition-all duration-300 font-medium">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Home
                </a>
                
                <a href="{{ route('company') }}" 
                   class="{{ session()->get('menu') == 'company' ? 'bg-purple-50 text-purple-600 border-l-4 border-purple-600' : 'text-gray-700 hover:text-purple-600 hover:bg-gray-50' }} 
                          flex items-center px-4 py-3 rounded-lg transition-all duration-300 font-medium">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    Companies
                </a>
                
                <a href="{{ route('products') }}" 
                   class="{{ session()->get('menu') == 'product' ? 'bg-purple-50 text-purple-600 border-l-4 border-purple-600' : 'text-gray-700 hover:text-purple-600 hover:bg-gray-50' }} 
                          flex items-center px-4 py-3 rounded-lg transition-all duration-300 font-medium">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    Products
                </a>
                
                <a href="{{ route('deals') }}" 
                   class="{{ session()->get('menu') == 'deal' ? 'bg-purple-50 text-purple-600 border-l-4 border-purple-600' : 'text-gray-700 hover:text-purple-600 hover:bg-gray-50' }} 
                          flex items-center px-4 py-3 rounded-lg transition-all duration-300 font-medium relative">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    Deals
                    <span class="ml-auto bg-red-500 text-white text-xs px-2 py-1 rounded-full font-bold">3</span>
                </a>
                
                <a href="{{ route('events') }}" 
                   class="{{ session()->get('menu') == 'event' ? 'bg-purple-50 text-purple-600 border-l-4 border-purple-600' : 'text-gray-700 hover:text-purple-600 hover:bg-gray-50' }} 
                          flex items-center px-4 py-3 rounded-lg transition-all duration-300 font-medium">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Events
                </a>
                
                <a href="{{ route('jobs') }}" 
                   class="{{ session()->get('menu') == 'job' ? 'bg-purple-50 text-purple-600 border-l-4 border-purple-600' : 'text-gray-700 hover:text-purple-600 hover:bg-gray-50' }} 
                          flex items-center px-4 py-3 rounded-lg transition-all duration-300 font-medium">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0H8m8 0v2a2 2 0 01-2 2H10a2 2 0 01-2-2V6m8 0H8"/>
                    </svg>
                    Jobs
                </a>
                
                <a href="{{ route('blogs') }}" 
                   class="{{ session()->get('menu') == 'blog' ? 'bg-purple-50 text-purple-600 border-l-4 border-purple-600' : 'text-gray-700 hover:text-purple-600 hover:bg-gray-50' }} 
                          flex items-center px-4 py-3 rounded-lg transition-all duration-300 font-medium">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    Blogs
                </a>
                
                <a href="{{ route('forum') }}" 
                   class="{{ session()->get('menu') == 'forum' ? 'bg-purple-50 text-purple-600 border-l-4 border-purple-600' : 'text-gray-700 hover:text-purple-600 hover:bg-gray-50' }} 
                          flex items-center px-4 py-3 rounded-lg transition-all duration-300 font-medium">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a2 2 0 01-2-2v-6a2 2 0 012-2h8z"/>
                    </svg>
                    Forum
                </a>
            </nav>

            @guest
                <!-- Mobile Authentication Section -->
                <div class="mt-6 pt-6 border-t border-gray-200 space-y-3">
                    <a href="{{ url('user/login') }}" 
                       class="flex items-center justify-center w-full px-4 py-3 border border-purple-300 text-purple-600 rounded-lg hover:bg-purple-50 transition-all duration-300 font-medium">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        Login to Account
                    </a>
                    <a href="{{ url('user/register') }}" 
                       class="flex items-center justify-center w-full px-4 py-3 bg-gradient-to-r from-purple-600 to-purple-700 text-white rounded-lg hover:from-purple-700 hover:to-purple-800 transition-all duration-300 font-medium shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                        Create Account
                    </a>
                </div>
            @else
                <!-- Mobile User Info -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <a href="{{ auth()->user()->type == 'Admin' ? url('admin') : url('user') }}" 
                       class="flex items-center space-x-3 p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-all duration-300">
                        <img src="{{ $image }}" 
                             alt="User Avatar"
                             class="w-12 h-12 rounded-full object-cover border-2 border-white shadow-sm">
                        <div class="flex-1">
                            <div class="font-semibold text-gray-800">{{ auth()->user()->name }}</div>
                            <div class="text-sm text-gray-500 capitalize">{{ auth()->user()->type ?? 'User' }}</div>
                        </div>
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            @endguest
        </div>
    </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuIcon = document.getElementById('menu-icon');
    
    menuToggle.addEventListener('click', function() {
        const isHidden = mobileMenu.classList.contains('hidden');
        
        if (isHidden) {
            // Show menu
            mobileMenu.classList.remove('hidden');
            // Change icon to X
            menuIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>';
            menuIcon.classList.add('rotate-180');
        } else {
            // Hide menu
            mobileMenu.classList.add('hidden');
            // Change icon back to hamburger
            menuIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>';
            menuIcon.classList.remove('rotate-180');
        }
    });
    
    // Close mobile menu when clicking outside
    document.addEventListener('click', function(event) {
        if (!menuToggle.contains(event.target) && !mobileMenu.contains(event.target)) {
            mobileMenu.classList.add('hidden');
            menuIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>';
            menuIcon.classList.remove('rotate-180');
        }
    });
    
    // Close mobile menu on window resize to desktop
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 1024) {
            mobileMenu.classList.add('hidden');
            menuIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>';
            menuIcon.classList.remove('rotate-180');
        }
    });
});
</script>