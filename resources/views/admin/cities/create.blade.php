@extends('admin.layout')

@section('content')
<h1>Add New City</h1>

<form action="{{ route('admin.cities.store') }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="City Name" required>
    <button type="submit">Add</button>
</form>
@endsection