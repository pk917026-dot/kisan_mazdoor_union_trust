@extends('public.layouts.app')

@section('content')

<div class="container mx-auto py-10 px-4">

    <h2 class="text-3xl font-bold text-blue-700 mb-2">
        {{ $form->title ?? $form->name }}
    </h2>

    @if($form->description)
        <p class="text-gray-700 mb-6">
            {{ $form->description }}
        </p>
    @endif

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li class="text-sm">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('public.form.submit',$form->slug) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow rounded p-6">
        @csrf

        @foreach($fields as $field)
            <div class="mb-4">
                <label class="block mb-1 font-semibold">
                    {{ $field->label }}
                    @if($field->is_required)
                        <span class="text-red-500">*</span>
                    @endif
                </label>

                @php
                    $name = $field->name;
                    $old = old($name);
                @endphp

                @if($field->type === 'text' || $field->type === 'email' || $field->type === 'number' || $field->type === 'date')
                    <input
                        type="{{ $field->type }}"
                        name="{{ $name }}"
                        value="{{ $old }}"
                        class="border rounded w-full px-3 py-2">
                @elseif($field->type === 'textarea')
                    <textarea name="{{ $name }}" rows="3" class="border rounded w-full px-3 py-2">{{ $old }}</textarea>

                @elseif($field->type === 'select')
                    <select name="{{ $name }}" class="border rounded w-full px-3 py-2">
                        <option value="">-- चुनें --</option>
                        @foreach($field->options ?? [] as $opt)
                            <option value="{{ $opt }}" {{ $old == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                        @endforeach
                    </select>

                @elseif($field->type === 'radio')
                    @foreach($field->options ?? [] as $opt)
                        <label class="inline-flex items-center mr-4">
                            <input type="radio" name="{{ $name }}" value="{{ $opt }}" {{ $old == $opt ? 'checked' : '' }}>
                            <span class="ml-1">{{ $opt }}</span>
                        </label>
                    @endforeach

                @elseif($field->type === 'checkbox')
                    @foreach($field->options ?? [] as $opt)
                        <label class="inline-flex items-center mr-4">
                            <input type="checkbox" name="{{ $name }}[]" value="{{ $opt }}"
                                   @if(is_array($old) && in_array($opt,$old)) checked @endif>
                            <span class="ml-1">{{ $opt }}</span>
                        </label>
                    @endforeach

                @elseif($field->type === 'file')
                    <input type="file" name="{{ $name }}" class="border rounded w-full px-3 py-2">
                @endif
            </div>
        @endforeach

        <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">
            Submit
        </button>
    </form>

</div>
@endsection
