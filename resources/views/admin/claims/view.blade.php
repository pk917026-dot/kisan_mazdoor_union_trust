@extends('admin.layouts.app')

@section('content')
<div class="container">

    <h2 class="mb-4">Claim Details</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            Applicant Information
        </div>
        <div class="card-body">
            @foreach($submission->data as $key => $value)

                @php
                    // check if it is a file
                    $isFile = str_contains($value, 'uploads/forms/');
                @endphp

                <p>
                    <strong>{{ ucfirst(str_replace('_',' ',$key)) }}:</strong><br>

                    @if($isFile)
                        <a href="{{ asset('storage/'.$value) }}" target="_blank" class="btn btn-outline-dark btn-sm">
                            Download File
                        </a>
                    @else
                        {{ $value }}
                    @endif
                </p>

            @endforeach
        </div>
    </div>

    {{-- CLAIM STATUS UPDATE --}}
    <div class="card">
        <div class="card-header bg-secondary text-white">
            Update Claim Status
        </div>
        <div class="card-body">

            <form method="POST" action="{{ route('admin.claims.update',$submission->id) }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="pending"  @if($submission->status=='pending') selected @endif>Pending</option>
                        <option value="approved" @if($submission->status=='approved') selected @endif>Approved</option>
                        <option value="rejected" @if($submission->status=='rejected') selected @endif>Rejected</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Admin Remarks</label>
                    <textarea name="admin_remarks" class="form-control" rows="3">{{ $submission->admin_remarks }}</textarea>
                </div>

                <button class="btn btn-success">Save Changes</button>
            </form>

        </div>
    </div>

</div>
@endsection
