@extends('public.layouts.app')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-lg border-0 mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fa fa-file-text"></i> Claim / सहयता आवेदन फ़ॉर्म</h4>
                </div>

                <div class="card-body">

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <strong>कृपया नीचे दी गई त्रुटियाँ ठीक करें:</strong>
                            <ul class="mt-2 mb-0">
                                @foreach($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('public.form.submit',$form->slug) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @foreach($fields as $field)
                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                {{ $field->label }}
                                @if($field->is_required)
                                    <span class="text-danger">*</span>
                                @endif
                            </label>

                            @php
                                $name = $field->name;
                                $oldValue = old($name);
                            @endphp

                            {{-- TEXT / EMAIL / NUMBER --}}
                            @if(in_array($field->type, ['text','email','number','date']))
                                <input type="{{ $field->type }}" 
                                       name="{{ $name }}"
                                       value="{{ $oldValue }}"
                                       class="form-control">

                            {{-- TEXTAREA --}}
                            @elseif($field->type == 'textarea')
                                <textarea name="{{ $name }}" rows="3" class="form-control">{{ $oldValue }}</textarea>

                            {{-- SELECT --}}
                            @elseif($field->type == 'select')
                                <select name="{{ $name }}" class="form-control">
                                    <option value="">— Select —</option>
                                    @foreach($field->options as $opt)
                                        <option value="{{ $opt }}" {{ $oldValue==$opt?'selected':'' }}>
                                            {{ $opt }}
                                        </option>
                                    @endforeach
                                </select>

                            {{-- RADIO --}}
                            @elseif($field->type == 'radio')
                                @foreach($field->options as $opt)
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input"
                                               name="{{ $name }}" value="{{ $opt }}"
                                               {{ $oldValue==$opt?'checked':'' }}>
                                        <label class="form-check-label">{{ $opt }}</label>
                                    </div>
                                @endforeach

                            {{-- CHECKBOX --}}
                            @elseif($field->type == 'checkbox')
                                @foreach($field->options as $opt)
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input"
                                               name="{{ $name }}[]" value="{{ $opt }}"
                                               @if(is_array($oldValue) && in_array($opt,$oldValue)) checked @endif>
                                        <label class="form-check-label">{{ $opt }}</label>
                                    </div>
                                @endforeach

                            {{-- FILE --}}
                            @elseif($field->type == 'file')
                                <input type="file" name="{{ $name }}" class="form-control">

                            @endif

                        </div>
                        @endforeach

                        <button class="btn btn-primary px-4">
                            <i class="fa fa-send"></i> Submit Claim
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

@endsection
