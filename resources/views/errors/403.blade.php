<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <title>Access Forbidden - {{ config('app.name') }}</title>
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
                        'shake': 'shake 0.5s ease-in-out infinite',
                        'glow': 'glow 2s ease-in-out infinite alternate',
                    },
                },
            },
        };
    </script>
</head>

<body class="h-full bg-gradient-to-br from-red-600 via-orange-600 to-pink-700 font-sans antialiased overflow-hidden">
    <!-- Background Animation -->
    <div class="absolute inset-0">
        <div class="absolute top-20 left-20 w-64 h-64 bg-white/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-20 right-20 w-80 h-80 bg-red-300/20 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute top-1/3 right-1/4 w-32 h-32 bg-orange-300/30 rounded-full blur-xl animate-bounce"></div>
    </div>

    <!-- Main Content -->
    <div class="relative min-h-screen flex items-center justify-center px-4">
        <div class="text-center max-w-4xl mx-auto">
            
            <!-- 403 Lock Animation -->
            <div class="mb-8 relative">
                <div class="text-8xl md:text-[10rem] lg:text-[12rem] font-bold text-white/20 select-none">
                    403
                </div>
                
                <!-- Lock Icon -->
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="relative animate-shake">
                        <div class="w-20 h-20 md:w-28 md:h-28 bg-white/20 backdrop-blur-sm rounded-2xl border-4 border-white flex items-center justify-center">
                            <svg class="w-12 h-12 md:w-16 md:h-16 text-white animate-glow" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zM11 7h2v2h-2V7zm0 4h2v6h-2v-6z"/>
                            </svg>
                        </div>
                        
                        <!-- Warning indicators -->
                        <div class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 rounded-full flex items-center justify-center animate-pulse">
                            <span class="text-white text-xs font-bold">!</span>
                        </div>
                        
                        <!-- Access Denied Particles -->
                        <div class="absolute -top-6 -left-4 w-2 h-2 bg-red-300 rounded-full animate-ping"></div>
                        <div class="absolute -bottom-4 -right-6 w-3 h-3 bg-orange-300 rounded-full animate-pulse"></div>
                        <div class="absolute top-6 -right-10 w-1.5 h-1.5 bg-pink-300 rounded-full animate-bounce"></div>
                    </div>
                </div>
            </div>

            <!-- Text Content -->
            <div class="text-white space-y-6 mb-10">
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold leading-tight">
                    Access 
                    <span class="bg-gradient-to-r from-red-400 to-orange-500 bg-clip-text text-transparent">
                        Forbidden
                    </span>
                </h1>
                
                <p class="text-lg md:text-xl text-white/80 max-w-2xl mx-auto leading-relaxed">
                    You don't have permission to access this business resource. This area is restricted to authorized users only.
                </p>
            </div>

            <!-- Security Notice -->
            <div class="bg-red-500/20 backdrop-blur-lg border border-red-400/30 rounded-2xl p-6 mb-10 max-w-2xl mx-auto">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                    </div>
                    <h3 class="text-white font-semibold text-lg">Security Notice</h3>
                </div>
                <p class="text-white/90 text-sm leading-relaxed">
                    This incident has been logged for security purposes. If you believe you should have access to this area, 
                    please contact your administrator or business owner.
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-6 mb-12">
                <a href="{{ url('/') }}" 
                   class="group bg-white text-red-600 px-8 py-4 rounded-2xl font-semibold text-lg shadow-2xl hover:shadow-3xl transform hover:-translate-y-1 transition-all duration-300 flex items-center space-x-3">
                    <svg class="w-5 h-5 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span>Go to Home</span>
                </a>
                
                <a href="{{ url('user/login') }}" 
                   class="group bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-8 py-4 rounded-2xl font-semibold text-lg shadow-2xl hover:shadow-3xl transform hover:-translate-y-1 transition-all duration-300 flex items-center space-x-3">
                    <svg class="w-5 h-5 group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    <span>Login Here</span>
                </a>
            </div>

            <!-- Help Section -->
            <div class="bg-white/10 backdrop-blur-lg rounded-3xl p-6 md:p-8 border border-white/20">
                <h3 class="text-white text-xl font-semibold mb-6">Need Help?</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl mx-auto mb-4 flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h4 class="text-white font-semibold mb-2">Contact Support</h4>
                        <p class="text-white/70 text-sm">Get help from our support team</p>
                    </div>
                    
                    <div class="text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-green-400 to-green-600 rounded-xl mx-auto mb-4 flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <h4 class="text-white font-semibold mb-2">Documentation</h4>
                        <p class="text-white/70 text-sm">Check our help documentation</p>
                    </div>
                    
                    <div class="text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-purple-400 to-purple-600 rounded-xl mx-auto mb-4 flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a2 2 0 01-2-2v-6a2 2 0 012-2h8z"/>
                            </svg>
                        </div>
                        <h4 class="text-white font-semibold mb-2">Community</h4>
                        <p class="text-white/70 text-sm">Join our community forum</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CSS Animations -->
    <style>
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-2px); }
            75% { transform: translateX(2px); }
        }
        
        @keyframes glow {
            from { filter: drop-shadow(0 0 10px rgba(255, 255, 255, 0.3)); }
            to { filter: drop-shadow(0 0 20px rgba(255, 255, 255, 0.8)); }
        }
    </style>
</body>
</html>