{{-- resources/views/member/register.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-3">सदस्य रजिस्ट्रेशन फॉर्म</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('member.register.submit') }}">
        @csrf

        @foreach($fields as $section => $sectionFields)
            <h4 class="mt-4">{{ $section ?: 'Details' }}</h4>
            <hr>

            @foreach($sectionFields as $field)
                <div class="mb-3">
                    <label class="form-label">
                        {{ $field->label }}
                        @if($field->is_required)
                            <span class="text-danger">*</span>
                        @endif
                    </label>

                    @php
                        $name  = $field->name;
                        $type  = $field->type;
                        $value = old($name);
                    @endphp

                    @if(in_array($type, ['text','email','phone','number','date']))
                        <input
                            type="{{ $type == 'phone' ? 'text' : $type }}"
                            name="{{ $name }}"
                            value="{{ $value }}"
                            class="form-control">
                    @elseif($type === 'textarea')
                        <textarea name="{{ $name }}" class="form-control">{{ $value }}</textarea>
                    @elseif($type === 'select')
                        <select name="{{ $name }}" class="form-select">
                            <option value="">-- चुनें --</option>
                            @foreach($field->optionsArray() as $option)
                                <option value="{{ $option }}" {{ $value == $option ? 'selected' : '' }}>
                                    {{ $option }}
                                </option>
                            @endforeach
                        </select>
                    @elseif($type === 'radio')
                        <div>
                            @foreach($field->optionsArray() as $option)
                                <label class="me-3">
                                    <input type="radio" name="{{ $name }}" value="{{ $option }}"
                                           {{ $value == $option ? 'checked' : '' }}>
                                    {{ $option }}
                                </label>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        @endforeach

        <button type="submit" class="btn btn-success">रजिस्ट्रेशन सबमिट करें</button>
    </form>
</div>
@endsection
