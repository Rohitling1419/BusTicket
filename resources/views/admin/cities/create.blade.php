@extends('admin.layout')

@section('content')
<x-app-layout>
    <main id="main" class="main">
        <h1>Add New City</h1>

        <form action="{{ route('admin.cities.store') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="City Name" required>
            <button type="submit">Add</button>
        </form>
    </main>
</x-app-layout>
@endsection