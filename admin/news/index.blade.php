@extends('admin.layouts.app')

@section('content')
<div class="container">

<h2>News</h2>

<a href="{{ route('admin.news.create') }}" class="btn btn-success mb-3">Add News</a>

<table class="table table-bordered">
<tr>
    <th>Image</th>
    <th>Title</th>
    <th>Status</th>
    <th>Action</th>
</tr>

@foreach($news as $n)
<tr>
    <td>
        @if($n->image)
        <img src="{{ asset('storage/'.$n->image) }}" width="60">
        @endif
    </td>
    <td>{{ $n->title }}</td>
    <td>{{ $n->status ? 'Published' : 'Hidden' }}</td>
    <td>
        <a href="{{ route('admin.news.delete',$n->id) }}"
           onclick="return confirm('Delete?')"
           class="btn btn-danger btn-sm">Delete</a>
    </td>
</tr>
@endforeach

</table>

</div>
@endsection
