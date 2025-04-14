@extends('layouts.app')

@section('title', 'Edit Asset')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-semibold text-gray-800">Edit Asset</h1>
        <a href="{{ route('admin.assets.index') }}" 
           class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">
            Back to List
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('admin.assets.update', $asset) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Asset Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $asset->name) }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror"
                    required>
                @error('name')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="category" class="block text-gray-700 text-sm font-bold mb-2">Category</label>
                <input type="text" name="category" id="category" value="{{ old('category', $asset->category) }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('category') border-red-500 @enderror"
                    required>
                @error('category')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                <textarea name="description" id="description" rows="3"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('description') border-red-500 @enderror"
                    required>{{ old('description', $asset->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="defect_description" class="block text-gray-700 text-sm font-bold mb-2">Defect Description</label>
                <textarea name="defect_description" id="defect_description" rows="3"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('defect_description') border-red-500 @enderror"
                    required>{{ old('defect_description', $asset->defect_description) }}</textarea>
                @error('defect_description')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Current Status</label>
                <div class="px-3 py-2 bg-gray-100 rounded">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                        {{ $asset->status === 'approved' ? 'bg-green-100 text-green-800' : 
                           ($asset->status === 'fixed' ? 'bg-blue-100 text-blue-800' : 
                           ($asset->status === 'assigned' ? 'bg-yellow-100 text-yellow-800' : 
                           'bg-red-100 text-red-800')) }}">
                        {{ ucfirst($asset->status) }}
                    </span>
                </div>
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" 
                    class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Update Asset
                </button>
            </div>
        </form>
    </div>

    @if($asset->assignment)
    <div class="mt-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Assignment Details</h2>
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <h3 class="text-gray-600 text-sm font-bold">Assigned To</h3>
                    <p class="text-gray-800">{{ $asset->assignment->technician->name }}</p>
                </div>
                <div>
                    <h3 class="text-gray-600 text-sm font-bold">Assigned Date</h3>
                    <p class="text-gray-800">{{ $asset->assignment->created_at->format('M d, Y') }}</p>
                </div>
                <div>
                    <h3 class="text-gray-600 text-sm font-bold">Fixed Date</h3>
                    <p class="text-gray-800">{{ $asset->assignment->fixed_at ? $asset->assignment->fixed_at->format('M d, Y') : 'Not fixed yet' }}</p>
                </div>
                <div>
                    <h3 class="text-gray-600 text-sm font-bold">Status</h3>
                    <p class="text-gray-800">{{ $asset->assignment->approved_by_admin ? 'Approved' : 'Pending Approval' }}</p>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
