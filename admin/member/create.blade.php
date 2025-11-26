@extends('admin.layouts.app')

@section('content')
<div class="container">

<h2>Add New Member</h2>

<form action="{{ route('admin.members.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<label>Name</label>
<input type="text" name="name" class="form-control mb-2" required>

<label>Father Name</label>
<input type="text" name="father_name" class="form-control mb-2">

<label>Mobile</label>
<input type="text" name="mobile" class="form-control mb-2">

<label>WhatsApp</label>
<input type="text" name="whatsapp" class="form-control mb-2">

<label>Email</label>
<input type="text" name="email" class="form-control mb-2">

<label>Aadhaar</label>
<input type="text" name="aadhaar" class="form-control mb-2">

<label>PAN</label>
<input type="text" name="pan" class="form-control mb-2">

<label>Photo</label>
<input type="file" name="photo" class="form-control mb-2">

<button class="btn btn-primary">Save Member</button>

</form>

</div>
@endsection
