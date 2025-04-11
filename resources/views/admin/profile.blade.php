@extends('layouts.admin')

@section('content')
<x-app-layout>
    <main id="main" class="main">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-8">

                    <div class="card shadow-lg border-0 rounded-lg">
                        <div class="card-header bg-primary text-white text-center">
                            <h4>Edit Profile</h4>
                        </div>

                        <div class="card-body p-4">
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <form action="{{ route('admin.profile.update') }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input 
                                        type="text" 
                                        name="name" 
                                        id="name" 
                                        class="form-control" 
                                        value="{{ old('name', $user->name) }}" 
                                        required
                                    >
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">New Password</label>
                                    <input 
                                        type="password" 
                                        name="password" 
                                        id="password" 
                                        class="form-control" 
                                        placeholder="Leave blank to keep current password"
                                    >
                                </div>

                                <div class="mb-4">
                                    <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                    <input 
                                        type="password" 
                                        name="password_confirmation" 
                                        id="password_confirmation" 
                                        class="form-control"
                                    >
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success w-50">Update Profile</button>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </main>
</x-app-layout>
@endsection
