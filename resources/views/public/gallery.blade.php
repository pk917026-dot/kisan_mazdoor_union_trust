@extends('public.layouts.app')

@section('content')

<div class="container mx-auto py-10 px-4">

    <h2 class="text-3xl font-bold text-blue-700 mb-6">Photo Gallery</h2>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach(App\Models\Gallery::orderBy('id','DESC')->get() as $img)
            <div class="shadow rounded overflow-hidden">
                <img src="{{ asset('storage/'.$img->image) }}"
                     class="w-full h-48 object-cover">
                @if($img->title)
                <p class="text-center text-gray-700 py-2">{{ $img->title }}</p>
                @endif
            </div>
        @endforeach
    </div>

</div>
@endsection
