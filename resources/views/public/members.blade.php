@extends('public.layouts.app')

@section('content')

<div class="container mx-auto py-10 px-4">

<h2 class="text-3xl font-bold text-blue-700 mb-6">Members List</h2>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    @foreach(App\Models\Member::where('status',1)->get() as $m)
    <div class="p-4 bg-white shadow rounded">

        @if($m->photo)
        <img src="{{ asset('storage/'.$m->photo) }}" class="w-full h-40 object-cover rounded">
        @endif

        <h3 class="text-xl mt-2 font-semibold">{{ $m->name }}</h3>

        <p class="text-gray-700">Mobile: {{ $m->mobile }}</p>

        <p class="text-gray-700 font-bold">ID: {{ $m->membership_id }}</p>

    </div>
    @endforeach
</div>

</div>

@endsection
