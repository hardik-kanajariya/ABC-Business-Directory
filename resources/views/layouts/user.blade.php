<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="utf-8">
    <title>{{ config()->get('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @livewireStyles
    @filamentStyles
    <script src="{{ asset('js/tailwind.js')}}"></script>
    <link href="{{ asset('css/boxicons/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bladewind/css/bladewind-ui.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('css/toastify.min.css')}}">
    <link href="{{ asset('css/main.css')}}" rel="stylesheet">
    <script src="{{ asset('js/jquery.js')}}"></script>
    <script src="{{ asset('js/alpine.js')}}" defer></script>
    <script src="{{ asset('js/helper.js') }}"></script>
    <script src="{{ asset('js/scroll-reveal.js')}}"></script>
    <meta name="theme-color" content="#6777ef"/>
    <link rel="apple-touch-icon" href="{{ asset('storage/image/logo.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    @yield('head')
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                fontFamily: {
                    sans: ["Roboto", "sans-serif"],
                    body: ["Roboto", "sans-serif"],
                    mono: ["ui-monospace", "monospace"],
                },
            },
            corePlugins: {
                preflight: false,
            },
        };
    </script>
    <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=662fb580a67ccd0019e8e820&product=inline-share-buttons&source=platform" async="async"></script>
    <style>
        .container{
            display: block !important;
            border: none !important;
        }
    </style>
    <meta name="robots" content="index, follow">
    <meta name="revisit-after" content="1 days">
    <meta name="language" content="English">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="en_US">
    <meta property="og:locale:alternate" content="en_US">
    <meta property="og:site_name" content="{{ config('app.name') }}">
</head>

<body>
@include('includes.header')
<main class="mx-auto">
    @yield('content')
    @if(route('view.requirements.form') != request()->url())
        <livewire:requirement/>
    @endif
    <x-news-latter/>
    @include('includes.modals')
    @include('includes.footer')
</main>
@livewireScripts
@filamentScripts
<script src="{{ asset('js/tw-element-min.js') }}"></script>
<script type="text/javascript" src="{{asset('js/toastify.js')}}"></script>
<script src="{{ asset('js/main.js')}}"></script>
<script>
    @if(session()->has('success'))
    showToast('success', '{{session()->get('success')}}');
    @elseif(session()->has('info'))
    showToast('info', '{{session()->get('info')}}');
    @elseif(session()->has('error'))
    showToast('error', '{{session()->get('error')}}');
    @elseif(session()->has('warning'))
    showToast('warning', '{{session()->get('warning')}}');
    @endif
    @if($errors->any())
    @foreach ($errors->all() as $error)
    showToast('error', '{{$error}}');
    @endforeach
    @endif
</script>
<script>
    ScrollReveal().reveal('.reveal', {
        delay: 100,    // Delay in milliseconds
        distance: '30px',  // Animation distance
        origin: 'bottom',  // Animation origin (top, right, bottom, left)
        easing: 'ease-in-out', // Animation easing
        duration: 500,  // Animation duration in milliseconds
        reset: true    // Reset animation on scroll up
    });
</script>
@yield('page-scripts')
@yield('components-scripts')
<script src="{{ asset('/sw.js') }}"></script>
<script>
    if (!navigator.serviceWorker.controller) {
        navigator.serviceWorker.register("/sw.js").then(function (reg) {
            console.log("Service worker has been registered for scope: " + reg.scope);
        });
    }
</script>
<div class="sharethis-sticky-share-buttons"></div>
</body>
</html>
