<!doctype html>
<html lang="hi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('page-title','Admin') - Kisan Mazdoor Union</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background:#f7f6f3; }
        .sidebar { background: #2b5d34; color: #fff; min-height:100vh; }
        .sidebar a { color: #e6f5ea; text-decoration:none; display:block; padding:.35rem .75rem; border-radius:.35rem;}
        .sidebar a:hover { background: rgba(255,255,255,0.1); }
        .brand { padding:1rem; font-weight:700; font-size:1.1rem; }
        .topbar { background:#fff; box-shadow:0 1px 3px rgba(0,0,0,0.06); }
    </style>
    @stack('styles')
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 sidebar d-none d-md-block">
            <div class="brand">Kisan Mazdoor Union</div>
            @include('admin.partials.sidebar')
        </nav>

        <main class="col-md-10 ms-sm-auto px-4">
            @include('admin.partials.header')

            <div class="py-4">
                @yield('content')
            </div>
        </main>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
