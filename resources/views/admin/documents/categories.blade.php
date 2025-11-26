@extends('admin.layouts.app')

@section('content')
<div class="container">

<h2>Document Categories</h2>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card p-3 mb-4">
    <form action="{{ route('admin.doc.categories.store') }}" method="POST">
        @csrf
        <label>Category Name</label>
        <input type="text" name="name" class="form-control mb-2" required>
        <button class="btn btn-primary">Add Category</button>
    </form>
</div>

<table class="table table-bordered">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Action</th>
</tr>

@foreach($categories as $c)
<tr>
    <td>{{ $c->id }}</td>
    <td>{{ $c->name }}</td>
    <td>
        <a href="{{ route('admin.doc.categories.delete',$c->id) }}"
           class="btn btn-danger btn-sm"
           onclick="return confirm('Delete?')">Delete</a>
    </td>
</tr>
@endforeach
</table>

</div>
@endsection
