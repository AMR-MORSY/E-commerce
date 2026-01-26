@props(['title', 'description', 'image' => null, 'canonical' => null, 'keywords' => null, 'type' => 'website'])


<title>{{ $title }} - {{ config('app.name') }}</title>
<meta name="description" content="{{ $description }}">
@if ($keywords)
    <meta name="keywords" content="{{ $keywords }}">
@endif

@if ($canonical)
    <link rel="canonical" href="{{ $canonical }}">
@endif

<!-- Open Graph -->
<meta property="og:type" content="{{ $type }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:site_name" content="{{ config('app.name') }}">
@if($image)
    <meta property="og:image" content="{{ $image }}">
@endif
@if($canonical)
    <meta property="og:url" content="{{ $canonical }}">
@endif

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
@if($image)
    <meta name="twitter:image" content="{{ $image }}">
@endif