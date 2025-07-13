@extends('layouts.user')

@section('title', 'Post Your Business Requirements - ' . config('app.name'))
@section('description', 'Share your business requirements and let us connect you with the right suppliers, service providers, and business partners worldwide.')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 via-blue-50 to-indigo-50">
    <!-- Hero Section -->
    <section class="relative py-16 md:py-24 bg-gradient-to-r from-purple-600 to-blue-600 overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-full h-full bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>
        </div>

        <div class="relative container mx-auto px-4 sm:px-6 lg:px-8 text-center text-white bg-transparent">
            <!-- Icon -->
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white/20 backdrop-blur-lg rounded-2xl border border-white/30 mb-8">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>

            <!-- Headlines -->
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-black mb-6 leading-tight">
                Post Your Business 
                <span class="bg-gradient-to-r from-yellow-300 to-orange-400 bg-clip-text text-transparent">
                    Requirements
                </span>
            </h1>
            
            <p class="text-xl md:text-2xl text-white/90 max-w-4xl mx-auto leading-relaxed mb-8">
                Navigating the vast landscape of business opportunities can be challenging. Whether you're seeking 
                suppliers, service providers, or business insights, we're here to guide you.
            </p>

            <!-- Features -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto mt-12">
                <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-6 border border-white/20">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-emerald-500 rounded-xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2">Fast Response</h3>
                    <p class="text-white/80 text-sm">Get connected within 24 hours</p>
                </div>
                
                <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-6 border border-white/20">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-blue-500 rounded-xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2">Verified Partners</h3>
                    <p class="text-white/80 text-sm">Connect with trusted businesses</p>
                </div>
                
                <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-6 border border-white/20">
                    <div class="w-12 h-12 bg-gradient-to-br from-orange-400 to-red-500 rounded-xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2">Global Reach</h3>
                    <p class="text-white/80 text-sm">Worldwide business network</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Form Section -->
    <section class="py-16 md:py-24">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl">
            
            <!-- Form Container -->
            <div class="bg-white rounded-3xl shadow-2xl border border-gray-200/50 overflow-hidden">
                
                <!-- Form Header -->
                <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-8 py-8 border-b border-gray-200/50">
                    <div class="text-center">
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-3">
                            Share Your Requirements
                        </h2>
                        <p class="text-gray-600 text-lg mb-4">
                            Fill out the form below and we'll connect you with the right business partners
                        </p>
                        <div class="inline-flex items-center bg-red-50 text-red-700 px-4 py-2 rounded-full text-sm font-medium">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                            Fields marked with * are mandatory
                        </div>
                    </div>
                </div>

                <!-- Form Body -->
                <div class="px-8 py-12">
                    <form action="{{ route('requirements.submit') }}" method="post" enctype="multipart/form-data" class="requirement-form space-y-8" id="requirements-form">
                        @csrf
                        
                        <!-- Personal Information Section -->
                        <div class="space-y-6">
                            <div class="flex items-center space-x-3 mb-6">
                                <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-blue-500 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">Personal Information</h3>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Name Field -->
                                <div class="space-y-2">
                                    <label for="customer_name" class="block text-sm font-semibold text-gray-700">
                                        Full Name <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                        </div>
                                        <input type="text" 
                                               id="customer_name" 
                                               name="customer_name" 
                                               required
                                               class="block w-full pl-10 pr-3 py-4 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300"
                                               placeholder="Enter your full name">
                                    </div>
                                </div>

                                <!-- Email Field -->
                                <div class="space-y-2">
                                    <label for="email" class="block text-sm font-semibold text-gray-700">
                                        Email Address <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                            </svg>
                                        </div>
                                        <input type="email" 
                                               id="email" 
                                               name="email" 
                                               required
                                               class="block w-full pl-10 pr-3 py-4 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300"
                                               placeholder="Enter your email address">
                                    </div>
                                </div>

                                <!-- Phone Field -->
                                <div class="space-y-2">
                                    <label for="phone" class="block text-sm font-semibold text-gray-700">
                                        Phone Number <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                            </svg>
                                        </div>
                                        <input type="tel" 
                                               id="phone" 
                                               name="phone" 
                                               required
                                               class="block w-full pl-10 pr-3 py-4 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300"
                                               placeholder="Enter your phone number">
                                    </div>
                                </div>

                                <!-- Country Field -->
                                <div class="space-y-2">
                                    <label for="country" class="block text-sm font-semibold text-gray-700">
                                        Country <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                        </div>
                                        <input type="text" 
                                               id="country" 
                                               name="country" 
                                               required
                                               class="block w-full pl-10 pr-3 py-4 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300"
                                               placeholder="Enter your country">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Business Requirements Section -->
                        <div class="space-y-6">
                            <div class="flex items-center space-x-3 mb-6">
                                <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-emerald-500 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">Business Requirements</h3>
                            </div>

                            <!-- Subject Field -->
                            <div class="space-y-2">
                                <label for="subject" class="block text-sm font-semibold text-gray-700">
                                    Subject <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                        </svg>
                                    </div>
                                    <input type="text" 
                                           id="subject" 
                                           name="subject" 
                                           required
                                           class="block w-full pl-10 pr-3 py-4 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300"
                                           placeholder="Brief subject of your requirement">
                                </div>
                            </div>

                            <!-- Description Field -->
                            <div class="space-y-2">
                                <label for="description" class="block text-sm font-semibold text-gray-700">
                                    Detailed Description <span class="text-red-500">*</span>
                                </label>
                                <textarea id="description" 
                                          name="description" 
                                          required
                                          rows="6"
                                          class="block w-full px-4 py-4 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 resize-none"
                                          placeholder="Please provide detailed information about your business requirements, including specifications, quantities, timeline, and any other relevant details..."></textarea>
                                <p class="text-sm text-gray-500">Minimum 50 characters recommended for better responses</p>
                            </div>
                        </div>

                        <!-- File Upload Section -->
                        <div class="space-y-6">
                            <div class="flex items-center space-x-3 mb-6">
                                <div class="w-8 h-8 bg-gradient-to-br from-orange-500 to-red-500 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">Supporting Documents</h3>
                            </div>

                            <!-- Upload Checkbox -->
                            <div class="bg-gray-50 rounded-xl p-6">
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="checkbox" 
                                           id="upload_file" 
                                           name="upload_file" 
                                           value="1" 
                                           class="w-5 h-5 text-purple-600 bg-gray-100 border-gray-300 rounded focus:ring-purple-500 focus:ring-2 transition-all duration-300">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-semibold text-gray-900">Upload supporting files</span>
                                        <span class="text-sm text-gray-500">Add images, documents, or specifications (Optional)</span>
                                    </div>
                                </label>
                            </div>

                            <!-- File Upload Area -->
                            <div id="file-upload-area" class="hidden space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="space-y-2">
                                        <label class="block text-sm font-semibold text-gray-700">Image 1</label>
                                        <div class="relative border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-purple-400 transition-colors duration-300">
                                            <input type="file" 
                                                   name="img-1" 
                                                   accept="image/*" 
                                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            <p class="mt-2 text-sm text-gray-600">Click to upload</p>
                                        </div>
                                    </div>

                                    <div class="space-y-2">
                                        <label class="block text-sm font-semibold text-gray-700">Image 2</label>
                                        <div class="relative border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-purple-400 transition-colors duration-300">
                                            <input type="file" 
                                                   name="img-2" 
                                                   accept="image/*" 
                                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            <p class="mt-2 text-sm text-gray-600">Click to upload</p>
                                        </div>
                                    </div>

                                    <div class="space-y-2">
                                        <label class="block text-sm font-semibold text-gray-700">Image 3</label>
                                        <div class="relative border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-purple-400 transition-colors duration-300">
                                            <input type="file" 
                                                   name="img-3" 
                                                   accept="image/*" 
                                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            <p class="mt-2 text-sm text-gray-600">Click to upload</p>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-500 text-center">Supported formats: JPG, PNG, GIF. Max size: 5MB per file</p>
                            </div>
                        </div>

                        <!-- Submit Section -->
                        <div class="space-y-6 pt-8 border-t border-gray-200">
                            <div class="text-center">
                                <button type="submit" 
                                        id="submit-btn"
                                        class="inline-flex items-center bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 text-white font-bold py-4 px-12 rounded-2xl transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                    </svg>
                                    <span>Submit Requirements</span>
                                    <div class="hidden ml-3 animate-spin">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                        </svg>
                                    </div>
                                </button>
                            </div>

                            <!-- Terms and Privacy -->
                            <div class="text-center">
                                <p class="text-sm text-gray-600 max-w-2xl mx-auto">
                                    By submitting this form, you agree to our 
                                    <a href="{{ route('policy') }}" class="text-purple-600 hover:text-purple-700 font-semibold underline">
                                        Privacy Policy
                                    </a> 
                                    and 
                                    <a href="{{ route('tos') }}" class="text-purple-600 hover:text-purple-700 font-semibold underline">
                                        Terms of Service
                                    </a>. 
                                    We'll connect you with relevant business partners within 24 hours.
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Success Message Section -->
    <div id="success-message" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl shadow-2xl max-w-md w-full p-8 text-center transform transition-all duration-300">
            <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-500 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-4">Requirements Submitted!</h3>
            <p class="text-gray-600 mb-6">Thank you! We've received your business requirements and will connect you with relevant partners within 24 hours.</p>
            <button onclick="document.getElementById('success-message').classList.add('hidden')" 
                    class="bg-gradient-to-r from-purple-600 to-blue-600 text-white px-8 py-3 rounded-xl font-semibold hover:from-purple-700 hover:to-blue-700 transition-all duration-300">
                Close
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('requirements-form');
    const submitBtn = document.getElementById('submit-btn');
    const uploadCheckbox = document.getElementById('upload_file');
    const fileUploadArea = document.getElementById('file-upload-area');
    const successMessage = document.getElementById('success-message');

    // Toggle file upload area
    uploadCheckbox.addEventListener('change', function() {
        if (this.checked) {
            fileUploadArea.classList.remove('hidden');
            fileUploadArea.classList.add('animate-fade-in');
        } else {
            fileUploadArea.classList.add('hidden');
        }
    });

    // Form validation and submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Basic validation
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.classList.add('border-red-500', 'bg-red-50');
                field.classList.remove('border-gray-200');
            } else {
                field.classList.remove('border-red-500', 'bg-red-50');
                field.classList.add('border-gray-200');
            }
        });

        // Email validation
        const email = form.querySelector('[name="email"]');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email.value && !emailRegex.test(email.value)) {
            isValid = false;
            email.classList.add('border-red-500', 'bg-red-50');
        }

        // Description length check
        const description = form.querySelector('[name="description"]');
        if (description.value.length < 20) {
            isValid = false;
            description.classList.add('border-red-500', 'bg-red-50');
        }

        if (isValid) {
            // Show loading state
            const btnText = submitBtn.querySelector('span');
            const btnSpinner = submitBtn.querySelector('.animate-spin').parentElement;
            
            btnText.textContent = 'Submitting...';
            btnSpinner.classList.remove('hidden');
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-75', 'cursor-not-allowed');

            // Simulate form submission (replace with actual submission)
            setTimeout(() => {
                successMessage.classList.remove('hidden');
                
                // Reset form
                form.reset();
                fileUploadArea.classList.add('hidden');
                uploadCheckbox.checked = false;
                
                // Reset button
                btnText.textContent = 'Submit Requirements';
                btnSpinner.classList.add('hidden');
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-75', 'cursor-not-allowed');
            }, 2000);
            
            // Uncomment this for actual form submission
            // this.submit();
        } else {
            // Shake effect for invalid form
            form.classList.add('animate-shake');
            setTimeout(() => {
                form.classList.remove('animate-shake');
            }, 500);
        }
    });

    // File upload preview
    const fileInputs = document.querySelectorAll('input[type="file"]');
    fileInputs.forEach(input => {
        input.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                const container = this.parentElement;
                
                reader.onload = function(e) {
                    container.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-full object-cover rounded-lg">
                        <div class="absolute inset-0 bg-black/50 opacity-0 hover:opacity-100 transition-opacity duration-300 rounded-lg flex items-center justify-center">
                            <span class="text-white text-sm font-semibold">Change Image</span>
                        </div>
                        <input type="file" name="${input.name}" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                    `;
                };
                reader.readAsDataURL(file);
            }
        });
    });

    // Character counter for description
    const description = document.querySelector('[name="description"]');
    const charCounter = document.createElement('div');
    charCounter.className = 'text-sm text-gray-500 mt-1 text-right';
    description.parentElement.appendChild(charCounter);

    description.addEventListener('input', function() {
        const length = this.value.length;
        charCounter.textContent = `${length} characters`;
        
        if (length < 20) {
            charCounter.classList.add('text-red-500');
            charCounter.classList.remove('text-gray-500');
        } else {
            charCounter.classList.remove('text-red-500');
            charCounter.classList.add('text-gray-500');
        }
    });
});
</script>

<style>
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    75% { transform: translateX(5px); }
}

.animate-fade-in {
    animation: fadeIn 0.5s ease-out;
}

.animate-shake {
    animation: shake 0.5s ease-in-out;
}
</style>
@endsection