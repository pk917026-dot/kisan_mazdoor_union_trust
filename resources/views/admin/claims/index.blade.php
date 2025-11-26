@extends('admin.layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">Claim Submissions</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <tr>
            <th>ID</th>
            <th>Applicant</th>
            <th>Mobile</th>
            <th>Claim Type</th>
            <th>Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        @foreach($claims as $c)
            @php $data = $c->data; @endphp

            <tr>
                <td>{{ $c->id }}</td>

                <td>{{ $data['full_name'] ?? '-' }}</td>

                <td>{{ $data['mobile'] ?? '-' }}</td>

                <td>{{ $data['claim_type'] ?? '-' }}</td>

                <td>{{ $c->created_at->format('d-m-Y') }}</td>

                <td>
                    <span class="badge 
                        @if($c->status=='pending') bg-warning 
                        @elseif($c->status=='approved') bg-success
                        @else bg-danger @endif">
                        {{ ucfirst($c->status) }}
                    </span>
                </td>

                <td>
                    <a href="{{ route('admin.claims.view',$c->id) }}" 
                       class="btn btn-primary btn-sm">View</a>
                </td>
            </tr>

        @endforeach

    </table>

</div>

@endsection
