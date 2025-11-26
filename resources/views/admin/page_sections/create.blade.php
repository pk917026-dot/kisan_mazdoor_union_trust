@extends('admin.layouts.app')

@section('content')
    <h1>Create New Section</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Error!</strong> कृपया form ठीक से भरें।
        </div>
    @endif

    <form action="{{ route('admin.page-sections.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Page</label>
            <select name="page" class="form-control" required>
                <option value="home">Home</option>
                <option value="menu">Menu</option>
                <option value="about">About</option>
                <option value="contact">Contact</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Section Key (e.g. hero, slider, info_block)</label>
            <input type="text" name="section_key" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control">
        </div>

        <div class="mb-3">
            <label>Content</label>
            <textarea name="content" rows="4" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Button Text</label>
            <input type="text" name="button_text" class="form-control">
        </div>

        <div class="mb-3">
            <label>Button URL</label>
            <input type="text" name="button_url" class="form-control" placeholder="/member/register">
        </div>

        <div class="mb-3">
            <label>Icon class (optional)</label>
            <input type="text" name="icon" class="form-control" placeholder="fa fa-user">
        </div>

        <div class="mb-3">
            <label>Image (optional)</label>
            <input type="file" name="image" class="form-control">
            <small class="text-muted">JPEG, PNG, WEBP Allowed (Max: 2MB)</small>
        </div>

        <div class="mb-3">
            <label>Sort Order</label>
            <input type="number" name="sort_order" class="form-control" value="0">
        </div>

        <div class="mb-3">
            <label>
                <input type="checkbox" name="is_active" checked> Active
            </label>
        </div>

        <button type="submit" class="btn btn-primary">Save Section</button>
    </form>
@endsection
