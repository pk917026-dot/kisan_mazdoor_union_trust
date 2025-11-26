<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $siteTitle ?? 'Kisan Mazdoor Union Trust' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

@php
    use App\Models\PageSection;
    $menuLinks = PageSection::where('page', 'menu')
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->get();
@endphp

<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ $siteTitle ?? 'Kisan Mazdoor Union Trust' }}
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto">
                @foreach($menuLinks as $item)
                    <li class="nav-item">
                        <a class="nav-link"
                           href="{{ $item->button_url ?? '#' }}">{{ $item->title }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>

<main class="container">
    @yield('content')
</main>

<footer class="bg-dark text-white mt-5 p-3 text-center">
    {{ $footerText ?? '© '.date('Y').' Kisan Mazdoor Union Trust' }}
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
