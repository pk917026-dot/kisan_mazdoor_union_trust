@extends('public.layouts.app')

@section('content')

<div class="container mx-auto py-10 px-4">

<h2 class="text-3xl font-bold mb-6 text-blue-700">Latest News</h2>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">

@foreach(App\Models\News::where('status',1)->get() as $n)
    <div class="bg-white shadow rounded p-3">

        @if($n->image)
        <img src="{{ asset('storage/'.$n->image) }}" class="h-40 w-full object-cover rounded">
        @endif

        <h3 class="text-xl font-semibold mt-2">{{ $n->title }}</h3>

        <p class="text-gray-700 mt-2">{{ $n->short_description }}</p>

        <a href="/news/{{ $n->slug }}" class="text-blue-600 underline mt-3 inline-block">Read More</a>
    </div>
@endforeach

</div>

</div>

@endsection
