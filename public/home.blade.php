@extends('public.layouts.app')

@section('content')

@php
    $settings = App\Models\Setting::first();
    $home = App\Models\HomepageSetting::first();
    $sliders = App\Models\Slider::orderBy('order')->get();
@endphp

{{-- HERO SLIDER --}}
@if($home && $home->show_slider)
<div class="relative w-full overflow-hidden">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            @foreach($sliders as $slider)
            <div class="swiper-slide">
                <img src="{{ asset('storage/'.$slider->image) }}"
                     class="w-full h-72 md:h-96 object-cover">
                <div class="absolute bottom-6 left-6 bg-black bg-opacity-50 text-white p-4 rounded">
                    <h2 class="text-2xl font-bold">{{ $slider->title }}</h2>
                    <p>{{ $slider->subtitle }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif


{{-- MARQUEE --}}
@if($home && $home->marquee_text)
<div class="bg-yellow-300 py-2 text-black font-semibold text-lg overflow-hidden whitespace-nowrap">
    <marquee>{{ $home->marquee_text }}</marquee>
</div>
@endif


{{-- WELCOME SECTION --}}
<div class="container mx-auto py-10 px-4">
    <h2 class="text-3xl font-bold text-center text-blue-700">
        {{ $home->welcome_title ?? 'Welcome to Kisan Majdur Union Trust' }}
    </h2>

    <p class="text-gray-700 text-center mt-4 leading-relaxed max-w-2xl mx-auto">
        {{ $home->welcome_description ??
            'This is a dynamic homepage. All content is editable from Admin Panel.' }}
    </p>
</div>


{{-- ABOUT SECTION --}}
@if($home && $home->show_about)
<div class="bg-gray-100 py-12">
    <div class="container mx-auto px-4 md:px-10">
        <h2 class="text-3xl font-bold mb-4 text-blue-600">
            {{ $home->about_title ?? 'About Us' }}
        </h2>

        <p class="text-gray-800 leading-relaxed text-lg">
            {{ $home->about_description ??
                'This section is fully dynamic. You can update it from Admin Panel.' }}
        </p>
    </div>
</div>
@endif


{{-- VIDEO SECTION --}}
@if($home && $home->show_video && $home->video_url)
<div class="container mx-auto py-10 px-4">
    <h2 class="text-2xl font-bold text-blue-700 mb-4">Our Intro Video</h2>

    <iframe class="w-full h-64 md:h-96 rounded-lg shadow-lg"
        src="{{ $home->video_url }}"
        frameborder="0"
        allowfullscreen>
    </iframe>
</div>
@endif


{{-- GALLERY PREVIEW --}}
@if($home && $home->show_gallery)
<div class="container mx-auto py-10 px-4">
    <h2 class="text-2xl font-bold text-blue-700 mb-4">Gallery</h2>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
        @foreach(App\Models\Gallery::take(4)->get() as $image)
        <img src="{{ asset('storage/'.$image->image) }}"
             class="rounded shadow-md h-40 w-full object-cover">
        @endforeach
    </div>

    <a href="{{ url('/gallery') }}"
       class="mt-4 inline-block text-blue-600 underline font-medium">
       View Full Gallery →
    </a>
</div>
@endif


{{-- CONTACT SECTION --}}
<div class="bg-blue-50 py-10 mt-10">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold text-blue-700 mb-3">Contact Us</h2>

        <p class="text-gray-700">
            {{ $settings->address ?? '' }}
        </p>

        <p class="text-gray-700 mt-2">
            <strong>Phone:</strong> {{ $settings->contact_number ?? '' }}
        </p>

        <p class="text-gray-700 mt-2">
            <strong>Email:</strong> {{ $settings->email ?? '' }}
        </p>
    </div>
</div>


@endsection
