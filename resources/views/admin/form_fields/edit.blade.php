{{-- resources/views/admin/form_fields/edit.blade.php --}}
@extends('admin.layouts.app')

@section('page-title','फ़ील्ड एडिट करें')

@section('content')
<div class="card p-3">
    <h4 class="mb-3">Field Edit करें (ID: {{ $field->id }})</h4>

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

    <form method="POST" action="{{ route('admin.form_fields.update', $field->id) }}">
        @csrf

        {{-- LABEL --}}
        <div class="mb-3">
            <label class="form-label">Label (फील्ड का नाम)</label>
            <input type="text" name="label" class="form-control"
                   value="{{ old('label', $field->label) }}" required>
        </div>

        {{-- NAME --}}
        <div class="mb-3">
            <label class="form-label">
                Name (केवल english, छोटा नाम – फॉर्म के अंदर use होगा)
            </label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name', $field->name) }}" required>
            <small class="text-muted">
                ध्यान रखें: नाम बदलने से जुड़ी values भी अलग मानी जाएँगी।
            </small>
        </div>

        {{-- TYPE --}}
        <div class="mb-3">
            <label class="form-label">Field Type</label>
            @php
                $types = ['text','number','textarea','select','radio','date','email','phone'];
            @endphp
            <select name="type" class="form-select" required>
                @foreach($types as $t)
                    <option value="{{ $t }}" {{ old('type', $field->type) == $t ? 'selected' : '' }}>
                        {{ strtoupper($t) }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- SECTION --}}
        <div class="mb-3">
            <label class="form-label">Section (फॉर्म का भाग)</label>
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

            <select name="section" class="form-select">
                <option value="">(कोई नहीं)</option>
                @foreach($sections as $key => $label)
                    <option value="{{ $key }}" {{ old('section', $field->section) == $key ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- OPTIONS --}}
        <div class="mb-3">
            <label class="form-label">
                Options (select/radio के लिए, कॉमा से अलग–अलग)
            </label>
            <textarea name="options_text" class="form-control" rows="2">{{ old('options_text', $field->options_text) }}</textarea>
        </div>

        {{-- SORT ORDER --}}
        <div class="mb-3">
            <label class="form-label">Sort Order</label>
            <input type="number" name="sort_order" class="form-control"
                   value="{{ old('sort_order', $field->sort_order) }}">
        </div>

        {{-- REQUIRED --}}
        <div class="mb-3 form-check">
            <input type="checkbox" name="is_required" value="1" class="form-check-input"
                   id="is_required"
                   {{ old('is_required', $field->is_required) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_required">Required (ज़रूरी)</label>
        </div>

        {{-- ACTIVE --}}
        <div class="mb-3 form-check">
            <input type="checkbox" name="is_active" value="1" class="form-check-input"
                   id="is_active"
                   {{ old('is_active', $field->is_active) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Active (फॉर्म में दिखे)</label>
        </div>

        <button class="btn btn-primary">Update Field</button>
        <a href="{{ route('admin.form_fields.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
