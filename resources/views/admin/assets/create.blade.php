@extends('layouts.app')

@section('title', 'Add New Asset')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-semibold text-gray-800">Add New Asset</h1>
        <a href="{{ route('admin.assets.index') }}" 
           class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">
            Back to List
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('admin.assets.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Asset Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror"
                    required>
                @error('name')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="category" class="block text-gray-700 text-sm font-bold mb-2">Category</label>
                <select name="category" id="category"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('category') border-red-500 @enderror"
                    required>
                    <option value="">Select a category</option>
                    <option value="Desktop Computer" {{ old('category') == 'Desktop Computer' ? 'selected' : '' }}>Desktop Computer</option>
                    <option value="Laptop" {{ old('category') == 'Laptop' ? 'selected' : '' }}>Laptop</option>
                    <option value="Monitor" {{ old('category') == 'Monitor' ? 'selected' : '' }}>Monitor</option>
                    <option value="Printer" {{ old('category') == 'Printer' ? 'selected' : '' }}>Printer</option>
                    <option value="Scanner" {{ old('category') == 'Scanner' ? 'selected' : '' }}>Scanner</option>
                    <option value="Server" {{ old('category') == 'Server' ? 'selected' : '' }}>Server</option>
                    <option value="Network Switch" {{ old('category') == 'Network Switch' ? 'selected' : '' }}>Network Switch</option>
                    <option value="Router" {{ old('category') == 'Router' ? 'selected' : '' }}>Router</option>
                    <option value="UPS" {{ old('category') == 'UPS' ? 'selected' : '' }}>UPS</option>
                    <option value="Projector" {{ old('category') == 'Projector' ? 'selected' : '' }}>Projector</option>
                    <option value="Mobile Device" {{ old('category') == 'Mobile Device' ? 'selected' : '' }}>Mobile Device</option>
                    <option value="Network Storage" {{ old('category') == 'Network Storage' ? 'selected' : '' }}>Network Storage</option>
                    <option value="Other" {{ old('category') == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('category')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                <textarea name="description" id="description" rows="3"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('description') border-red-500 @enderror"
                    required>{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="defect_description" class="block text-gray-700 text-sm font-bold mb-2">Defect Description</label>
                <textarea name="defect_description" id="defect_description" rows="3"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('defect_description') border-red-500 @enderror"
                    required>{{ old('defect_description') }}</textarea>
                @error('defect_description')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" 
                    class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Create Asset
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
