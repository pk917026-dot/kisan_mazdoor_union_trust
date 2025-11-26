@extends('admin.layouts.app')

@section('content')
<div class="container">

<h2>All Claims</h2>

<table class="table table-bordered">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Mobile</th>
    <th>Status</th>
    <th>Action</th>
</tr>

@foreach($claims as $c)
<tr>
    <td>{{ $c->membership_id }}</td>
    <td>{{ $c->name }}</td>
    <td>{{ $c->mobile }}</td>
    <td>{{ $c->status }}</td>
    <td>
        <a href="{{ url('/admin/claim/view/'.$c->id) }}" class="btn btn-primary btn-sm">View</a>
    </td>
</tr>
@endforeach

</table>

</div>
@endsection
