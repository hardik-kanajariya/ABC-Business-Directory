@props(['seo'])
@props(['route'])

<div class="bg-gradient-to-br from-gray-50 to-gray-100 py-12 mt-16">
    <div class="container mx-auto px-4 max-w-6xl bg-transparent">
        <!-- Section Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-12 h-12 bg-indigo-100 rounded-full mb-4">
                <i class='bx bx-hash text-indigo-600 text-xl'></i>
            </div>
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">
                Explore Related Topics
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Discover more companies and services with these popular search terms
            </p>
        </div>

        <!-- Keywords Container -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 md:p-8">
            @php
                $allKeywords = collect();
                foreach ($seo as $item) {
                    $allKeywords = $allKeywords->merge($item->meta_keywords ?? []);
                }
                $allKeywords = $allKeywords->unique()->filter()->take(20); // Limit to 20 keywords
            @endphp

            @if($allKeywords->count() > 0)
                <div class="flex flex-wrap gap-3 justify-center">
                    @foreach($allKeywords as $index => $keyword)
                        @php
                            $keywordUrl = route($route, ['q' => $keyword]);
                            // Add some visual variety with different colors
                            $colorClasses = [
                                'bg-indigo-50 text-indigo-700 hover:bg-indigo-600 hover:text-white border-indigo-200',
                                'bg-purple-50 text-purple-700 hover:bg-purple-600 hover:text-white border-purple-200',
                                'bg-blue-50 text-blue-700 hover:bg-blue-600 hover:text-white border-blue-200',
                                'bg-green-50 text-green-700 hover:bg-green-600 hover:text-white border-green-200',
                                'bg-pink-50 text-pink-700 hover:bg-pink-600 hover:text-white border-pink-200',
                                'bg-yellow-50 text-yellow-700 hover:bg-yellow-600 hover:text-white border-yellow-200',
                            ];
                            $colorClass = $colorClasses[$index % count($colorClasses)];
                        @endphp

                        <a href="{{ $keywordUrl }}"
                            class="keyword-tag inline-flex items-center px-4 py-2 rounded-full text-sm font-medium border transition-all duration-300 ease-in-out transform hover:scale-105 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 {{ $colorClass }}"
                            data-keyword="{{ $keyword }}">
                            <span class="truncate max-w-xs">{{ ucwords($keyword) }}</span>
                            <i
                                class='bx bx-right-arrow-alt ml-2 text-xs opacity-60 group-hover:opacity-100 transition-opacity'></i>
                        </a>
                    @endforeach
                </div>

                <!-- Show More/Less for mobile optimization -->
                @if($allKeywords->count() > 10)
                    <div class="text-center mt-6 md:hidden">
                        <button id="toggleKeywords"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-indigo-600 hover:text-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded-lg transition-colors"
                            onclick="toggleKeywordsVisibility()">
                            <span id="toggleText">Show More</span>
                            <i id="toggleIcon" class='bx bx-chevron-down ml-1 transition-transform'></i>
                        </button>
                    </div>
                @endif

                <!-- Stats and CTA -->
                <div class="mt-8 pt-6 border-t border-gray-100">
                    <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                        <div class="flex items-center text-sm text-gray-600">
                            <i class='bx bx-info-circle mr-2'></i>
                            <span>{{ $allKeywords->count() }} popular search terms</span>
                        </div>

                        <div class="flex items-center gap-4">
                            <button onclick="copyKeywords()"
                                class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-gray-600 hover:text-gray-800 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-500"
                                title="Copy all keywords">
                                <i class='bx bx-copy mr-1'></i>
                                Copy All
                            </button>

                            <a href="{{ route($route) }}"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                <i class='bx bx-search mr-2'></i>
                                Browse All Companies
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <!-- Enhanced Empty State -->
                <div class="text-center py-12">
                    <div class="mb-6">
                        <i class='bx bx-hash text-4xl text-gray-300'></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">
                        No Keywords Available
                    </h3>
                    <p class="text-gray-600 mb-6 max-w-md mx-auto">
                        We're still collecting popular search terms. Check back soon for trending keywords!
                    </p>
                    <a href="{{ route($route) }}"
                        class="inline-flex items-center px-6 py-3 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        <i class='bx bx-search mr-2'></i>
                        Explore All Companies
                    </a>
                </div>
            @endif
        </div>

        <!-- Additional Features Section -->
        @if($allKeywords->count() > 0)
            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Popular Searches -->
                <div class="bg-white rounded-xl p-6 shadow-md border border-gray-200 text-center">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class='bx bx-trending-up text-blue-600 text-xl'></i>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Trending Searches</h3>
                    <p class="text-sm text-gray-600">Discover what others are looking for</p>
                </div>

                <!-- Quick Access -->
                <div class="bg-white rounded-xl p-6 shadow-md border border-gray-200 text-center">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class='bx bx-rocket text-green-600 text-xl'></i>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Quick Access</h3>
                    <p class="text-sm text-gray-600">One-click search for popular terms</p>
                </div>

                <!-- Smart Suggestions -->
                <div class="bg-white rounded-xl p-6 shadow-md border border-gray-200 text-center">
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class='bx bx-bulb text-purple-600 text-xl'></i>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Smart Suggestions</h3>
                    <p class="text-sm text-gray-600">AI-powered keyword recommendations</p>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Toast Notification for Copy Action -->
<div id="copyToast"
    class="fixed bottom-4 right-4 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg transform translate-y-full transition-transform duration-300 z-50">
    <div class="flex items-center">
        <i class='bx bx-check-circle mr-2'></i>
        <span>Keywords copied to clipboard!</span>
    </div>
</div>

<style>
    /* Enhanced keyword tag animations */
    .keyword-tag {
        position: relative;
        overflow: hidden;
    }

    .keyword-tag::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .keyword-tag:hover::before {
        left: 100%;
    }

    /* Mobile keyword hiding */
    @media (max-width: 768px) {
        .keyword-tag:nth-child(n+11) {
            display: none;
        }

        .keyword-tag:nth-child(n+11).show {
            display: inline-flex;
        }
    }

    /* Smooth animations */
    .keyword-tag {
        animation: fadeInUp 0.6s ease-out forwards;
        opacity: 0;
        transform: translateY(20px);
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Stagger animation delays */
    .keyword-tag:nth-child(1) {
        animation-delay: 0.1s;
    }

    .keyword-tag:nth-child(2) {
        animation-delay: 0.2s;
    }

    .keyword-tag:nth-child(3) {
        animation-delay: 0.3s;
    }

    .keyword-tag:nth-child(4) {
        animation-delay: 0.4s;
    }

    .keyword-tag:nth-child(5) {
        animation-delay: 0.5s;
    }

    .keyword-tag:nth-child(n+6) {
        animation-delay: 0.6s;
    }
</style>

<script>
    // Toggle keywords visibility on mobile
    function toggleKeywordsVisibility() {
        const hiddenKeywords = document.querySelectorAll('.keyword-tag:nth-child(n+11)');
        const toggleText = document.getElementById('toggleText');
        const toggleIcon = document.getElementById('toggleIcon');
        const isShowing = toggleText.textContent === 'Show Less';

        hiddenKeywords.forEach(keyword => {
            if (isShowing) {
                keyword.classList.remove('show');
            } else {
                keyword.classList.add('show');
            }
        });

        toggleText.textContent = isShowing ? 'Show More' : 'Show Less';
        toggleIcon.style.transform = isShowing ? 'rotate(0deg)' : 'rotate(180deg)';
    }

    // Copy all keywords to clipboard
    async function copyKeywords() {
        const keywords = Array.from(document.querySelectorAll('.keyword-tag')).map(tag =>
            tag.getAttribute('data-keyword')
        ).join(', ');

        try {
            await navigator.clipboard.writeText(keywords);
            showCopyToast();
        } catch (err) {
            // Fallback for older browsers
            const textArea = document.createElement('textarea');
            textArea.value = keywords;
            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();
            try {
                document.execCommand('copy');
                showCopyToast();
            } catch (err) {
                console.error('Failed to copy keywords:', err);
            }
            document.body.removeChild(textArea);
        }
    }

    // Show copy toast notification
    function showCopyToast() {
        const toast = document.getElementById('copyToast');
        toast.style.transform = 'translateY(0)';

        setTimeout(() => {
            toast.style.transform = 'translateY(100%)';
        }, 3000);
    }

    // Add click analytics (optional)
    document.querySelectorAll('.keyword-tag').forEach(tag => {
        tag.addEventListener('click', function (e) {
            const keyword = this.getAttribute('data-keyword');

            // Optional: Send analytics data
            if (typeof gtag !== 'undefined') {
                gtag('event', 'keyword_click', {
                    event_category: 'related_keywords',
                    event_label: keyword,
                    value: 1
                });
            }

            // Optional: Add loading state
            this.style.opacity = '0.7';
            this.style.pointerEvents = 'none';
        });
    });

    // Intersection Observer for scroll animations
    if ('IntersectionObserver' in window) {
        const keywordObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        document.querySelectorAll('.keyword-tag').forEach(tag => {
            tag.style.animationPlayState = 'paused';
            keywordObserver.observe(tag);
        });
    }
</script>