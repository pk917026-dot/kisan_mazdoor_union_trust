@extends('public.layouts.app')

@section('content')

<div class="container mx-auto py-10 px-4">

<h2 class="text-3xl font-bold text-blue-700 mb-6">Submit Your Claim</h2>

<form action="{{ url('/submit-claim') }}" method="POST" enctype="multipart/form-data">
@csrf

<label>Membership ID</label>
<input type="text" name="membership_id" class="form-control mb-2" required>

<label>Name</label>
<input type="text" name="name" class="form-control mb-2" required>

<label>Mobile</label>
<input type="text" name="mobile" class="form-control mb-2">

<label>Claim Type</label>
<input type="text" name="claim_type" class="form-control mb-2">

<label>Claim Amount</label>
<input type="text" name="amount" class="form-control mb-2">

<label>Upload Document</label>
<input type="file" name="document" class="form-control mb-2">

<label>Details</label>
<textarea name="details" class="form-control mb-3" rows="4"></textarea>

<button class="btn btn-primary">Submit Claim</button>

</form>

</div>
@endsection
