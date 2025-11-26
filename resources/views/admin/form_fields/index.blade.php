@extends('admin.layouts.app')

@section('page-title','Form Fields Manager')

@section('content')
<div class="card p-3">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Registration Form – Dynamic Fields</h4>
        <a href="{{ route('admin.formfields.create') }}" class="btn btn-success btn-sm">
            + नया Field जोड़ें
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Label</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Section</th>
                    <th>Required</th>
                    <th>Active</th>
                    <th>Sort</th>
                    <th width="180">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($fields as $field)
                    <tr>
                        <td>{{ $field->id }}</td>
                        <td>{{ $field->label }}</td>
                        <td>{{ $field->name }}</td>
                        <td>{{ strtoupper($field->type) }}</td>
                        <td>{{ $field->section ?? '-' }}</td>
                        <td>
                            @if($field->is_required)
                                <span class="badge bg-danger">Required</span>
                            @else
                                <span class="badge bg-secondary">Optional</span>
                            @endif
                        </td>
                        <td>
                            @if($field->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-dark">Hidden</span>
                            @endif
                        </td>
                        <td>{{ $field->sort_order }}</td>
                        <td>
                            <a href="{{ route('admin.formfields.edit',$field->id) }}"
                               class="btn btn-primary btn-sm">Edit</a>

                            <form action="{{ route('admin.formfields.delete',$field->id) }}"
                                  method="POST" class="d-inline"
                                  onsubmit="return confirm('Delete this field?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted py-4">
                            अभी तक कोई Field नहीं बनाया गया है।
                            <br><br>
                            <a href="{{ route('admin.formfields.create') }}" class="btn btn-success">
                                + पहला Field जोड़ें
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
