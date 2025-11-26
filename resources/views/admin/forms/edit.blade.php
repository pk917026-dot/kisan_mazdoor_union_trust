<div class="col-md-4 mb-3">
    <label class="form-label">Step Number</label>
    <select name="step_number" class="form-control">
        <option value="1">Step 1</option>
        <option value="2">Step 2</option>
        <option value="3">Step 3</option>
    </select>
</div>
@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

    <h2 class="mb-4">Edit Form: {{ $form->name }}</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">

        {{-- LEFT: FORM BASIC SETTINGS --}}
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    Form Settings
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.forms.update',$form->id) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Form Name</label>
                            <input type="text" name="name" class="form-control"
                                   value="{{ $form->name }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Slug (URL)</label>
                            <input type="text" name="slug" class="form-control"
                                   value="{{ $form->slug }}">
                            <small class="text-muted">URL: /form/{{ $form->slug }}</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control"
                                   value="{{ $form->title }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" rows="3" class="form-control">{{ $form->description }}</textarea>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="is_active" id="is_active"
                                   {{ $form->is_active ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>

                        <button class="btn btn-primary">Update Form</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- RIGHT: FIELDS BUILDER --}}
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header bg-secondary text-white">
                    Add New Field
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.forms.fields.store',$form->id) }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Label (दिखने वाला नाम)</label>
                                <input type="text" name="label" class="form-control" required placeholder="Full Name">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Field Name (English, no space)</label>
                                <input type="text" name="name" class="form-control" required placeholder="full_name">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Type</label>
                                <select name="type" class="form-control">
                                    <option value="text">Text</option>
                                    <option value="email">Email</option>
                                    <option value="number">Number</option>
                                    <option value="textarea">Textarea</option>
                                    <option value="select">Select</option>
                                    <option value="radio">Radio</option>
                                    <option value="checkbox">Checkbox</option>
                                    <option value="date">Date</option>
                                    <option value="file">File</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Options (अगर select/radio/checkbox हो)</label>
                            <input type="text" name="options" class="form-control" placeholder="Option 1, Option 2, Option 3">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Validation Rules (optional)</label>
                            <input type="text" name="validation_rules" class="form-control" placeholder="required|email|max:255">
                            <small class="text-muted">
                                Laravel validation rules format में। जैसे: <code>required</code>, <code>required|numeric</code>
                            </small>
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" name="is_required" class="form-check-input" id="is_required">
                            <label for="is_required" class="form-check-label">Required Field</label>
                        </div>

                        <button class="btn btn-success">+ Add Field</button>
                    </form>
                </div>
            </div>

            {{-- FIELD LIST --}}
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    Fields (Drag to Reorder – अगर JS लगाओ तो)
                </div>
                <div class="card-body">
                    <ul id="fields-list" class="list-group">
                        @foreach($fields as $field)
                            <li class="list-group-item d-flex justify-content-between align-items-center"
                                data-id="{{ $field->id }}">
                                <div>
                                    <strong>{{ $field->label }}</strong>
                                    <small class="text-muted">({{ $field->name }} – {{ $field->type }})</small><br>
                                    <small class="text-muted">
                                        {{ $field->is_required ? 'Required' : 'Optional' }}
                                        @if($field->validation_rules)
                                            | Rules: {{ $field->validation_rules }}
                                        @endif
                                    </small>
                                </div>
                                <div>
                                    <a href="{{ route('admin.forms.fields.delete',[$form->id,$field->id]) }}"
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Delete this field?')">Delete</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    {{-- अगर sort करना हो तो jQueryUI sortable + AJAX order update use कर सकते हैं, जैसे आपने Menu में किया --}}
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
