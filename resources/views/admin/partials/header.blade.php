<nav class="topbar d-flex justify-content-between align-items-center px-3 py-2 mb-3">
    <div>
        <h4 class="mb-0">@yield('page-title','Dashboard')</h4>
        <small class="text-muted">
            Welcome, {{ auth()->guard('admin')->user()->name ?? 'Admin' }}
        </small>
    </div>
    <div>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button class="btn btn-outline-secondary btn-sm">Logout</button>
        </form>
    </div>
</nav>
