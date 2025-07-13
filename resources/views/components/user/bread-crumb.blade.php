<nav class="breadcrumb-container bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200" aria-label="Breadcrumb">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-3 sm:py-4">
        <div class="flex items-center justify-between">
            <!-- Breadcrumb Navigation -->
            <ol class="flex items-center space-x-1 sm:space-x-2" itemscope itemtype="https://schema.org/BreadcrumbList">
                @foreach ($data as $index => $crumb)
                    <li class="flex items-center breadcrumb-item" 
                        itemprop="itemListElement" 
                        itemscope 
                        itemtype="https://schema.org/ListItem">
                        
                        @if($index === 0)
                            <!-- Home Icon for first item -->
                            <div class="flex items-center">
                                @if($crumb === 'Home')
                                    <a href="{{ url('/') }}" 
                                       class="breadcrumb-link home-link flex items-center space-x-1"
                                       itemprop="item">
                                        <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                                        </svg>
                                        <span class="hidden sm:inline" itemprop="name">{{ $crumb }}</span>
                                    </a>
                                @else
                                    <a href="{{ url('/') }}" 
                                       class="breadcrumb-link home-link flex items-center"
                                       itemprop="item">
                                        <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                                        </svg>
                                        <span class="sr-only" itemprop="name">Home</span>
                                    </a>
                                @endif
                                <meta itemprop="position" content="{{ $index + 1 }}">
                            </div>
                        @else
                            <!-- Regular breadcrumb items -->
                            <div class="flex items-center">
                                @switch($crumb)
                                    @case('Company')
                                        <a href="{{ route('company') }}" 
                                           class="breadcrumb-link flex items-center space-x-1"
                                           itemprop="item">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                            </svg>
                                            <span itemprop="name">{{ Str::limit($crumb, 20) }}</span>
                                        </a>
                                        @break
                                    @case('Product')
                                        <a href="{{ route('products') }}" 
                                           class="breadcrumb-link flex items-center space-x-1"
                                           itemprop="item">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                            </svg>
                                            <span itemprop="name">{{ Str::limit($crumb, 20) }}</span>
                                        </a>
                                        @break
                                    @case('Event')
                                        <a href="{{ route('events') }}" 
                                           class="breadcrumb-link flex items-center space-x-1"
                                           itemprop="item">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            <span itemprop="name">{{ $crumb }}</span>
                                        </a>
                                        @break
                                    @case('Jobs')
                                        <a href="{{ route('jobs') }}" 
                                           class="breadcrumb-link flex items-center space-x-1"
                                           itemprop="item">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0H8m8 0v2a2 2 0 01-2 2H10a2 2 0 01-2-2V6m8 0H8"/>
                                            </svg>
                                            <span itemprop="name">{{ $crumb }}</span>
                                        </a>
                                        @break
                                    @case('Blogs')
                                        <a href="{{ route('blogs') }}" 
                                           class="breadcrumb-link flex items-center space-x-1"
                                           itemprop="item">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                            </svg>
                                            <span itemprop="name">{{ $crumb }}</span>
                                        </a>
                                        @break
                                    @case('Forum')
                                        <a href="{{ route('forum') }}" 
                                           class="breadcrumb-link flex items-center space-x-1"
                                           itemprop="item">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a2 2 0 01-2-2v-6a2 2 0 012-2h8z"/>
                                            </svg>
                                            <span itemprop="name">{{ $crumb }}</span>
                                        </a>
                                        @break
                                    @case('Deal')
                                        <a href="{{ route('deals') }}" 
                                           class="breadcrumb-link flex items-center space-x-1"
                                           itemprop="item">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                            </svg>
                                            <span itemprop="name">{{ $crumb }}</span>
                                        </a>
                                        @break
                                    @default
                                        @if($index === count($data) - 1)
                                            <!-- Last item (current page) - no link -->
                                            <span class="breadcrumb-current flex items-center space-x-1" 
                                                  itemprop="item">
                                                <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                                <span itemprop="name" class="font-semibold">{{ Str::limit($crumb, 30) }}</span>
                                            </span>
                                        @else
                                            <a href="#" 
                                               class="breadcrumb-link flex items-center space-x-1"
                                               itemprop="item">
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                                <span itemprop="name">{{ Str::limit($crumb, 20) }}</span>
                                            </a>
                                        @endif
                                @endswitch
                                <meta itemprop="position" content="{{ $index + 1 }}">
                            </div>
                        @endif
                        
                        <!-- Separator -->
                        @if ($index < count($data) - 1)
                            <div class="flex items-center mx-2 sm:mx-3">
                                <svg class="w-4 h-4 text-gray-300 transform transition-transform duration-200 hover:scale-110" 
                                     fill="currentColor" 
                                     viewBox="0 0 20 20" 
                                     aria-hidden="true">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        @endif
                    </li>
                @endforeach
            </ol>
        </div>
        
        <!-- Mobile Breadcrumb Summary -->
        <div class="mt-3 md:hidden">
            <div class="flex items-center space-x-2 text-sm text-gray-500">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span>Page {{ count($data) }} of navigation path</span>
            </div>
        </div>
    </div>
</nav>

<style>
/* Enhanced Breadcrumb Styles */
.breadcrumb-container {
    backdrop-filter: blur(8px);
    border-bottom: 1px solid rgba(139, 92, 246, 0.1);
    position: relative;
}

.breadcrumb-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(139, 92, 246, 0.3), transparent);
}

.breadcrumb-item {
    animation: slideInUp 0.3s ease-out forwards;
}

.breadcrumb-item:nth-child(1) { animation-delay: 0.1s; }
.breadcrumb-item:nth-child(2) { animation-delay: 0.2s; }
.breadcrumb-item:nth-child(3) { animation-delay: 0.3s; }
.breadcrumb-item:nth-child(4) { animation-delay: 0.4s; }
.breadcrumb-item:nth-child(5) { animation-delay: 0.5s; }

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.breadcrumb-link {
    padding: 6px 12px;
    border-radius: 8px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    color: #6b7280;
    text-decoration: none;
    font-weight: 500;
    position: relative;
    overflow: hidden;
}

.breadcrumb-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(139, 92, 246, 0.1), transparent);
    transition: left 0.5s;
}

.breadcrumb-link:hover::before {
    left: 100%;
}

.breadcrumb-link:hover {
    color: #8b5cf6;
    background: rgba(139, 92, 246, 0.05);
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(139, 92, 246, 0.1);
}

.breadcrumb-link:active {
    transform: translateY(0);
}

.home-link:hover {
    background: rgba(16, 185, 129, 0.05);
    color: #10b981;
}

.breadcrumb-current {
    padding: 6px 12px;
    border-radius: 8px;
    background: linear-gradient(135deg, rgba(139, 92, 246, 0.1) 0%, rgba(59, 130, 246, 0.1) 100%);
    color: #8b5cf6;
    border: 1px solid rgba(139, 92, 246, 0.2);
    font-weight: 600;
}

.back-button, .share-button {
    padding: 6px 12px;
    border-radius: 8px;
    transition: all 0.3s ease;
    border: 1px solid transparent;
}

.back-button:hover, .share-button:hover {
    background: rgba(139, 92, 246, 0.05);
    border-color: rgba(139, 92, 246, 0.2);
    transform: translateY(-1px);
}

/* Mobile Optimizations */
@media (max-width: 640px) {
    .breadcrumb-link span {
        max-width: 120px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    
    .breadcrumb-current span {
        max-width: 150px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
}

/* Print Styles */
@media print {
    .breadcrumb-container {
        background: none !important;
        border: none !important;
        box-shadow: none !important;
    }
    
    .back-button, .share-button {
        display: none !important;
    }
}

/* High Contrast Mode */
@media (prefers-contrast: high) {
    .breadcrumb-link {
        border: 1px solid currentColor;
    }
    
    .breadcrumb-current {
        border: 2px solid currentColor;
    }
}

/* Reduced Motion */
@media (prefers-reduced-motion: reduce) {
    .breadcrumb-item {
        animation: none;
    }
    
    .breadcrumb-link, .back-button, .share-button {
        transition: none;
    }
}
</style>

<script>
// Enhanced Breadcrumb Functionality
document.addEventListener('DOMContentLoaded', function() {
    // Add keyboard navigation
    const breadcrumbLinks = document.querySelectorAll('.breadcrumb-link');
    
    breadcrumbLinks.forEach((link, index) => {
        link.addEventListener('keydown', function(e) {
            if (e.key === 'ArrowRight' && breadcrumbLinks[index + 1]) {
                e.preventDefault();
                breadcrumbLinks[index + 1].focus();
            } else if (e.key === 'ArrowLeft' && breadcrumbLinks[index - 1]) {
                e.preventDefault();
                breadcrumbLinks[index - 1].focus();
            }
        });
    });
    
    // Add ripple effect on click
    breadcrumbLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.cssText = `
                position: absolute;
                border-radius: 50%;
                background: rgba(139, 92, 246, 0.3);
                transform: scale(0);
                animation: ripple 0.6s linear;
                width: ${size}px;
                height: ${size}px;
                left: ${x}px;
                top: ${y}px;
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

// Share functionality
function shareCurrentPage() {
    if (navigator.share) {
        navigator.share({
            title: document.title,
            url: window.location.href
        }).catch(err => console.log('Error sharing:', err));
    } else {
        // Fallback - copy to clipboard
        navigator.clipboard.writeText(window.location.href).then(() => {
            showToast('success', 'Page URL copied to clipboard!');
        }).catch(() => {
            showToast('error', 'Failed to copy URL');
        });
    }
}

// Ripple animation CSS
const rippleStyle = document.createElement('style');
rippleStyle.textContent = `
    @keyframes ripple {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
`;
document.head.appendChild(rippleStyle);

// Add intersection observer for animation
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -10px 0px'
};

const breadcrumbObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.animationPlayState = 'running';
        }
    });
}, observerOptions);

document.querySelectorAll('.breadcrumb-item').forEach(item => {
    breadcrumbObserver.observe(item);
});
</script>