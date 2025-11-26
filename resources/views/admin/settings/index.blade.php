@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Site Settings</h2>

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Trust Name</label>
        <input type="text" name="trust_name" class="form-control" value="{{ $settings->trust_name ?? '' }}">

        <label>Site Logo</label>
        <input type="file" name="site_logo" class="form-control">

        <label>Favicon</label>
        <input type="file" name="favicon" class="form-control">

        <label>Contact Number</label>
        <input type="text" name="contact_number" class="form-control" value="{{ $settings->contact_number ?? '' }}">

        <label>WhatsApp</label>
        <input type="text" name="whatsapp" class="form-control" value="{{ $settings->whatsapp ?? '' }}">

        <label>Email</label>
        <input type="text" name="email" class="form-control" value="{{ $settings->email ?? '' }}">

        <label>Address</label>
        <textarea name="address" class="form-control">{{ $settings->address ?? '' }}</textarea>

        <label>Header Color</label>
        <input type="color" name="header_color" value="{{ $settings->header_color ?? '#1a56db' }}">

        <label>Menu Color</label>
        <input type="color" name="menu_color" value="{{ $settings->menu_color ?? '#1e293b' }}">

        <label>Footer Color</label>
        <input type="color" name="footer_color" value="{{ $settings->footer_color ?? '#0f172a' }}">

        <label>Theme Color</label>
        <input type="color" name="theme_color" value="{{ $settings->theme_color ?? '#1d4ed8' }}">

        <label>Facebook</label>
        <input type="text" name="facebook" class="form-control" value="{{ $settings->facebook ?? '' }}">

        <label>Instagram</label>
        <input type="text" name="instagram" class="form-control" value="{{ $settings->instagram ?? '' }}">

        <label>YouTube</label>
        <input type="text" name="youtube" class="form-control" value="{{ $settings->youtube ?? '' }}">

        <label>Footer Text</label>
        <textarea name="footer_text" class="form-control">{{ $settings->footer_text ?? '' }}</textarea>

        <br>
        <button class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
