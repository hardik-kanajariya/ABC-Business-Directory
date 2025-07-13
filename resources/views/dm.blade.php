@php use App\Models\Category; @endphp
@extends('layouts.user')

@section('head')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Special+Elite&display=swap" rel="stylesheet">
    <style>
        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.02); }
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .animate-slideInLeft {
            animation: slideInLeft 0.5s ease-out forwards;
        }

        .float-animation {
            animation: float 3s ease-in-out infinite;
        }

        /* Custom styles */
        .hero-gradient {
            background: linear-gradient(135deg, #8b5cf6 0%, #3b82f6 100%);
        }

        .message-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .form-container {
            background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
        }

        .input-field {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid #e2e8f0;
        }

        .input-field:focus {
            border-color: #8b5cf6;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
            transform: translateY(-2px);
        }

        .input-field:hover {
            border-color: #cbd5e0;
        }

        .submit-button {
            background: linear-gradient(135deg, #8b5cf6 0%, #3b82f6 100%);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .submit-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 40px rgba(139, 92, 246, 0.3);
        }

        .submit-button:active {
            transform: translateY(0);
        }

        /* CAPTCHA Styles */
        .special-elite-regular {
            font-family: "Special Elite", system-ui;
            font-weight: 400;
            font-style: normal;
        }

        .captcha {
            font-family: "Special Elite", system-ui;
            font-weight: 400;
            font-style: normal;
            font-size: 1.5rem;
            color: #8b5cf6;
            background: linear-gradient(145deg, #f0f0f0, #e0e0e0);
            padding: 12px 16px;
            border-radius: 12px;
            position: relative;
            overflow: hidden;
            box-shadow: inset 2px 2px 5px rgba(0,0,0,0.1);
        }

        .captcha::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: repeating-linear-gradient(
                90deg,
                transparent,
                transparent 10px,
                rgba(139, 92, 246, 0.1) 10px,
                rgba(139, 92, 246, 0.1) 20px
            );
            z-index: 1;
        }

        .captcha span {
            position: relative;
            display: inline-block;
            transform: skew(-8deg);
            margin: 0 3px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
            z-index: 2;
        }

        .captcha-refresh {
            transition: all 0.3s ease;
        }

        .captcha-refresh:hover {
            color: #7c3aed;
            transform: scale(1.05);
        }

        /* Card hover effect */
        .info-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .info-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }

        /* Message typing animation */
        .typing-indicator {
            display: inline-block;
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background-color: #8b5cf6;
            animation: typing 1.4s infinite ease-in-out;
            margin-right: 2px;
        }

        .typing-indicator:nth-child(2) { animation-delay: 0.2s; }
        .typing-indicator:nth-child(3) { animation-delay: 0.4s; }

        @keyframes typing {
            0%, 60%, 100% {
                transform: translateY(0);
                opacity: 0.4;
            }
            30% {
                transform: translateY(-10px);
                opacity: 1;
            }
        }

        /* Progress steps */
        .progress-step {
            transition: all 0.3s ease;
        }

        .progress-step.active {
            color: #8b5cf6;
            transform: scale(1.1);
        }

        .progress-line {
            height: 2px;
            background: linear-gradient(to right, #8b5cf6 50%, #e2e8f0 50%);
        }
    </style>
@endsection

@section('content')
    <x-user.bread-crumb :data="['Home', 'Direct Message to company']"/>
    
    <!-- Hero Section -->
    <div class="relative overflow-hidden hero-gradient">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        
        <!-- Floating background elements -->
        <div class="absolute top-10 left-10 w-20 h-20 bg-white opacity-10 rounded-full float-animation"></div>
        <div class="absolute top-20 right-20 w-16 h-16 bg-white opacity-10 rounded-full float-animation" style="animation-delay: 1s;"></div>
        <div class="absolute bottom-20 left-1/3 w-12 h-12 bg-white opacity-10 rounded-full float-animation" style="animation-delay: 2s;"></div>
        
        <div class="relative flex flex-col justify-center items-center h-80 px-4">
            <div class="text-center animate-fadeInUp">
                <div class="flex items-center justify-center mb-6">
                    <div class="bg-white p-4 rounded-full shadow-lg">
                        <svg class="w-12 h-12 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                    </div>
                </div>
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-4 drop-shadow-lg">
                    Connect with <span class="text-yellow-300">{{ $company->name }}</span>
                </h1>
                <p class="text-xl md:text-2xl text-white opacity-90 max-w-2xl mx-auto mb-6">
                    Send a direct message to get in touch with this business instantly
                </p>
                <div class="flex items-center justify-center space-x-6 text-white opacity-80">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Instant delivery</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                        </svg>
                        <span>Secure messaging</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Navigation back to company -->
        <div class="absolute top-4 right-4 animate-slideInLeft">
            <a href="{{ route('view.company', $company->slug) }}" 
               class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg text-white px-6 py-3 rounded-full hover:bg-opacity-30 transition-all duration-300 flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                <span>Back to Company</span>
            </a>
        </div>
        
        <!-- Decorative wave -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1200 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1200 120L0 120L0 0C0 0 218.5 42 600 42C981.5 42 1200 0 1200 0L1200 120Z" fill="white"/>
            </svg>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto py-16 px-4">
        <div class="max-w-5xl mx-auto">
            <!-- Info Cards -->
            <div class="grid md:grid-cols-4 gap-6 mb-12">
                <div class="info-card bg-white p-6 rounded-2xl shadow-lg text-center animate-fadeInUp">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg text-gray-800 mb-2">Quick Response</h3>
                    <p class="text-gray-600 text-sm">Get replies within 24 hours</p>
                </div>
                
                <div class="info-card bg-white p-6 rounded-2xl shadow-lg text-center animate-fadeInUp" style="animation-delay: 0.1s;">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg text-gray-800 mb-2">Verified Business</h3>
                    <p class="text-gray-600 text-sm">Reach authenticated companies</p>
                </div>
                
                <div class="info-card bg-white p-6 rounded-2xl shadow-lg text-center animate-fadeInUp" style="animation-delay: 0.2s;">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg text-gray-800 mb-2">Easy Process</h3>
                    <p class="text-gray-600 text-sm">Simple form, instant delivery</p>
                </div>
                
                <div class="info-card bg-white p-6 rounded-2xl shadow-lg text-center animate-fadeInUp" style="animation-delay: 0.3s;">
                    <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg text-gray-800 mb-2">Secure & Private</h3>
                    <p class="text-gray-600 text-sm">Your data is protected</p>
                </div>
            </div>

            <!-- Progress Steps -->
            <div class="mb-12 animate-fadeInUp" style="animation-delay: 0.4s;">
                <div class="flex items-center justify-center space-x-8">
                    <div class="flex items-center space-x-2 progress-step active">
                        <div class="w-8 h-8 bg-purple-600 text-white rounded-full flex items-center justify-center text-sm font-bold">1</div>
                        <span class="font-medium">Fill Details</span>
                    </div>
                    <div class="progress-line w-20"></div>
                    <div class="flex items-center space-x-2 progress-step">
                        <div class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center text-sm font-bold">2</div>
                        <span class="text-gray-600">Verify & Send</span>
                    </div>
                    <div class="progress-line w-20 bg-gray-300"></div>
                    <div class="flex items-center space-x-2 progress-step">
                        <div class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center text-sm font-bold">3</div>
                        <span class="text-gray-600">Get Response</span>
                    </div>
                </div>
            </div>

            <!-- Message Form -->
            <div class="form-container rounded-3xl shadow-2xl p-8 md:p-12 animate-fadeInUp" style="animation-delay: 0.6s;">
                <!-- Company Info Header -->
                <div class="text-center mb-8 p-6 bg-gradient-to-r from-purple-50 to-blue-50 rounded-2xl">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">
                        Sending message to <span class="text-purple-600">{{ $company->name }}</span>
                    </h2>
                    <div class="flex items-center justify-center space-x-2 text-gray-600">
                        <div class="typing-indicator"></div>
                        <div class="typing-indicator"></div>
                        <div class="typing-indicator"></div>
                        <span class="ml-2">They'll receive your message instantly</span>
                    </div>
                </div>

                <form id="form" action="{{ route('direct-message') }}" method="POST">
                    @csrf

                    <div class="grid md:grid-cols-2 gap-6 mb-6">
                        <!-- Email Field -->
                        <div class="space-y-2">
                            <label class="block text-gray-700 text-sm font-bold" for="email">
                                Your Email Address
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                    </svg>
                                </div>
                                <input
                                    class="input-field w-full pl-10 pr-4 py-4 rounded-xl focus:outline-none @error('email') border-red-500 @enderror"
                                    id="email" type="email" placeholder="your@email.com" name="email" value="{{ old('email') }}" required>
                            </div>
                            @error('email')
                            <p class="text-red-500 text-xs italic flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- Phone Field -->
                        <div class="space-y-2">
                            <label class="block text-gray-700 text-sm font-bold" for="phone">
                                Phone Number
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                                <input
                                    class="input-field w-full pl-10 pr-4 py-4 rounded-xl focus:outline-none @error('phone') border-red-500 @enderror"
                                    id="phone" type="text" placeholder="+1 (555) 123-4567" name="phone" value="{{ old('phone') }}" required>
                            </div>
                            @error('phone')
                            <p class="text-red-500 text-xs italic flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6 mb-6">
                        <!-- Name Field -->
                        <div class="space-y-2">
                            <label class="block text-gray-700 text-sm font-bold" for="name">
                                Your Full Name
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <input
                                    class="input-field w-full pl-10 pr-4 py-4 rounded-xl focus:outline-none @error('name') border-red-500 @enderror"
                                    id="name" type="text" placeholder="Enter your full name" name="name" value="{{ old('name') }}" required>
                            </div>
                            @error('name')
                            <p class="text-red-500 text-xs italic flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- Company Name Field -->
                        <div class="space-y-2">
                            <label class="block text-gray-700 text-sm font-bold" for="company_name">
                                Your Company <span class="text-gray-400 font-normal">(Optional)</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                                <input
                                    class="input-field w-full pl-10 pr-4 py-4 rounded-xl focus:outline-none @error('company_name') border-red-500 @enderror"
                                    id="company_name" type="text" placeholder="Your company name" name="company_name"
                                    value="{{ old('company_name') }}" required>
                            </div>
                            @error('company_name')
                            <p class="text-red-500 text-xs italic flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Message Field -->
                    <div class="mb-6 space-y-2">
                        <label class="block text-gray-700 text-sm font-bold" for="message">
                            Your Message
                        </label>
                        <div class="relative">
                            <textarea rows="8"
                                      class="input-field w-full px-4 py-4 rounded-xl focus:outline-none resize-none @error('message') border-red-500 @enderror"
                                      id="message" placeholder="Hi there! I'm interested in learning more about your services. Could you please provide me with more information about..." 
                                      name="message" required>{{ old('message') }}</textarea>
                            <div class="absolute bottom-3 right-3 text-xs text-gray-400">
                                <span id="charCount">0</span>/500 characters
                            </div>
                        </div>
                        @error('message')
                        <p class="text-red-500 text-xs italic flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <!-- CAPTCHA Field -->
                    <div class="mb-8 space-y-2">
                        <label class="block text-gray-700 text-sm font-bold" for="captcha">
                            Security Verification
                        </label>
                        <div class="bg-gradient-to-r from-purple-50 to-blue-50 p-6 rounded-xl border-2 border-purple-100">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center space-x-3">
                                    <span class="text-sm font-medium text-gray-600">Please enter the code:</span>
                                    <div class="captcha">
                                        <span id="captcha-code"></span>
                                    </div>
                                </div>
                                <button type="button" onclick="generateCaptcha()" 
                                        class="captcha-refresh text-purple-600 hover:text-purple-800 flex items-center space-x-1 px-3 py-2 rounded-lg hover:bg-purple-100 transition-all duration-300">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                    </svg>
                                    <span class="text-sm">New Code</span>
                                </button>
                            </div>
                            <input
                                class="input-field w-full px-4 py-3 rounded-lg focus:outline-none"
                                type="text" id="captcha" name="captcha" placeholder="Enter the security code" required>
                        </div>
                    </div>

                    <input type="hidden" name="company_id" value="{{ $company->id }}">

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button onclick="validateCaptcha()"
                                class="submit-button text-white font-bold py-4 px-12 rounded-full focus:outline-none focus:ring-4 focus:ring-purple-300 w-full md:w-auto group"
                                type="button">
                            <span class="flex items-center justify-center space-x-2">
                                <span>Send Message</span>
                                <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                </svg>
                            </span>
                        </button>
                    </div>

                    <!-- Legal Notice -->
                    <div class="text-center mt-8 p-6 bg-gray-50 rounded-xl">
                        <p class="text-gray-600 text-sm leading-relaxed">
                            By submitting this message, you agree to our 
                            <a href="{{ route('policy') }}" class="text-purple-600 hover:text-purple-800 font-medium">Privacy Policy</a> 
                            and 
                            <a href="{{ route('tos') }}" class="text-purple-600 hover:text-purple-800 font-medium">Terms of Service</a>.
                            <br>
                            <span class="text-xs text-gray-500 mt-2 inline-block">
                                Your message will be delivered instantly. Responses typically arrive within 24 hours.
                            </span>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Benefits Section -->
    <section class="bg-gradient-to-r from-purple-600 to-blue-600 py-20">
        <div class="container mx-auto px-4 text-center">
            <div class="animate-fadeInUp">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
                    Why Use Our Direct Messaging?
                </h2>
                <div class="grid md:grid-cols-3 gap-8 mt-12">
                    <div class="bg-white bg-opacity-10 backdrop-filter backdrop-blur-lg p-6 rounded-2xl">
                        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Lightning Fast</h3>
                        <p class="text-white opacity-90">Messages are delivered instantly to business owners</p>
                    </div>
                    
                    <div class="bg-white bg-opacity-10 backdrop-filter backdrop-blur-lg p-6 rounded-2xl">
                        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">100% Secure</h3>
                        <p class="text-white opacity-90">Your personal information is always protected</p>
                    </div>
                    
                    <div class="bg-white bg-opacity-10 backdrop-filter backdrop-blur-lg p-6 rounded-2xl">
                        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Direct Contact</h3>
                        <p class="text-white opacity-90">Connect directly with verified business owners</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('page-scripts')
    <script>
        // Prevent right-click, copy, and select for security
        document.addEventListener('contextmenu', event => event.preventDefault());
        document.addEventListener('copy', event => event.preventDefault());
        document.addEventListener('selectstart', event => event.preventDefault());

        // Character counter for message field
        document.getElementById('message').addEventListener('input', function() {
            const charCount = this.value.length;
            document.getElementById('charCount').textContent = charCount;
            
            // Change color based on character count
            const counter = document.getElementById('charCount');
            if (charCount > 450) {
                counter.style.color = '#ef4444';
            } else if (charCount > 400) {
                counter.style.color = '#f59e0b';
            } else {
                counter.style.color = '#6b7280';
            }
        });

        // Enhanced CAPTCHA functionality
        function generateCaptcha() {
            const code = generateRandomCode(6);
            document.getElementById('captcha-code').innerText = code;
            
            // Add visual feedback
            const captchaElement = document.querySelector('.captcha');
            captchaElement.style.transform = 'scale(1.05)';
            setTimeout(() => {
                captchaElement.style.transform = 'scale(1)';
            }, 200);
            
            // Auto-fill in local environment
            if ({{ config('app.env') === 'local' ? 'true' : 'false' }}) {
                document.getElementById('captcha').value = code;
            }
            
            return code;
        }

        function generateRandomCode(length) {
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let result = '';
            for (let i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            return result;
        }

        // Generate CAPTCHA on page load
        window.onload = generateCaptcha;

        // Enhanced form validation with progress updates
        function validateCaptcha() {
            const captcha = document.getElementById('captcha').value;
            const code = document.getElementById('captcha-code').innerText;
            const submitButton = document.querySelector('.submit-button');
            
            if (captcha === code) {
                // Update progress steps
                updateProgressStep(2);
                
                // Show loading state
                submitButton.innerHTML = `
                    <span class="flex items-center justify-center space-x-2">
                        <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="m4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span>Sending Message...</span>
                    </span>
                `;
                submitButton.disabled = true;
                
                // Simulate sending process
                setTimeout(() => {
                    updateProgressStep(3);
                    document.getElementById('form').submit();
                }, 1500);
            } else {
                // Show error with animation
                const captchaField = document.getElementById('captcha');
                captchaField.style.borderColor = '#ef4444';
                captchaField.style.animation = 'shake 0.5s';
                
                // Show toast notification
                showToast('Security code doesn\'t match. Please try again.', 'error');
                
                generateCaptcha();
                captchaField.value = '';
                
                // Reset border color
                setTimeout(() => {
                    captchaField.style.borderColor = '#e2e8f0';
                    captchaField.style.animation = '';
                }, 1000);
            }
        }

        // Update progress steps
        function updateProgressStep(step) {
            const steps = document.querySelectorAll('.progress-step');
            const lines = document.querySelectorAll('.progress-line');
            
            steps.forEach((stepEl, index) => {
                if (index < step) {
                    stepEl.classList.add('active');
                    stepEl.querySelector('div').className = 'w-8 h-8 bg-purple-600 text-white rounded-full flex items-center justify-center text-sm font-bold';
                }
            });
            
            lines.forEach((line, index) => {
                if (index < step - 1) {
                    line.style.background = 'linear-gradient(to right, #8b5cf6 100%, #e2e8f0 100%)';
                }
            });
        }

        // Toast notification function
        function showToast(message, type = 'info') {
            const toast = document.createElement('div');
            toast.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg transform transition-all duration-300 translate-x-full ${
                type === 'error' ? 'bg-red-500 text-white' : 'bg-purple-500 text-white'
            }`;
            toast.innerHTML = `
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <span>${message}</span>
                </div>
            `;
            
            document.body.appendChild(toast);
            
            // Animate in
            setTimeout(() => {
                toast.style.transform = 'translateX(0)';
            }, 100);
            
            // Animate out and remove
            setTimeout(() => {
                toast.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    if (document.body.contains(toast)) {
                        document.body.removeChild(toast);
                    }
                }, 300);
            }, 4000);
        }

        // Auto-refresh CAPTCHA every 5 minutes
        setInterval(generateCaptcha, 300000);

        // Add shake animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                25% { transform: translateX(-5px); }
                75% { transform: translateX(5px); }
            }
        `;
        document.head.appendChild(style);

        // Enhanced form interaction and validation
        document.addEventListener('DOMContentLoaded', function() {
            // Add focus effects to form fields
            const inputs = document.querySelectorAll('.input-field');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'translateY(-2px)';
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'translateY(0)';
                });
            });

            // Real-time form validation
            const form = document.getElementById('form');
            const requiredFields = form.querySelectorAll('[required]');
            
            function checkFormCompletion() {
                let allFilled = true;
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        allFilled = false;
                    }
                });
                
                // Update submit button state
                const submitBtn = document.querySelector('.submit-button');
                if (allFilled) {
                    submitBtn.style.opacity = '1';
                    submitBtn.style.cursor = 'pointer';
                } else {
                    submitBtn.style.opacity = '0.7';
                    submitBtn.style.cursor = 'not-allowed';
                }
            }
            
            requiredFields.forEach(field => {
                field.addEventListener('input', checkFormCompletion);
                field.addEventListener('blur', checkFormCompletion);
            });
            
            // Initial check
            checkFormCompletion();
        });

        // Auto-resize textarea
        const textarea = document.getElementById('message');
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 200) + 'px';
        });
    </script>
@endsection