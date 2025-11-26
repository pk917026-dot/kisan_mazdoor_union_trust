@extends('admin.layouts.app')

@section('content')
<div class="container">

<h2 class="mb-4">Members List</h2>

<a href="{{ route('admin.members.create') }}" class="btn btn-success mb-3">Add Member</a>

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Photo</th>
        <th>Name</th>
        <th>Mobile</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    @foreach($members as $m)
    <tr>
        <td>{{ $m->membership_id }}</td>

        <td>
            @if($m->photo)
                <img src="{{ asset('storage/'.$m->photo) }}" width="50" height="50">
            @endif
        </td>

        <td>{{ $m->name }}</td>
        <td>{{ $m->mobile }}</td>

        <td>{{ $m->status ? 'Active' : 'Inactive' }}</td>

        <td>
            <a href="{{ route('admin.members.edit',$m->id) }}" class="btn btn-warning btn-sm">Edit</a>
            <a href="{{ route('admin.members.delete',$m->id) }}"
                onclick="return confirm('Delete Member?')"
                class="btn btn-danger btn-sm">Delete</a>
        </td>
    </tr>
    @endforeach

</table>

</div>
@endsection
