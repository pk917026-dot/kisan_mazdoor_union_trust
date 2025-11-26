@extends('admin.layouts.app')

@section('content')
<div class="container">

<h2>Documents Upload</h2>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

{{-- UPLOAD FORM --}}
<div class="card p-3 mb-4">

<form action="{{ route('admin.documents.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<label>Category</label>
<select name="category_id" class="form-control mb-2" required>
    @foreach($categories as $c)
        <option value="{{ $c->id }}">{{ $c->name }}</option>
    @endforeach
</select>

<label>Document Title</label>
<input type="text" name="title" class="form-control mb-2" required>

<label>Document File</label>
<input type="file" name="file" class="form-control mb-2" required>

<label>Description</label>
<textarea name="description" class="form-control mb-2"></textarea>

<button class="btn btn-primary">Upload Document</button>

</form>
</div>

{{-- DOCUMENT LIST --}}
<table class="table table-bordered">
<tr>
    <th>Title</th>
    <th>Category</th>
    <th>Download</th>
    <th>Action</th>
</tr>

@foreach($documents as $d)
<tr>
    <td>{{ $d->title }}</td>
    <td>{{ $d->category->name }}</td>
    <td>
        <a href="{{ asset('storage/'.$d->file) }}" target="_blank" class="btn btn-info btn-sm">
            Download
        </a>
    </td>
    <td>
        <a href="{{ route('admin.documents.delete',$d->id) }}"
           onclick="return confirm('Delete?')"
           class="btn btn-danger btn-sm">Delete</a>
    </td>
</tr>
@endforeach
</table>

</div>
@endsection
