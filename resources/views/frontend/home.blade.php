@extends('frontend.layouts.app')

@section('content')

{{-- Hero Section --}}
@if($hero)
    <section class="p-5 mb-4 bg-light rounded-3 text-center">
        <h1 class="display-5 fw-bold">{{ $hero->title }}</h1>
        <p class="lead">{!! nl2br(e($hero->content)) !!}</p>

        @if($hero->button_text && $hero->button_url)
            <a href="{{ $hero->button_url }}" class="btn btn-primary btn-lg">
                {{ $hero->button_text }}
            </a>
        @endif

        @if($hero->image)
            <div class="mt-3">
                <img src="{{ asset('storage/' . $hero->image) }}" width="60%" class="img-fluid rounded">
            </div>
        @endif
    </section>
@endif


{{-- Slider --}}
@if($sliders->count())
<div id="sliderHome" class="carousel slide mb-4" data-bs-ride="carousel">
    <div class="carousel-inner">

        @foreach($sliders as $index=>$slide)
            <div class="carousel-item {{ $index==0?'active':'' }}">
                @if($slide->image)
                    <img src="{{ asset('storage/' . $slide->image) }}"
                         class="d-block w-100" style="max-height:500px;object-fit:cover;">
                @endif

                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 p-3 rounded">
                    <h5>{{ $slide->title }}</h5>
                    <p>{!! nl2br(e($slide->content)) !!}</p>
                </div>
            </div>
        @endforeach

    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#sliderHome" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#sliderHome" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>
@endif


{{-- Info Blocks --}}
<div class="row">
@foreach($infoBlocks as $block)
    <div class="col-md-4 mb-3">
        <div class="card h-100">

            @if($block->image)
                <img src="{{ asset('storage/' . $block->image) }}"
                     class="card-img-top" style="max-height:200px;object-fit:cover;">
            @endif

            <div class="card-body">
                <h5 class="card-title">{{ $block->title }}</h5>
                <p class="card-text">{!! nl2br(e($block->content)) !!}</p>

                @if($block->button_text && $block->button_url)
                    <a href="{{ $block->button_url }}" class="btn btn-outline-primary btn-sm">
                        {{ $block->button_text }}
                    </a>
                @endif
            </div>
        </div>
    </div>
@endforeach
</div>

@endsection
