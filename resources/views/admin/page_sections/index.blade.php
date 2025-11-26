@extends('admin.layouts.app')

@section('content')
    <h1>Page Sections</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.page-sections.create') }}" class="btn btn-primary mb-3">
        + New Section
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Page</th>
                <th>Key</th>
                <th>Title</th>
                <th>Active</th>
                <th>Order</th>
                <th>Updated</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($sections as $section)
            <tr>
                <td>{{ $section->page }}</td>
                <td>{{ $section->section_key }}</td>
                <td>{{ $section->title }}</td>
                <td>{{ $section->is_active ? 'Yes' : 'No' }}</td>
                <td>{{ $section->sort_order }}</td>
                <td>{{ $section->updated_at?->format('d-m-Y') }}</td>
                <td>
                    <a href="{{ route('admin.page-sections.edit', $section) }}" class="btn btn-sm btn-warning">
                        Edit
                    </a>

                    <form action="{{ route('admin.page-sections.destroy', $section) }}"
                          method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                onclick="return confirm('Delete this section?')"
                                class="btn btn-sm btn-danger">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7">No sections found.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
