@extends('public.layouts.app')

@section('content')

<div class="container mx-auto py-10 px-4">

<h2 class="text-3xl font-bold text-blue-700 mb-6">Downloads / Documents</h2>

@foreach(App\Models\DocumentCategory::all() as $cat)
    <h3 class="text-xl font-semibold mt-6 mb-2 text-gray-800">{{ $cat->name }}</h3>

    <div class="bg-white shadow rounded mb-4">
        <table class="min-w-full">
            @foreach($cat->documents as $doc)
            <tr class="border-b">
                <td class="p-3">{{ $doc->title }}</td>
                <td class="p-3">
                    <a href="{{ asset('storage/'.$doc->file) }}" target="_blank"
                       class="text-blue-600 underline">Download</a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
@endforeach

</div>

@endsection
