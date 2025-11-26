@extends('admin.layouts.app')

@section('content')
<div class="container">

<h2>Edit Role: {{ $role->name }}</h2>

<form action="{{ route('admin.roles.update',$role->id) }}" method="POST" class="card p-4">
@csrf

@foreach($permissions as $p)

<label class="d-block">
    <input type="checkbox" name="permissions[]" value="{{ $p->id }}"
    {{ $role->permissions->contains($p->id) ? 'checked' : '' }}>
    {{ $p->name }}
</label>

@endforeach

<br>
<button class="btn btn-primary">Update Role</button>

</form>

</div>
@endsection
