@extends('layouts.app')

@section('title', 'Add New Technician')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-semibold text-gray-800">Add New Technician</h1>
        <a href="{{ route('admin.technicians.index') }}" 
           class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">
            Back to List
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('admin.technicians.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror"
                    required>
                @error('name')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror"
                    required>
                @error('email')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4" role="alert">
                    <p class="font-bold">Note:</p>
                    <p>The default password will be set to: tec@123</p>
                    <p class="text-sm">The technician can change this password after logging in.</p>
                </div>
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" 
                    class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Create Technician
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
