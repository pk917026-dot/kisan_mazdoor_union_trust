@extends('admin.layouts.app')

@section('content')
<div class="container">

<h2 class="mb-4">Income Records</h2>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card p-3 mb-4">
    <form action="{{ route('admin.income.store') }}" method="POST">
        @csrf

        <label>Category</label>
        <select name="category_id" class="form-control mb-2">
            @foreach($categories as $c)
            <option value="{{ $c->id }}">{{ $c->name }}</option>
            @endforeach
        </select>

        <label>Title</label>
        <input type="text" name="title" class="form-control mb-2" required>

        <label>Amount</label>
        <input type="text" name="amount" class="form-control mb-2" required>

        <label>Date</label>
        <input type="date" name="date" class="form-control mb-2" required>

        <button class="btn btn-primary">Add Income</button>
    </form>
</div>

<table class="table table-bordered">
<tr>
    <th>Title</th>
    <th>Amount</th>
    <th>Date</th>
    <th>Action</th>
</tr>

@foreach($incomes as $i)
<tr>
    <td>{{ $i->title }}</td>
    <td>₹ {{ $i->amount }}</td>
    <td>{{ $i->date }}</td>
    <td>
        <a href="{{ route('admin.income.delete',$i->id) }}"
           onclick="return confirm('Delete?')"
           class="btn btn-danger btn-sm">Delete</a>
    </td>
</tr>
@endforeach

</table>

</div>
@endsection
