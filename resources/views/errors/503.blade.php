<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <title>Under Maintenance - {{ config('app.name') }}</title>
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
                        'spin-slow': 'spin 4s linear infinite',
                        'spin-reverse': 'spin-reverse 3s linear infinite',
                        'gear-rotate': 'gear-rotate 6s linear infinite',
                        'maintenance': 'maintenance 2s ease-in-out infinite',
                        'wrench': 'wrench 3s ease-in-out infinite',
                        'progress': 'progress 3s ease-in-out infinite',
                    },
                },
            },
        };
    </script>
</head>

<body class="h-full bg-gradient-to-br from-orange-600 via-amber-600 to-yellow-700 font-sans antialiased">
    <!-- Background Animation -->
    <div class="absolute inset-0">
        <div class="absolute top-20 left-20 w-80 h-80 bg-white/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-20 right-20 w-96 h-96 bg-orange-300/20 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute top-1/3 right-1/3 w-32 h-32 bg-yellow-300/30 rounded-full blur-xl animate-bounce"></div>
        <div class="absolute bottom-1/4 left-1/4 w-24 h-24 bg-amber-300/25 rounded-full blur-2xl animate-gear-rotate"></div>
    </div>

    <!-- Main Content -->
    <div class="relative min-h-screen flex items-center justify-center px-4">
        <div class="text-center max-w-4xl mx-auto">
            
            <!-- 503 Maintenance Animation -->
            <div class="mb-8 relative">
                <div class="text-8xl md:text-[10rem] lg:text-[12rem] font-bold text-white/20 select-none">
                    503
                </div>
                
                <!-- Tools and Maintenance Icons -->
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="relative">
                        <!-- Main Tool Box -->
                        <div class="w-24 h-24 md:w-32 md:h-32 bg-gradient-to-br from-orange-500 to-amber-600 rounded-2xl shadow-2xl border-4 border-white/20 animate-maintenance relative">
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-12 h-12 md:w-16 md:h-16 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 15.5A3.5 3.5 0 018.5 12A3.5 3.5 0 0112 8.5a3.5 3.5 0 013.5 3.5 3.5 3.5 0 01-3.5 3.5m7.43-2.53c.04-.32.07-.64.07-.97 0-.33-.03-.66-.07-1l2.11-1.63c.19-.15.24-.42.12-.64l-2-3.46c-.12-.22-.39-.31-.61-.22l-2.49 1c-.52-.39-1.06-.73-1.69-.98l-.37-2.65A.506.506 0 0014 2h-4c-.25 0-.46.18-.5.42l-.37 2.65c-.63.25-1.17.59-1.69.98l-2.49-1c-.22-.09-.49 0-.61.22l-2 3.46c-.13.22-.07.49.12.64L4.57 11c-.04.34-.07.67-.07 1 0 .33.03.65.07.97l-2.11 1.66c-.19.15-.25.42-.12.64l2 3.46c.12.22.39.3.61.22l2.49-1.01c.52.4 1.06.74 1.69.99l.37 2.65c.04.24.25.42.5.42h4c.25 0 .46-.18.5-.42l.37-2.65c.63-.26 1.17-.59 1.69-.99l2.49 1.01c.22.08.49 0 .61-.22l2-3.46c.12-.22.07-.49-.12-.64l-2.11-1.66Z"/>
                                </svg>
                            </div>
                            
                            <!-- Tool Box Handle -->
                            <div class="absolute -top-2 left-1/2 transform -translate-x-1/2 w-8 h-2 bg-white/30 rounded-full"></div>
                        </div>
                        
                        <!-- Floating Tools -->
                        <div class="absolute -top-8 -left-8 w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center animate-wrench">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.7 19l-9.1-9.1c.9-2.3.4-5-1.5-6.9-2-2-5-2.4-7.4-1.3L9 6 6 9 1.6 4.7C.4 7.1.9 10.1 2.9 12.1c1.9 1.9 4.6 2.4 6.9 1.5l9.1 9.1c.4.4 1 .4 1.4 0l2.3-2.3c.5-.4.5-1.1.1-1.4z"/>
                            </svg>
                        </div>
                        
                        <div class="absolute -bottom-6 -right-10 w-10 h-10 bg-white/20 rounded-full flex items-center justify-center animate-spin-slow">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 15.5A3.5 3.5 0 018.5 12A3.5 3.5 0 0112 8.5a3.5 3.5 0 013.5 3.5 3.5 3.5 0 01-3.5 3.5m7.43-2.53c.04-.32.07-.64.07-.97 0-.33-.03-.66-.07-1l2.11-1.63c.19-.15.24-.42.12-.64l-2-3.46c-.12-.22-.39-.31-.61-.22l-2.49 1c-.52-.39-1.06-.73-1.69-.98l-.37-2.65A.506.506 0 0014 2h-4c-.25 0-.46.18-.5.42l-.37 2.65c-.63.25-1.17.59-1.69.98l-2.49-1c-.22-.09-.49 0-.61.22l-2 3.46c-.13.22-.07.49.12.64L4.57 11c-.04.34-.07.67-.07 1 0 .33.03.65.07.97l-2.11 1.66c-.19.15-.25.42-.12.64l2 3.46c.12.22.39.3.61.22l2.49-1.01c.52.4 1.06.74 1.69.99l.37 2.65c.04.24.25.42.5.42h4c.25 0 .46-.18.5-.42l.37-2.65c.63-.26 1.17-.59 1.69-.99l2.49 1.01c.22.08.49 0 .61-.22l2-3.46c.12-.22.07-.49-.12-.64l-2.11-1.66Z"/>
                            </svg>
                        </div>
                        
                        <div class="absolute top-10 -right-6 w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center animate-spin-reverse">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        
                        <!-- Maintenance Particles -->
                        <div class="absolute -top-4 -right-4 w-2 h-2 bg-yellow-300 rounded-full animate-ping"></div>
                        <div class="absolute -bottom-2 -left-6 w-3 h-3 bg-orange-300 rounded-full animate-pulse"></div>
                        <div class="absolute top-6 -left-8 w-1.5 h-1.5 bg-amber-300 rounded-full animate-bounce"></div>
                    </div>
                </div>
            </div>

            <!-- Text Content -->
            <div class="text-white space-y-6 mb-10">
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold leading-tight">
                    Under 
                    <span class="bg-gradient-to-r from-yellow-400 to-orange-500 bg-clip-text text-transparent">
                        Maintenance
                    </span>
                </h1>
                
                <p class="text-lg md:text-xl text-white/80 max-w-2xl mx-auto leading-relaxed">
                    We're currently performing scheduled maintenance to improve your business directory experience. 
                    We'll be back online shortly with exciting new features!
                </p>
            </div>

            <!-- Progress Bar -->
            <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-6 mb-10 max-w-3xl mx-auto border border-white/20">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-white font-semibold text-lg">Maintenance Progress</h3>
                    <span class="text-orange-300 text-sm font-medium" id="progress-text">Updating systems...</span>
                </div>
                
                <div class="w-full bg-white/20 rounded-full h-3 overflow-hidden">
                    <div class="bg-gradient-to-r from-yellow-400 to-orange-500 h-full rounded-full animate-progress" style="width: 75%"></div>
                </div>
                
                <div class="flex justify-between mt-4 text-sm text-white/70">
                    <span>Started: {{ now()->subHours(2)->format('H:i') }}</span>
                    <span>75% Complete</span>
                    <span>ETA: {{ now()->addMinutes(30)->format('H:i') }}</span>
                </div>
            </div>

            <!-- Maintenance Tasks -->
            <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-6 mb-10 max-w-3xl mx-auto border border-white/20">
                <h3 class="text-white font-semibold text-lg mb-6">What We're Working On</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex items-center space-x-3 bg-white/10 rounded-xl p-4">
                        <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                            </svg>
                        </div>
                        <div class="text-left">
                            <p class="text-white text-sm font-medium">Database Optimization</p>
                            <p class="text-green-400 text-xs">Completed</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-3 bg-white/10 rounded-xl p-4">
                        <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                            </svg>
                        </div>
                        <div class="text-left">
                            <p class="text-white text-sm font-medium">Security Updates</p>
                            <p class="text-green-400 text-xs">Completed</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-3 bg-white/10 rounded-xl p-4">
                        <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center animate-spin">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 4V2A10 10 0 0 0 2 12h2a8 8 0 0 1 8-8Z"/>
                            </svg>
                        </div>
                        <div class="text-left">
                            <p class="text-white text-sm font-medium">Feature Deployment</p>
                            <p class="text-orange-400 text-xs">In Progress</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-3 bg-white/10 rounded-xl p-4">
                        <div class="w-8 h-8 bg-gray-500 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                            </svg>
                        </div>
                        <div class="text-left">
                            <p class="text-white text-sm font-medium">System Testing</p>
                            <p class="text-gray-400 text-xs">Pending</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Countdown Timer -->
            <div class="bg-gradient-to-r from-orange-500/20 to-amber-500/20 backdrop-blur-lg rounded-2xl p-6 mb-10 max-w-lg mx-auto border border-orange-400/30">
                <h3 class="text-white font-semibold text-lg mb-4">Estimated Return Time</h3>
                <div class="grid grid-cols-4 gap-4">
                    <div class="text-center">
                        <div class="bg-white/20 rounded-xl p-3 mb-2">
                            <span class="text-2xl md:text-3xl font-bold text-white" id="hours">00</span>
                        </div>
                        <span class="text-xs text-white/70">Hours</span>
                    </div>
                    <div class="text-center">
                        <div class="bg-white/20 rounded-xl p-3 mb-2">
                            <span class="text-2xl md:text-3xl font-bold text-white" id="minutes">30</span>
                        </div>
                        <span class="text-xs text-white/70">Minutes</span>
                    </div>
                    <div class="text-center">
                        <div class="bg-white/20 rounded-xl p-3 mb-2">
                            <span class="text-2xl md:text-3xl font-bold text-white" id="seconds">00</span>
                        </div>
                        <span class="text-xs text-white/70">Seconds</span>
                    </div>
                    <div class="text-center">
                        <div class="bg-white/20 rounded-xl p-3 mb-2">
                            <span class="text-2xl md:text-3xl font-bold text-white" id="milliseconds">00</span>
                        </div>
                        <span class="text-xs text-white/70">MS</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-6 mb-12">
                <button onclick="location.reload()" 
                        class="group bg-white text-orange-600 px-8 py-4 rounded-2xl font-semibold text-lg shadow-2xl hover:shadow-3xl transform hover:-translate-y-1 transition-all duration-300 flex items-center space-x-3">
                    <svg class="w-5 h-5 group-hover:animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    <span>Refresh Status</span>
                </button>
                
                <a href="mailto:support@{{ config('app.domain', 'example.com') }}" 
                   class="group bg-gradient-to-r from-orange-500 to-amber-600 hover:from-orange-600 hover:to-amber-700 text-white px-8 py-4 rounded-2xl font-semibold text-lg shadow-2xl hover:shadow-3xl transform hover:-translate-y-1 transition-all duration-300 flex items-center space-x-3">
                    <svg class="w-5 h-5 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <span>Contact Support</span>
                </a>
            </div>

            <!-- Social Updates -->
            <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-6 border border-white/10">
                <h3 class="text-white font-semibold text-lg mb-4">Stay Updated</h3>
                <p class="text-white/70 text-sm mb-4">Follow us for real-time maintenance updates and new feature announcements:</p>
                <div class="flex justify-center space-x-4">
                    <a href="#" class="w-12 h-12 bg-blue-500/20 hover:bg-blue-500/30 rounded-xl flex items-center justify-center transition-colors duration-300">
                        <svg class="w-5 h-5 text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                        </svg>
                    </a>
                    <a href="#" class="w-12 h-12 bg-blue-600/20 hover:bg-blue-600/30 rounded-xl flex items-center justify-center transition-colors duration-300">
                        <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                        </svg>
                    </a>
                    <a href="#" class="w-12 h-12 bg-purple-500/20 hover:bg-purple-500/30 rounded-xl flex items-center justify-center transition-colors duration-300">
                        <svg class="w-5 h-5 text-purple-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.162-1.499-.69-2.436-2.878-2.436-4.632 0-3.78 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.758-1.378l-.749 2.848c-.269 1.045-1.004 2.352-1.498 3.146 1.123.345 2.306.535 3.55.535 6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001 12.017.001z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- CSS Animations -->
    <style>
        @keyframes spin-reverse {
            from { transform: rotate(360deg); }
            to { transform: rotate(0deg); }
        }
        
        @keyframes gear-rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        @keyframes maintenance {
            0%, 100% { transform: translateY(0px) scale(1); }
            50% { transform: translateY(-10px) scale(1.05); }
        }
        
        @keyframes wrench {
            0%, 100% { transform: rotate(0deg) translateY(0px); }
            25% { transform: rotate(-15deg) translateY(-5px); }
            75% { transform: rotate(15deg) translateY(-3px); }
        }
        
        @keyframes progress {
            0% { width: 0%; }
            100% { width: 75%; }
        }
    </style>

    <!-- JavaScript for Countdown Timer -->
    <script>
        // Set maintenance end time (30 minutes from now)
        const maintenanceEnd = new Date().getTime() + (30 * 60 * 1000);
        
        // Progress messages
        const progressMessages = [
            "Updating systems...",
            "Installing new features...",
            "Optimizing performance...",
            "Running security checks...",
            "Almost ready...",
            "Final preparations..."
        ];
        
        let messageIndex = 0;
        
        // Update countdown every second
        const countdownTimer = setInterval(function() {
            const now = new Date().getTime();
            const distance = maintenanceEnd - now;
            
            // If maintenance is over, redirect to home
            if (distance < 0) {
                clearInterval(countdownTimer);
                document.getElementById("progress-text").innerHTML = "Maintenance complete! Redirecting...";
                setTimeout(() => {
                    window.location.href = "/";
                }, 3000);
                return;
            }
            
            // Calculate time units
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
            const milliseconds = Math.floor((distance % 1000) / 10);
            
            // Display the result
            document.getElementById("hours").innerHTML = hours.toString().padStart(2, '0');
            document.getElementById("minutes").innerHTML = minutes.toString().padStart(2, '0');
            document.getElementById("seconds").innerHTML = seconds.toString().padStart(2, '0');
            document.getElementById("milliseconds").innerHTML = milliseconds.toString().padStart(2, '0');
        }, 50); // Update every 50ms for smooth milliseconds
        
        // Update progress message every 10 seconds
        setInterval(function() {
            messageIndex = (messageIndex + 1) % progressMessages.length;
            document.getElementById("progress-text").innerHTML = progressMessages[messageIndex];
        }, 10000);
        
        // Auto refresh every 2 minutes to check if maintenance is over
        setInterval(function() {
            // Only refresh if we're still in maintenance mode
            if (new Date().getTime() < maintenanceEnd) {
                fetch(window.location.href, { method: 'HEAD' })
                    .then(response => {
                        if (response.status !== 503) {
                            window.location.reload();
                        }
                    })
                    .catch(() => {
                        // If fetch fails, maintenance is likely still ongoing
                    });
            }
        }, 120000); // Check every 2 minutes
        
        // Add some visual feedback for user interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Add ripple effect to buttons
            const buttons = document.querySelectorAll('button, a');
            buttons.forEach(button => {
                button.addEventListener('click', function(e) {
                    const ripple = document.createElement('div');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.cssText = `
                        position: absolute;
                        width: ${size}px;
                        height: ${size}px;
                        background: rgba(255, 255, 255, 0.3);
                        border-radius: 50%;
                        transform: scale(0);
                        animation: ripple 0.6s linear;
                        left: ${x}px;
                        top: ${y}px;
                        pointer-events: none;
                    `;
                    
                    this.style.position = 'relative';
                    this.style.overflow = 'hidden';
                    this.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });
        });
    </script>

    <!-- Additional CSS for ripple effect -->
    <style>
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    </style>
</body>
</html>