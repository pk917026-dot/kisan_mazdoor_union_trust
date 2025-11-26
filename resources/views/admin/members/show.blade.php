@extends('admin.layouts.app')

@section('page-title','Member Detail')

@section('content')
<div class="card p-3">
    <h4 class="mb-3">Member #{{ $member->id }}</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.members.status',$member->id) }}" class="mb-3">
        @csrf
        <label class="form-label">Status</label>
        <div class="d-flex gap-2">
            <select name="status" class="form-select" style="max-width:200px;">
                <option value="pending"  {{ $member->status=='pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ $member->status=='approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ $member->status=='rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
            <button class="btn btn-primary btn-sm">Update</button>
        </div>
    </form>

    @foreach($grouped as $section => $values)
        <h5 class="mt-3">{{ $section }}</h5>
        <table class="table table-bordered table-sm">
            @foreach($values as $val)
                <tr>
                    <th style="width:30%;">{{ $val->field->label }}</th>
                    <td>{{ $val->value }}</td>
                </tr>
            @endforeach
        </table>
    @endforeach
</div>
@endsection
