{{-- resources/views/admin/form_fields/create.blade.php --}}
@extends('admin.layouts.app')

@section('page-title','नया फ़ील्ड बनाएँ')

@section('content')
<div class="card p-3">
    <h4 class="mb-3">नया Registration Field बनाएँ</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>कृपया नीचे दी गयी गलतियाँ ठीक करें:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.form_fields.store') }}">
        @csrf

        {{-- LABEL (फ्रंट पर जो नाम दिखेगा) --}}
        <div class="mb-3">
            <label class="form-label">Label (फील्ड का नाम)</label>
            <input type="text" name="label" class="form-control"
                   value="{{ old('label') }}" placeholder="जैसे: सदस्य का नाम" required>
        </div>

        {{-- NAME (अंदर वाला key, english में) --}}
        <div class="mb-3">
            <label class="form-label">
                Name (केवल english, छोटा नाम – फॉर्म के अंदर use होगा)
            </label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name') }}" placeholder="जैसे: member_name" required>
            <small class="text-muted">
                यह नाम database और code में use होगा। सिर्फ छोटे english letters, number, _ या - रखें।
            </small>
        </div>

        {{-- TYPE --}}
        <div class="mb-3">
            <label class="form-label">Field Type</label>
            <select name="type" class="form-select" required>
                @php
                    $types = ['text','number','textarea','select','radio','date','email','phone'];
                @endphp
                @foreach($types as $t)
                    <option value="{{ $t }}" {{ old('type') == $t ? 'selected' : '' }}>
                        {{ strtoupper($t) }}
                    </option>
                @endforeach
            </select>
            <small class="text-muted">
                text = साधारण इनपुट, select = dropdown, radio = रेडियो बटन, textarea = बड़ा टेक्स्ट बॉक्स, आदि।
            </small>
        </div>

        {{-- SECTION (फॉर्म में किस सेक्शन में दिखेगा) --}}
        <div class="mb-3">
            <label class="form-label">Section (फॉर्म का भाग)</label>
            <select name="section" class="form-select">
                @php
                    $sections = [
                        'Personal'        => 'Personal Details',
                        'Home Address'    => 'Home Address',
                        'Workplace'       => 'Workplace Address',
                        'Nominee 1'       => 'Nominee Details 1',
                        'Nominee 2'       => 'Nominee Details 2',
                        'Other'           => 'Other'
                    ];
                @endphp

                <option value="">(कोई नहीं)</option>
                @foreach($sections as $key => $label)
                    <option value="{{ $key }}" {{ old('section') == $key ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
            <small class="text-muted">
                इससे यह तय होगा कि यह field फॉर्म के किस हिस्से में दिखेगा।
            </small>
        </div>

        {{-- OPTIONS (select / radio के लिए) --}}
        <div class="mb-3">
            <label class="form-label">
                Options (केवल select/radio के लिए, कॉमा से अलग–अलग लिखें)
            </label>
            <textarea name="options_text" class="form-control" rows="2"
                      placeholder="उदाहरण: पुरुष, महिला, अन्य">{{ old('options_text') }}</textarea>
            <small class="text-muted">
                केवल select या radio type के लिए।  
                जैसे Gender के लिए: पुरुष, महिला, अन्य
            </small>
        </div>

        {{-- SORT ORDER --}}
        <div class="mb-3">
            <label class="form-label">Sort Order (छोटा नंबर = ऊपर दिखेगा)</label>
            <input type="number" name="sort_order" class="form-control"
                   value="{{ old('sort_order', 0) }}">
        </div>

        {{-- REQUIRED / ACTIVE --}}
        <div class="mb-3 form-check">
            <input type="checkbox" name="is_required" value="1" class="form-check-input"
                   id="is_required"
                   {{ old('is_required') ? 'checked' : '' }}>
            <label class="form-check-label" for="is_required">Required Field (ज़रूरी)</label>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="is_active" value="1" class="form-check-input"
                   id="is_active"
                   {{ old('is_active', 1) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Active (फॉर्म में दिखे)</label>
        </div>

        <button class="btn btn-primary">Save Field</button>
        <a href="{{ route('admin.form_fields.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
