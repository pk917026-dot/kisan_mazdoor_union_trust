@extends('admin.layouts.app')

@section('content')
<div class="container">

<h2 class="mb-4">Pages</h2>

<a href="{{ route('admin.pages.create') }}" class="btn btn-success mb-3">Add New Page</a>

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>URL</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    @foreach($pages as $page)
    <tr>
        <td>{{ $page->id }}</td>
        <td>{{ $page->title }}</td>
        <td><a href="/{{ $page->slug }}" target="_blank">/{{ $page->slug }}</a></td>
        <td>{{ $page->status ? 'Published' : 'Hidden' }}</td>
        <td>
            <a href="{{ route('admin.pages.edit',$page->id) }}" class="btn btn-warning btn-sm">Edit</a>
            <a href="{{ route('admin.pages.delete',$page->id) }}"
               onclick="return confirm('Delete?')"
               class="btn btn-danger btn-sm">Delete</a>
        </td>
    </tr>
    @endforeach

</table>

</div>
@endsection
