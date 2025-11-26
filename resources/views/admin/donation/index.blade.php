@extends('admin.layouts.app')

@section('content')
<div class="container">

<h2 class="mb-4">Donations / Sahyog</h2>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

{{-- ADD DONATION --}}
<div class="card p-3 mb-4">
    <form action="{{ route('admin.donations.store') }}" method="POST">
        @csrf

        <label>Donor Name</label>
        <input type="text" name="name" class="form-control mb-2">

        <label>Mobile</label>
        <input type="text" name="mobile" class="form-control mb-2">

        <label>Amount</label>
        <input type="text" name="amount" class="form-control mb-2" required>

        <label>Payment Mode</label>
        <select name="payment_mode" class="form-control mb-2">
            <option value="Cash">Cash</option>
            <option value="UPI">UPI</option>
            <option value="Bank Transfer">Bank Transfer</option>
        </select>

        <label>Transaction ID (optional)</label>
        <input type="text" name="transaction_id" class="form-control mb-2">

        <label>
            <input type="checkbox" name="anonymous">
            Hide Donor Name (Anonymous)
        </label>

        <br><br>
        <button class="btn btn-primary">Add Donation</button>
    </form>
</div>

{{-- DONATION LIST --}}
<table class="table table-bordered">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Amount</th>
    <th>Mode</th>
    <th>Date</th>
    <th>Action</th>
</tr>

@foreach($donations as $d)
<tr>
    <td>{{ $d->receipt_no }}</td>
    <td>{{ $d->anonymous ? 'Anonymous Donor' : $d->name }}</td>
    <td>₹ {{ $d->amount }}</td>
    <td>{{ $d->payment_mode }}</td>
    <td>{{ $d->created_at->format('d-m-Y') }}</td>
    <td>
        <a href="{{ route('admin.donations.delete',$d->id) }}"
           onclick="return confirm('Delete this donation?')"
           class="btn btn-danger btn-sm">Delete</a>
    </td>
</tr>
@endforeach

</table>

</div>
@endsection
