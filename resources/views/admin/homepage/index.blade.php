@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

    {{-- PAGE HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Home Page Settings</h2>
        {{-- अगर चाहो तो यहाँ breadcrumb भी रख सकते हो --}}
    </div>

    {{-- FLASH MESSAGES --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <strong>कृपया नीचे दी गई त्रुटियाँ ठीक करें:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- MAIN SETTINGS FORM --}}
    <form action="{{ route('admin.homepage.save') }}" method="POST" class="mb-5">
        @csrf

        <div class="row">

            {{-- LEFT SIDE: TEXT SECTIONS --}}
            <div class="col-lg-8">

                {{-- WELCOME SECTION --}}
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <strong>Welcome Section</strong>
                    </div>
                    <div class="card-body">

                        <div class="mb-3">
                            <label class="form-label">Welcome Title</label>
                            <input type="text"
                                   name="welcome_title"
                                   class="form-control"
                                   value="{{ old('welcome_title', $settings->welcome_title ?? '') }}"
                                   placeholder="उदाहरण: किसान मजदूर यूनियन ट्रस्ट में आपका स्वागत है">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Welcome Description</label>
                            <textarea name="welcome_description"
                                      rows="4"
                                      class="form-control"
                                      placeholder="होम पेज पर दिखने वाला छोटा परिचय...">{{ old('welcome_description', $settings->welcome_description ?? '') }}</textarea>
                        </div>

                    </div>
                </div>

                {{-- ABOUT SECTION --}}
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <strong>About Section</strong>
                    </div>
                    <div class="card-body">

                        <div class="mb-3">
                            <label class="form-label">About Title</label>
                            <input type="text"
                                   name="about_title"
                                   class="form-control"
                                   value="{{ old('about_title', $settings->about_title ?? '') }}"
                                   placeholder="उदाहरण: हमारे बारे में">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">About Short Description</label>
                            <textarea name="about_description"
                                      rows="4"
                                      class="form-control"
                                      placeholder="संक्षिप्त विवरण जो होम पेज पर दिखेगा...">{{ old('about_description', $settings->about_description ?? '') }}</textarea>
                        </div>

                    </div>
                </div>

                {{-- MARQUEE / RUNNING TEXT --}}
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <strong>Running Text / Marquee</strong>
                    </div>
                    <div class="card-body">

                        <div class="mb-3">
                            <label class="form-label">Marquee Text (होम पेज पर चलती हुई लाइन)</label>
                            <input type="text"
                                   name="marquee_text"
                                   class="form-control"
                                   value="{{ old('marquee_text', $settings->marquee_text ?? '') }}"
                                   placeholder="महत्वपूर्ण सूचना, नोटिस आदि यहाँ लिखें">
                            <small class="text-muted">
                                यह टेक्स्ट होम पेज पर scrolling marquee में दिखेगा।
                            </small>
                        </div>

                    </div>
                </div>

                {{-- VIDEO SECTION --}}
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <strong>Intro Video Section</strong>
                    </div>
                    <div class="card-body">

                        <div class="mb-3">
                            <label class="form-label">YouTube Video URL</label>
                            <input type="text"
                                   name="video_url"
                                   class="form-control"
                                   value="{{ old('video_url', $settings->video_url ?? '') }}"
                                   placeholder="https://www.youtube.com/embed/आपका-वीडियो">
                            <small class="text-muted">
                                Embed URL दीजिए (जैसे: https://www.youtube.com/embed/abcd1234)
                            </small>
                        </div>

                    </div>
                </div>

            </div>

            {{-- RIGHT SIDE: TOGGLES / SWITCHES --}}
            <div class="col-lg-4">

                <div class="card mb-4">
                    <div class="card-header bg-secondary text-white">
                        <strong>Sections ON / OFF</strong>
                    </div>
                    <div class="card-body">

                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input"
                                   type="checkbox"
                                   id="show_slider"
                                   name="show_slider"
                                   {{ isset($settings->show_slider) ? ($settings->show_slider ? 'checked' : '') : 'checked' }}>
                            <label class="form-check-label" for="show_slider">Show Slider</label>
                        </div>

                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input"
                                   type="checkbox"
                                   id="show_about"
                                   name="show_about"
                                   {{ isset($settings->show_about) ? ($settings->show_about ? 'checked' : '') : 'checked' }}>
                            <label class="form-check-label" for="show_about">Show About Section</label>
                        </div>

                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input"
                                   type="checkbox"
                                   id="show_notice"
                                   name="show_notice"
                                   {{ isset($settings->show_notice) ? ($settings->show_notice ? 'checked' : '') : 'checked' }}>
                            <label class="form-check-label" for="show_notice">Show Notice/Marquee Section</label>
                        </div>

                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input"
                                   type="checkbox"
                                   id="show_video"
                                   name="show_video"
                                   {{ isset($settings->show_video) ? ($settings->show_video ? 'checked' : '') : 'checked' }}>
                            <label class="form-check-label" for="show_video">Show Video Section</label>
                        </div>

                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input"
                                   type="checkbox"
                                   id="show_gallery"
                                   name="show_gallery"
                                   {{ isset($settings->show_gallery) ? ($settings->show_gallery ? 'checked' : '') : 'checked' }}>
                            <label class="form-check-label" for="show_gallery">Show Gallery Preview</label>
                        </div>

                    </div>
                </div>

                {{-- SAVE BUTTON CARD --}}
                <div class="card">
                    <div class="card-body text-center">
                        <button type="submit" class="btn btn-primary w-100">
                            Save Home Page Settings
                        </button>
                        <small class="d-block mt-2 text-muted">
                            बदलाव तुरंत public होम पेज पर लागू हो जाएंगे।
                        </small>
                    </div>
                </div>

            </div>

        </div> {{-- row end --}}
    </form>

    {{-- ===================== SLIDER MANAGEMENT SECTION ===================== --}}

    <hr class="mb-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Slider Images</h3>
    </div>

    {{-- ADD SLIDER FORM --}}
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <strong>Add New Slider Image</strong>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.slider.add') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Slider Image <span class="text-danger">*</span></label>
                        <input type="file" name="image" class="form-control" required>
                        <small class="text-muted">Recommended size: 1600x500 px (approx).</small>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Slider Title (optional)</label>
                        <input type="text" name="title" class="form-control" placeholder="मुख्य शीर्षक">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Slider Subtitle (optional)</label>
                        <input type="text" name="subtitle" class="form-control" placeholder="उप-शीर्षक / विवरण">
                    </div>
                </div>

                <button class="btn btn-success">
                    + Add Slider
                </button>
            </form>
        </div>
    </div>

    {{-- EXISTING SLIDERS GRID --}}
    <div class="row">
        @forelse($sliders as $slider)
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card h-100">

                    @if($slider->image)
                        <img src="{{ asset('storage/'.$slider->image) }}"
                             class="card-img-top"
                             style="height: 180px; object-fit: cover;">
                    @endif

                    <div class="card-body">
                        @if($slider->title)
                            <h5 class="card-title mb-1">{{ $slider->title }}</h5>
                        @endif

                        @if($slider->subtitle)
                            <p class="card-text text-muted mb-2">{{ $slider->subtitle }}</p>
                        @endif

                        <p class="small text-muted mb-0">
                            Order: {{ $slider->order }}
                        </p>
                    </div>

                    <div class="card-footer text-end">
                        <a href="{{ route('admin.slider.delete', $slider->id) }}"
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('क्या आप वाकई यह स्लाइडर हटाना चाहते हैं?')">
                            Delete
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    अभी तक कोई slider image नहीं जोड़ी गई है।
                </div>
            </div>
        @endforelse
    </div>

</div> {{-- container-fluid --}}
@endsection
