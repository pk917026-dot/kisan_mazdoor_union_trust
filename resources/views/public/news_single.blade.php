@extends('public.layouts.app')

@section('content')

<div class="container mx-auto py-10 px-4">

@if($news->image)
<img src="{{ asset('storage/'.$news->image) }}" class="w-full h-64 object-cover rounded mb-6">
@endif

<h2 class="text-3xl font-bold text-blue-700 mb-4">{{ $news->title }}</h2>

<p class="text-gray-700 leading-relaxed text-lg">
    {!! nl2br(e($news->content)) !!}
</p>

</div>

@endsection
