@extends('admin.layouts.app')

@section('content')
    <h1>Edit Section</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Error!</strong> कृपया form ठीक से भरें।
        </div>
    @endif

    <form action="{{ route('admin.page-sections.update', $pageSection->id) }}" 
          method="POST" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Page</label>
            <select name="page" class="form-control" required>
                <option value="home" {{ $pageSection->page=='home'?'selected':'' }}>Home</option>
                <option value="menu" {{ $pageSection->page=='menu'?'selected':'' }}>Menu</option>
                <option value="about" {{ $pageSection->page=='about'?'selected':'' }}>About</option>
                <option value="contact" {{ $pageSection->page=='contact'?'selected':'' }}>Contact</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Section Key</label>
            <input type="text" name="section_key" class="form-control"
                   value="{{ $pageSection->section_key }}" required>
        </div>

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" value="{{ $pageSection->title }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Content</label>
            <textarea name="content" rows="4" class="form-control">{{ $pageSection->content }}</textarea>
        </div>

        <div class="mb-3">
            <label>Button Text</label>
            <input type="text" name="button_text" value="{{ $pageSection->button_text }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Button URL</label>
            <input type="text" name="button_url" value="{{ $pageSection->button_url }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Icon</label>
            <input type="text" name="icon" class="form-control" value="{{ $pageSection->icon }}">
        </div>

        <div class="mb-3">
            <label>New Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        @if($pageSection->image)
            <div class="mb-3">
                <label>Old Image:</label><br>
                <img src="{{ asset('storage/' . $pageSection->image) }}" 
                     width="180" class="img-thumbnail mt-2">
            </div>
        @endif

        <div class="mb-3">
            <label>Sort Order</label>
            <input type="number" name="sort_order" class="form-control"
                   value="{{ $pageSection->sort_order }}">
        </div>

        <div class="mb-3">
            <label>
                <input type="checkbox" name="is_active" {{ $pageSection->is_active?'checked':'' }}>
                Active
            </label>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
@endsection
