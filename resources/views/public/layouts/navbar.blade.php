@php
    $menus = App\Models\Menu::where('parent_id',0)->orderBy('order')->get();
@endphp

<nav class="bg-blue-700 text-white p-3">
    <div class="container mx-auto flex justify-between">

        <a href="/" class="text-xl font-bold">
            {{ App\Models\Setting::first()->trust_name ?? 'My Trust' }}
        </a>

        <ul class="hidden md:flex gap-6">
            @foreach($menus as $menu)
                <li>
                    <a href="{{ $menu->url }}" class="hover:text-yellow-300">
                        {{ $menu->title }}
                    </a>
                </li>
            @endforeach
        </ul>

    </div>
</nav>
