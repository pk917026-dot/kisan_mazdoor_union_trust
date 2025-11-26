@extends('public.layouts.app')

@section('content')

<div class="container mx-auto py-10 px-4">

<h2 class="text-3xl font-bold text-blue-700 mb-6">Submit Your Complaint</h2>

<form action="{{ url('/submit-complaint') }}" method="POST">
@csrf

<label>Name</label>
<input type="text" name="name" class="form-control mb-2" required>

<label>Mobile</label>
<input type="text" name="mobile" class="form-control mb-2" required>

<label>Subject</label>
<input type="text" name="subject" class="form-control mb-2">

<label>Message</label>
<textarea name="message" class="form-control mb-3" rows="4"></textarea>

<button class="btn btn-primary">Submit Complaint</button>

</form>

</div>
@endsection
