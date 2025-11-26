@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Create New Form</h2>

    <form action="{{ route('admin.forms.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Form Name</label>
            <input type="text" name="name" class="form-control" required placeholder="Registration Form">
        </div>

        <div class="mb-3">
            <label class="form-label">Slug (URL)</label>
            <input type="text" name="slug" class="form-control" required placeholder="registration">
            <small class="text-muted">Public URL होगा: /form/slug</small>
        </div>

        <div class="mb-3">
            <label class="form-label">Title on Page</label>
            <input type="text" name="title" class="form-control" placeholder="पेज पर ऊपर दिखने वाला टाइटल">
        </div>

        <div class="mb-3">
            <label class="form-label">Description (optional)</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" checked>
            <label class="form-check-label" for="is_active">
                Form Active (Public को दिखे)
            </label>
        </div>

        <button class="btn btn-primary">Save Form</button>
    </form>

</div>
@endsection
