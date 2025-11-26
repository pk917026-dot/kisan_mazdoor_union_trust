@extends('public.layouts.app')

@section('content')

<div class="container mx-auto py-10 px-4">

<h2 class="text-3xl font-bold text-blue-700 mb-6">Sahyog (Donations)</h2>

<table class="min-w-full bg-white shadow rounded">
    <tr class="bg-blue-600 text-white">
        <th class="p-3">Name</th>
        <th class="p-3">Amount</th>
        <th class="p-3">Date</th>
    </tr>

    @foreach(App\Models\Donation::orderBy('id','DESC')->get() as $d)
    <tr class="border-b">
        <td class="p-3">
            {{ $d->anonymous ? 'Anonymous Donor' : $d->name }}
        </td>
        <td class="p-3">₹ {{ $d->amount }}</td>
        <td class="p-3">{{ $d->created_at->format('d-m-Y') }}</td>
    </tr>
    @endforeach

</table>

</div>

@endsection
