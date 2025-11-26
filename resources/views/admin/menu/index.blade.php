@extends('admin.layouts.app')

@section('content')
<div class="container">

    <h2 class="mb-4">Menu Builder</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- ADD MENU --}}
    <div class="card p-3 mb-4">
        <form action="{{ route('admin.menu.store') }}" method="POST">
            @csrf

            <label>Menu Title</label>
            <input type="text" class="form-control mb-2" name="title" required>

            <label>Menu Link (URL)</label>
            <input type="text" class="form-control mb-2" name="url" placeholder="/about or https://">

            <label>Parent Menu (Dropdown)</label>
            <select name="parent_id" class="form-control mb-3">
                <option value="0">Main Menu</option>
                @foreach($menus as $m)
                    <option value="{{ $m->id }}">{{ $m->title }}</option>
                @endforeach
            </select>

            <button class="btn btn-primary">Add Menu</button>
        </form>
    </div>

    {{-- MENU LIST FOR ORDER + DELETE --}}
    <div class="card p-3">
        <h4>Menu Items</h4>

        <ul id="menu-list">
            @foreach($menus as $menu)
            <li class="p-2 border mb-2 bg-light" data-id="{{ $menu->id }}">
                {{ $menu->title }} — <a href="{{ $menu->url }}" target="_blank">{{ $menu->url }}</a>

                <a href="{{ route('admin.menu.delete',$menu->id) }}"
                   class="btn btn-danger btn-sm float-end"
                   onclick="return confirm('Delete menu?')">Delete</a>
            </li>
            @endforeach
        </ul>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script>
    $('#menu-list').sortable({
        update: function(event, ui) {
            var orders = {};
            $('#menu-list li').each(function(index) {
                orders[$(this).data('id')] = index+1;
            });

            $.post("{{ route('admin.menu.order') }}", {
                _token: "{{ csrf_token() }}",
                order: orders
            });
        }
    });
</script>

@endsection
