<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <title>Page Not Found - {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="{{ asset('js/tailwind.js') }}"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'bounce-slow': 'bounce 2s infinite',
                    },
                },
            },
        };
    </script>
</head>

<body class="h-auto bg-gradient-to-br from-purple-600 via-blue-600 to-indigo-700 font-sans antialiased">
    <!-- Background Animation -->
    <div class="absolute inset-0">
        <div class="absolute top-10 left-10 w-72 h-72 bg-white/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-purple-300/20 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute top-1/2 left-1/4 w-24 h-24 bg-blue-300/30 rounded-full blur-xl animate-bounce"></div>
        <div class="absolute bottom-1/4 left-3/4 w-32 h-32 bg-indigo-300/25 rounded-full blur-2xl animate-float"></div>
    </div>

    <!-- Main Content -->
    <div class="relative min-h-screen flex items-center justify-center px-4">
        <div class="text-center max-w-4xl mx-auto">
            
            <!-- 404 Animation -->
            <div class="mb-8 relative">
                <div class="text-9xl md:text-[12rem] lg:text-[15rem] font-bold text-white/20 select-none">
                    404
                </div>
                
                <!-- Floating Elements -->
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="relative">
                        <!-- Magnifying Glass -->
                        <div class="w-24 h-24 md:w-32 md:h-32 relative animate-bounce-slow">
                            <div class="w-16 h-16 md:w-20 md:h-20 border-4 border-white rounded-full bg-white/10 backdrop-blur-sm"></div>
                            <div class="absolute bottom-2 right-2 w-8 h-2 md:w-10 md:h-3 bg-white rounded-full transform rotate-45 origin-bottom-left"></div>
                        </div>
                        
                        <!-- Search Particles -->
                        <div class="absolute -top-4 -left-4 w-2 h-2 bg-yellow-300 rounded-full animate-ping"></div>
                        <div class="absolute -bottom-2 -right-6 w-3 h-3 bg-blue-300 rounded-full animate-pulse"></div>
                        <div class="absolute top-8 -right-8 w-1.5 h-1.5 bg-purple-300 rounded-full animate-bounce"></div>
                    </div>
                </div>
            </div>

            <!-- Text Content -->
            <div class="text-white space-y-6 mb-10">
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold leading-tight">
                    Oops! Business 
                    <span class="bg-gradient-to-r from-yellow-400 to-orange-500 bg-clip-text text-transparent">
                        Not Found
                    </span>
                </h1>
                
                <p class="text-lg md:text-xl text-white/80 max-w-2xl mx-auto leading-relaxed">
                    The business you're looking for seems to have moved locations or doesn't exist in our directory. 
                    Let's help you find what you need!
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-6 mb-12">
                <a href="{{ url('/') }}" 
                   class="group bg-white text-purple-600 px-8 py-4 rounded-2xl font-semibold text-lg shadow-2xl hover:shadow-3xl transform hover:-translate-y-1 transition-all duration-300 flex items-center space-x-3">
                    <svg class="w-5 h-5 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span>Back to Home</span>
                </a>
                
                <a href="{{ route('company') }}" 
                   class="group bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white px-8 py-4 rounded-2xl font-semibold text-lg shadow-2xl hover:shadow-3xl transform hover:-translate-y-1 transition-all duration-300 flex items-center space-x-3">
                    <svg class="w-5 h-5 group-hover:animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <span>Browse Businesses</span>
                </a>
            </div>

            <!-- Quick Links -->
            <div class="bg-white/10 backdrop-blur-lg rounded-3xl p-6 md:p-8 border border-white/20">
                <h3 class="text-white text-xl font-semibold mb-6">Popular Destinations</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <a href="{{ route('company') }}" class="group bg-white/10 hover:bg-white/20 rounded-xl p-4 transition-all duration-300 transform hover:scale-105">
                        <div class="text-center">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl mx-auto mb-3 flex items-center justify-center group-hover:animate-bounce">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                            <span class="text-white text-sm font-medium">Companies</span>
                        </div>
                    </a>
                    
                    <a href="{{ route('products') }}" class="group bg-white/10 hover:bg-white/20 rounded-xl p-4 transition-all duration-300 transform hover:scale-105">
                        <div class="text-center">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-green-600 rounded-xl mx-auto mb-3 flex items-center justify-center group-hover:animate-bounce">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                            </div>
                            <span class="text-white text-sm font-medium">Products</span>
                        </div>
                    </a>
                    
                    <a href="{{ route('events') }}" class="group bg-white/10 hover:bg-white/20 rounded-xl p-4 transition-all duration-300 transform hover:scale-105">
                        <div class="text-center">
                            <div class="w-12 h-12 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-xl mx-auto mb-3 flex items-center justify-center group-hover:animate-bounce">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <span class="text-white text-sm font-medium">Events</span>
                        </div>
                    </a>
                    
                    <a href="{{ route('jobs') }}" class="group bg-white/10 hover:bg-white/20 rounded-xl p-4 transition-all duration-300 transform hover:scale-105">
                        <div class="text-center">
                            <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-purple-600 rounded-xl mx-auto mb-3 flex items-center justify-center group-hover:animate-bounce">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0H8m8 0v2a2 2 0 01-2 2H10a2 2 0 01-2-2V6m8 0H8"/>
                                </svg>
                            </div>
                            <span class="text-white text-sm font-medium">Jobs</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- CSS Animations -->
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
    </style>
</body>
</html>