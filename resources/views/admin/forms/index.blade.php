@extends('admin.layouts.app')

@section('content')
<div class="container">

    <h2 class="mb-4">Dynamic Forms</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.forms.create') }}" class="btn btn-success mb-3">
        + Create New Form
    </a>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Form Name</th>
            <th>Slug (URL)</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        @foreach($forms as $f)
            <tr>
                <td>{{ $f->id }}</td>
                <td>{{ $f->name }}</td>
                <td><a href="{{ route('public.form.show', $f->slug) }}" target="_blank">/form/{{ $f->slug }}</a></td>
                <td>{{ $f->is_active ? 'Active' : 'Inactive' }}</td>
                <td>
                    <a href="{{ route('admin.forms.edit',$f->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <a href="{{ route('admin.forms.submissions',$f->id) }}" class="btn btn-info btn-sm">Submissions</a>
                    <a href="{{ route('admin.forms.delete',$f->id) }}"
                       onclick="return confirm('Delete this form?')"
                       class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
        @endforeach
    </table>

</div>
@endsection
