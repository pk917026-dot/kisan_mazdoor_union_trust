@extends('admin.layouts.app')

@section('content')
<div class="container">

<h2>Add News</h2>

<form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<label>Title</label>
<input type="text" name="title" class="form-control mb-2" required>

<label>Image</label>
<input type="file" name="image" class="form-control mb-2">

<label>Short Description</label>
<textarea name="short_description" rows="3" class="form-control mb-2"></textarea>

<label>Full Content</label>
<textarea name="content" rows="6" class="form-control"></textarea>

<label>
    <input type="checkbox" name="status" checked> Publish
</label>

<br><br>
<button class="btn btn-primary">Save News</button>

</form>

</div>
@endsection
