@props(['modal'])
@props(['title'])

@if ($modal)
    <title>{{ $modal?->$title }}</title>
    <meta name="description" content="{{ $modal?->seo?->meta_description }}">
    <meta name="keywords" content="{{ implode(',', $modal?->seo?->meta_keywords ?? []) }}">
    <meta name="author" content="{{ $modal?->user?->name }}">
    <meta name="web_author" content="{{ $modal?->user?->name }}">
    <meta property="og:title" content="{{ $modal->seo?->title }}">
    <meta property="og:description" content="{{ $modal->seo?->description }}">
    <meta property="og:url" content="{{ route('view.company', [$modal?->slug??'']) }}">
@endif

