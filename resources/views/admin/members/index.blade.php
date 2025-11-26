@extends('admin.layouts.app')

@section('page-title','Members')

@section('content')
<div class="card p-3">
    <h4 class="mb-3">Member Registrations</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" class="mb-3">
        <div class="row g-2">
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">सभी स्टेटस</option>
                    <option value="pending"  {{ ($status ?? '')=='pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ ($status ?? '')=='approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ ($status ?? '')=='rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary btn-sm">Filter</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered table-sm align-middle">
        <thead>
        <tr>
            <th>ID</th>
            <th>Status</th>
            <th>Submitted</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @forelse($members as $m)
            <tr>
                <td>{{ $m->id }}</td>
                <td>{{ ucfirst($m->status) }}</td>
                <td>{{ $m->created_at }}</td>
                <td>
                    <a href="{{ route('admin.members.show',$m->id) }}" class="btn btn-sm btn-primary">
                        View
                    </a>
                </td>
            </tr>
        @empty
            <tr><td colspan="4" class="text-center text-muted">कोई member नहीं मिला।</td></tr>
        @endforelse
        </tbody>
    </table>

    {{ $members->links() }}
</div>
@endsection
