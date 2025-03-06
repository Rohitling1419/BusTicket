@extends('admin.layout')

@section('content')
<h1>Edit City</h1>

<form action="{{ route('admin.cities.update', $city->id) }}" method="POST">
    @csrf @method('PUT')
    <input type="text" name="name" value="{{ $city->name }}" required>
    <button type="submit">Update</button>
</form>
@endsection