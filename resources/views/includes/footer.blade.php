<!-- Modern Comprehensive Footer -->
<footer class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white">
    <!-- Main Footer Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
            
            <!-- Company Info -->
            <div class="lg:col-span-1">
                <div class="mb-6">
                    <img src="{{ asset('storage/image/logo.png') }}" 
                         alt="{{ config('app.name') }} Logo" 
                         class="h-[27px] w-[150px] md:h-[27px] md:w-[150px] mb-4 transition-transform duration-300 hover:scale-105">
                    <h3 class="text-xl font-bold text-white mb-3">{{ config('app.name') }}</h3>
                    <p class="text-gray-300 text-sm leading-relaxed mb-6">
                        Your trusted business directory connecting customers with local businesses worldwide. 
                        Discover, connect, and grow with verified business listings.
                    </p>
                </div>
                
                <!-- Social Media -->
                <div class="space-y-3">
                    <h4 class="text-sm font-semibold text-white uppercase tracking-wider">Follow Us</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="group bg-gray-700 hover:bg-blue-600 p-2 rounded-lg transition-all duration-300 transform hover:scale-110">
                            <svg class="w-5 h-5 text-gray-300 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/>
                            </svg>
                        </a>
                        <a href="#" class="group bg-gray-700 hover:bg-blue-400 p-2 rounded-lg transition-all duration-300 transform hover:scale-110">
                            <svg class="w-5 h-5 text-gray-300 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/>
                            </svg>
                        </a>
                        <a href="#" class="group bg-gray-700 hover:bg-pink-600 p-2 rounded-lg transition-all duration-300 transform hover:scale-110">
                            <svg class="w-5 h-5 text-gray-300 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <rect width="20" height="20" x="2" y="2" rx="5" ry="5"/>
                                <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"/>
                            </svg>
                        </a>
                        <a href="#" class="group bg-gray-700 hover:bg-blue-700 p-2 rounded-lg transition-all duration-300 transform hover:scale-110">
                            <svg class="w-5 h-5 text-gray-300 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"/>
                                <circle cx="4" cy="4" r="2"/>
                            </svg>
                        </a>
                        <a href="#" class="group bg-gray-700 hover:bg-red-600 p-2 rounded-lg transition-all duration-300 transform hover:scale-110">
                            <svg class="w-5 h-5 text-gray-300 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.498 6.186a2.94 2.94 0 00-2.064-2.086C19.598 3.656 12 3.656 12 3.656s-7.598 0-9.434.444A2.94 2.94 0 00.502 6.186C.06 8.032.06 12 .06 12s0 3.968.442 5.814a2.94 2.94 0 002.064 2.086C4.402 20.344 12 20.344 12 20.344s7.598 0 9.434-.444a2.94 2.94 0 002.064-2.086C23.94 15.968 23.94 12 23.94 12s0-3.968-.442-5.814z"/>
                                <path fill="#000" d="M9.75 15.02l6.22-3.02L9.75 8.98v6.04z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div>
                <h4 class="text-sm font-semibold text-white uppercase tracking-wider mb-6">Quick Links</h4>
                <nav class="space-y-3">
                    <a href="{{ url('/') }}" class="block text-gray-300 hover:text-purple-400 transition-colors duration-300 text-sm group">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                            Home
                        </div>
                    </a>
                    <a href="{{ route('company') }}" class="block text-gray-300 hover:text-purple-400 transition-colors duration-300 text-sm group">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                            Companies
                        </div>
                    </a>
                    <a href="{{ route('products') }}" class="block text-gray-300 hover:text-purple-400 transition-colors duration-300 text-sm group">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                            Products
                        </div>
                    </a>
                    <a href="{{ route('deals') }}" class="block text-gray-300 hover:text-purple-400 transition-colors duration-300 text-sm group">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                            Deals & Offers
                        </div>
                    </a>
                    <a href="{{ route('events') }}" class="block text-gray-300 hover:text-purple-400 transition-colors duration-300 text-sm group">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                            Events
                        </div>
                    </a>
                    <a href="{{ route('jobs') }}" class="block text-gray-300 hover:text-purple-400 transition-colors duration-300 text-sm group">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                            Job Opportunities
                        </div>
                    </a>
                </nav>
            </div>
            
            <!-- Business Services -->
            <div>
                <h4 class="text-sm font-semibold text-white uppercase tracking-wider mb-6">Business Services</h4>
                <nav class="space-y-3">
                    <a href="{{ route('blogs') }}" class="block text-gray-300 hover:text-purple-400 transition-colors duration-300 text-sm group">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                            Business Blog
                        </div>
                    </a>
                    <a href="{{ route('forum') }}" class="block text-gray-300 hover:text-purple-400 transition-colors duration-300 text-sm group">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                            Community Forum
                        </div>
                    </a>
                    <a href="#" class="block text-gray-300 hover:text-purple-400 transition-colors duration-300 text-sm group">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                            List Your Business
                        </div>
                    </a>
                    <a href="#" class="block text-gray-300 hover:text-purple-400 transition-colors duration-300 text-sm group">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                            Advertise With Us
                        </div>
                    </a>
                    <a href="#" class="block text-gray-300 hover:text-purple-400 transition-colors duration-300 text-sm group">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                            Business Tools
                        </div>
                    </a>
                    <a href="#" class="block text-gray-300 hover:text-purple-400 transition-colors duration-300 text-sm group">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                            Success Stories
                        </div>
                    </a>
                </nav>
            </div>
            
            <!-- Support & Contact -->
            <div>
                <h4 class="text-sm font-semibold text-white uppercase tracking-wider mb-6">Support & Contact</h4>
                <div class="space-y-4">
                    <!-- Contact Info -->
                    <div class="space-y-3">
                        <div class="flex items-start space-x-3">
                            <div class="bg-purple-600 p-2 rounded-lg">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 uppercase tracking-wider">Email</p>
                                <a href="mailto:support@company.com" class="text-sm text-gray-300 hover:text-purple-400 transition-colors duration-300">
                                    support@company.com
                                </a>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3">
                            <div class="bg-purple-600 p-2 rounded-lg">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 uppercase tracking-wider">Phone</p>
                                <a href="tel:+1234567890" class="text-sm text-gray-300 hover:text-purple-400 transition-colors duration-300">
                                    +1 (234) 567-8900
                                </a>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3">
                            <div class="bg-purple-600 p-2 rounded-lg">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400 uppercase tracking-wider">Address</p>
                                <p class="text-sm text-gray-300">
                                    123 Business Street<br>
                                    Suite 100, City, ST 12345
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Support Links -->
                    <div class="pt-4 border-t border-gray-700">
                        <nav class="space-y-2">
                            <a href="#" class="block text-gray-300 hover:text-purple-400 transition-colors duration-300 text-sm">Help Center</a>
                            <a href="#" class="block text-gray-300 hover:text-purple-400 transition-colors duration-300 text-sm">Contact Support</a>
                            <a href="#" class="block text-gray-300 hover:text-purple-400 transition-colors duration-300 text-sm">Report Issue</a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Newsletter Section -->
    <div class="border-t border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col lg:flex-row items-center justify-between space-y-6 lg:space-y-0">
                <div class="text-center lg:text-left">
                    <h3 class="text-lg font-semibold text-white mb-2">Stay Updated</h3>
                    <p class="text-gray-300 text-sm">Get the latest business listings and opportunities delivered to your inbox.</p>
                </div>
                <div class="w-full lg:w-auto">
                    <form class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-3 max-w-md mx-auto lg:mx-0">
                        <input type="email" 
                               placeholder="Enter your email" 
                               class="flex-1 px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300">
                        <button type="submit" 
                                class="px-6 py-3 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-semibold rounded-lg transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-gray-900">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bottom Bar -->
    <div class="border-t border-gray-700 bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col lg:flex-row items-center justify-between space-y-4 lg:space-y-0">
                <!-- Copyright -->
                <div class="flex items-center space-x-4 text-sm text-gray-400">
                    <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
                    <span class="hidden lg:block">|</span>
                    <p class="hidden lg:block">Empowering businesses worldwide since 2020</p>
                </div>
                
                <!-- Legal Links -->
                <div class="flex items-center space-x-6 text-sm">
                    <a href="#" class="text-gray-400 hover:text-purple-400 transition-colors duration-300">Privacy Policy</a>
                    <a href="#" class="text-gray-400 hover:text-purple-400 transition-colors duration-300">Terms of Service</a>
                    <a href="#" class="text-gray-400 hover:text-purple-400 transition-colors duration-300">Cookie Policy</a>
                    <a href="#" class="text-gray-400 hover:text-purple-400 transition-colors duration-300">Sitemap</a>
                </div>
            </div>
            
            <!-- Additional Info -->
            <div class="mt-6 pt-6 border-t border-gray-800">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center md:text-left">
                    <div class="flex items-center justify-center md:justify-start space-x-2">
                        <div class="bg-green-500 w-2 h-2 rounded-full animate-pulse"></div>
                        <span class="text-sm text-gray-400">All systems operational</span>
                    </div>
                    <div class="flex items-center justify-center space-x-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <span class="text-sm text-gray-400">SSL Secured</span>
                    </div>
                    <div class="flex items-center justify-center md:justify-end space-x-2">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-sm text-gray-400">Verified Business Directory</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Back to Top Button -->
    <button id="back-to-top" 
            class="fixed bottom-6 right-6 bg-purple-600 hover:bg-purple-700 text-white p-3 rounded-full shadow-lg transition-all duration-300 transform hover:scale-110 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 opacity-0 invisible">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
        </svg>
    </button>
</footer>

<!-- Footer JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Back to top functionality
    const backToTopButton = document.getElementById('back-to-top');
    
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            backToTopButton.classList.remove('opacity-0', 'invisible');
            backToTopButton.classList.add('opacity-100', 'visible');
        } else {
            backToTopButton.classList.add('opacity-0', 'invisible');
            backToTopButton.classList.remove('opacity-100', 'visible');
        }
    });
    
    backToTopButton.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
    
    // Newsletter form submission
    const newsletterForm = document.querySelector('footer form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[type="email"]').value;
            
            if (email) {
                // Show success message
                const button = this.querySelector('button');
                const originalText = button.innerHTML;
                button.innerHTML = 'Subscribed!';
                button.classList.add('bg-green-600');
                
                setTimeout(() => {
                    button.innerHTML = originalText;
                    button.classList.remove('bg-green-600');
                    this.querySelector('input[type="email"]').value = '';
                }, 2000);
            }
        });
    }
    
    // Animate social icons on hover
    const socialIcons = document.querySelectorAll('footer a[href="#"]');
    socialIcons.forEach(icon => {
        icon.addEventListener('mouseenter', function() {
            this.querySelector('svg').classList.add('animate-bounce');
        });
        
        icon.addEventListener('mouseleave', function() {
            this.querySelector('svg').classList.remove('animate-bounce');
        });
    });
});
</script>