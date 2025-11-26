@extends('admin.layouts.app')

@section('content')
<div class="container">

<h2 class="mb-4">Roles</h2>

<form action="{{ route('admin.roles.store') }}" method="POST" class="card p-3 mb-4">
@csrf
    <label>Role Name</label>
    <input type="text" class="form-control mb-2" name="name">
    <button class="btn btn-primary">Create Role</button>
</form>

<table class="table table-bordered">
<tr>
    <th>Role</th>
    <th>Permissions</th>
    <th>Action</th>
</tr>

@foreach($roles as $r)
<tr>
    <td>{{ $r->name }}</td>
    <td>
        @foreach($r->permissions as $p)
            <span class="badge bg-primary">{{ $p->name }}</span>
        @endforeach
    </td>
    <td>
        <a href="{{ route('admin.roles.edit',$r->id) }}" class="btn btn-warning btn-sm">Edit</a>
    </td>
</tr>
@endforeach

</table>

</div>
@endsection
