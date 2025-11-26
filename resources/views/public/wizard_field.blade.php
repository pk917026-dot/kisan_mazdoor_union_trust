@php
$name = $field->name;
$value = old($name);
@endphp

<div class="mb-3">
    <label class="form-label">{{ $field->label }}
        @if($field->is_required)
            <span class="text-danger">*</span>
        @endif
    </label>

    @if(in_array($field->type,['text','email','number','date']))
        <input type="{{ $field->type }}"
               name="{{ $name }}" value="{{ $value }}"
               class="form-control">

    @elseif($field->type=='textarea')
        <textarea name="{{ $name }}" class="form-control">{{ $value }}</textarea>

    @elseif($field->type=='select')
        <select name="{{ $name }}" class="form-control">
            <option>-- Select --</option>
            @foreach($field->options as $opt)
                <option value="{{ $opt }}">{{ $opt }}</option>
            @endforeach
        </select>

    @elseif($field->type=='radio')
        @foreach($field->options as $opt)
        <div class="form-check form-check-inline">
            <input type="radio" name="{{ $name }}" value="{{ $opt }}" class="form-check-input">
            <label class="form-check-label">{{ $opt }}</label>
        </div>
        @endforeach

    @elseif($field->type=='checkbox')
        @foreach($field->options as $opt)
        <div class="form-check">
            <input type="checkbox" name="{{ $name }}[]" value="{{ $opt }}" class="form-check-input">
            <label class="form-check-label">{{ $opt }}</label>
        </div>
        @endforeach

    @elseif($field->type=='file')
        <input type="file" name="{{ $name }}" class="form-control">
    @endif

</div>
