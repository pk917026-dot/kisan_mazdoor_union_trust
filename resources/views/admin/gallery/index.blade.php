@extends('admin.layouts.app')

@section('content')
<div class="container">

<h2 class="mb-4">Gallery</h2>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

{{-- UPLOAD FORM --}}
<div class="card p-3 mb-4">
    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Photo</label>
        <input type="file" name="image" class="form-control mb-2" required>

        <label>Caption (optional)</label>
        <input type="text" name="title" class="form-control mb-3">

        <button class="btn btn-primary">Add to Gallery</button>
    </form>
</div>

{{-- SHOW PHOTOS --}}
<div class="row">
    @foreach($photos as $photo)
        <div class="col-md-3 mb-3">
            <div class="card">
                <img src="{{ asset('storage/'.$photo->image) }}" class="img-fluid" style="height:180px;object-fit:cover;">
                <div class="p-2">
                    <p>{{ $photo->title }}</p>
                    <a href="{{ route('admin.gallery.delete',$photo->id) }}"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Delete this photo?')">Delete</a>
                </div>
            </div>
        </div>
    @endforeach
</div>

</div>
@endsection
