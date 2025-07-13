<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <title>Server Error - {{ config('app.name') }}</title>
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
                        'spin-slow': 'spin 3s linear infinite',
                        'pulse-fast': 'pulse 1s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'flicker': 'flicker 1.5s infinite',
                    },
                },
            },
        };
    </script>
</head>

<body class="h-full bg-gradient-to-br from-gray-800 via-red-900 to-gray-900 font-sans antialiased overflow-hidden">
    <!-- Background Animation -->
    <div class="absolute inset-0">
        <div class="absolute top-16 left-16 w-72 h-72 bg-red-500/20 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-16 right-16 w-96 h-96 bg-orange-500/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute top-1/2 left-1/3 w-40 h-40 bg-yellow-500/20 rounded-full blur-2xl animate-bounce"></div>
    </div>

    <!-- Main Content -->
    <div class="relative min-h-screen flex items-center justify-center px-4">
        <div class="text-center max-w-4xl mx-auto">
            
            <!-- 500 Server Animation -->
            <div class="mb-8 relative">
                <div class="text-8xl md:text-[10rem] lg:text-[12rem] font-bold text-white/20 select-none">
                    500
                </div>
                
                <!-- Server Icon with Glitch Effect -->
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="relative">
                        <div class="w-24 h-24 md:w-32 md:h-32 bg-gradient-to-br from-red-500 to-red-700 rounded-2xl shadow-2xl animate-pulse-fast border-4 border-white/20">
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-12 h-12 md:w-16 md:h-16 text-white animate-flicker" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"/>
                                    <circle cx="6" cy="7" r="1"/>
                                    <circle cx="6" cy="12" r="1"/>
                                    <circle cx="6" cy="17" r="1"/>
                                </svg>
                            </div>
                        </div>
                        
                        <!-- Error Indicators -->
                        <div class="absolute -top-3 -right-3 w-8 h-8 bg-red-500 rounded-full flex items-center justify-center animate-bounce border-2 border-white">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M13 13h-2V7h2m0 10h-2v-2h2M12 2A10 10 0 002 12a10 10 0 0010 10 10 10 0 0010-10A10 10 0 0012 2z"/>
                            </svg>
                        </div>
                        
                        <!-- System Error Particles -->
                        <div class="absolute -top-8 -left-6 w-3 h-3 bg-red-400 rounded-full animate-ping"></div>
                        <div class="absolute -bottom-6 -right-8 w-2 h-2 bg-orange-400 rounded-full animate-pulse"></div>
                        <div class="absolute top-8 -left-10 w-1.5 h-1.5 bg-yellow-400 rounded-full animate-bounce"></div>
                        
                        <!-- Spinning Gears -->
                        <div class="absolute -bottom-12 -left-8 w-6 h-6 border-2 border-white/50 rounded-full animate-spin-slow"></div>
                        <div class="absolute -top-10 -right-12 w-4 h-4 border border-white/30 rounded-full animate-spin"></div>
                    </div>
                </div>
            </div>

            <!-- Text Content -->
            <div class="text-white space-y-6 mb-10">
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold leading-tight">
                    Server 
                    <span class="bg-gradient-to-r from-red-400 to-orange-500 bg-clip-text text-transparent">
                        Overload
                    </span>
                </h1>
                
                <p class="text-lg md:text-xl text-white/80 max-w-2xl mx-auto leading-relaxed">
                    Our business directory servers are experiencing technical difficulties. 
                    Our team is working hard to restore service as quickly as possible.
                </p>
            </div>

            <!-- Status Information -->
            <div class="bg-gray-800/50 backdrop-blur-lg border border-gray-600/30 rounded-2xl p-6 mb-10 max-w-3xl mx-auto">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-white font-semibold text-lg">System Status</h3>
                    <div class="flex items-center space-x-2">
                        <div class="w-3 h-3 bg-red-500 rounded-full animate-pulse"></div>
                        <span class="text-red-400 text-sm font-medium">Under Maintenance</span>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-gray-700/50 rounded-xl p-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-red-500/20 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-red-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-white text-sm font-medium">Database</p>
                                <p class="text-red-400 text-xs">Offline</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-700/50 rounded-xl p-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-yellow-500/20 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-white text-sm font-medium">API</p>
                                <p class="text-yellow-400 text-xs">Degraded</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-700/50 rounded-xl p-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-green-500/20 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-green-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-white text-sm font-medium">CDN</p>
                                <p class="text-green-400 text-xs">Operational</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6 pt-6 border-t border-gray-600">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-400">Estimated Recovery Time:</span>
                        <span class="text-white font-medium">15-30 minutes</span>
                    </div>
                    <div class="flex items-center justify-between text-sm mt-2">
                        <span class="text-gray-400">Last Updated:</span>
                        <span class="text-white font-medium">{{ now()->format('M d, Y - H:i') }} UTC</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-6 mb-12">
                <button onclick="location.reload()" 
                        class="group bg-white text-gray-800 px-8 py-4 rounded-2xl font-semibold text-lg shadow-2xl hover:shadow-3xl transform hover:-translate-y-1 transition-all duration-300 flex items-center space-x-3">
                    <svg class="w-5 h-5 group-hover:animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    <span>Try Again</span>
                </button>
                
                <a href="{{ url('/') }}" 
                   class="group bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800 text-white px-8 py-4 rounded-2xl font-semibold text-lg shadow-2xl hover:shadow-3xl transform hover:-translate-y-1 transition-all duration-300 flex items-center space-x-3">
                    <svg class="w-5 h-5 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span>Return Home</span>
                </a>
            </div>

            <!-- Technical Details -->
            <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-6 border border-white/10">
                <details class="group">
                    <summary class="cursor-pointer text-white font-semibold flex items-center justify-between">
                        <span>Technical Details</span>
                        <svg class="w-5 h-5 transition-transform group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </summary>
                    <div class="mt-4 pt-4 border-t border-white/10 text-left space-y-2">
                        <p class="text-gray-300 text-sm"><strong>Error Code:</strong> HTTP 500</p>
                        <p class="text-gray-300 text-sm"><strong>Timestamp:</strong> {{ now()->format('Y-m-d H:i:s') }} UTC</p>
                        <p class="text-gray-300 text-sm"><strong>Server:</strong> {{ config('app.name') }} Production</p>
                        <p class="text-gray-300 text-sm"><strong>Reference ID:</strong> {{ Str::random(8) }}</p>
                    </div>
                </details>
            </div>
        </div>
    </div>

    <!-- CSS Animations -->
    <style>
        @keyframes flicker {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
    </style>

    <!-- Auto Refresh Script -->
    <script>
        // Auto-refresh page every 30 seconds
        setTimeout(() => {
            location.reload();
        }, 30000);
        
        // Countdown timer
        let countdown = 30;
        const updateCountdown = () => {
            countdown--;
            if (countdown <= 0) {
                location.reload();
            }
        };
        setInterval(updateCountdown, 1000);
    </script>
</body>
</html>