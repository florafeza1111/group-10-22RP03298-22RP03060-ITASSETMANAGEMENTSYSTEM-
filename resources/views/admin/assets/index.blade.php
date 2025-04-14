@extends('layouts.app')

@section('title', 'Manage Assets')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-semibold text-gray-800">Assets</h1>
        <a href="{{ route('admin.assets.create') }}" 
           class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            Add New Asset
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Assigned To</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($assets as $asset)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $asset->name }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-500">{{ $asset->category }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $asset->status === 'approved' ? 'bg-green-100 text-green-800' : 
                               ($asset->status === 'fixed' ? 'bg-blue-100 text-blue-800' : 
                               ($asset->status === 'assigned' ? 'bg-yellow-100 text-yellow-800' : 
                               'bg-red-100 text-red-800')) }}">
                            {{ ucfirst($asset->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-500">
                            @if($asset->assignment)
                                {{ $asset->assignment->technician->name }}
                            @else
                                Not assigned
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-3">
                            <a href="{{ route('admin.assets.show', $asset) }}" class="text-blue-600 hover:text-blue-900">View</a>
                            <a href="{{ route('admin.assets.edit', $asset) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                            @if(!$asset->assignment)
                                <form action="{{ route('admin.assets.destroy', $asset) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this asset?')">
                                        Delete
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                        No assets found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
