@extends('admin.layouts.app')

@section('content')
<div class="container">
<h2>Add New Page</h2>

<form action="{{ route('admin.pages.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<label>Page Title</label>
<input type="text" name="title" class="form-control mb-2" required>

<label>Banner Image</label>
<input type="file" name="banner" class="form-control mb-2">

<label>Page Content</label>
<textarea name="content" rows="6" class="form-control"></textarea>

<label>Meta Title</label>
<input type="text" name="meta_title" class="form-control mb-2">

<label>Meta Description</label>
<textarea name="meta_description" rows="3" class="form-control"></textarea>

<label>
    <input type="checkbox" name="status" checked> Publish
</label>

<br><br>
<button class="btn btn-primary">Create Page</button>
</form>

</div>
@endsection
