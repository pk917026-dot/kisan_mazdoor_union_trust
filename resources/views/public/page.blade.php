@extends('public.layouts.app')

@section('content')

<div class="w-full">
    @if($page->banner)
    <img src="{{ asset('storage/'.$page->banner) }}" class="w-full h-64 object-cover">
    @endif
</div>

<div class="container mx-auto py-10 px-4">

    <h2 class="text-3xl font-bold text-blue-700 mb-4">{{ $page->title }}</h2>

    <div class="text-gray-800 leading-relaxed text-lg">
        {!! nl2br(e($page->content)) !!}
    </div>

</div>

@endsection
