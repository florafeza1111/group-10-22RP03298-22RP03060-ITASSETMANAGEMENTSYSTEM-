@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-semibold text-gray-800">Edit Profile</h1>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 max-w-2xl mx-auto">
        <form action="{{ route('technician.profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror"
                    required>
                @error('name')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror"
                    required>
                @error('email')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="current_password" class="block text-gray-700 text-sm font-bold mb-2">Current Password</label>
                <input type="password" name="current_password" id="current_password"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('current_password') border-red-500 @enderror">
                @error('current_password')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="new_password" class="block text-gray-700 text-sm font-bold mb-2">New Password</label>
                <input type="password" name="new_password" id="new_password"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('new_password') border-red-500 @enderror">
                @error('new_password')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="new_password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Confirm New Password</label>
                <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" 
                    class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Update Profile
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
