@extends('layouts.app')

@section('title', 'View Asset')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-semibold text-gray-800">Asset Details</h1>
        <div class="flex space-x-3">
            <a href="{{ route('admin.assets.edit', $asset) }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Edit Asset
            </a>
            <a href="{{ route('admin.assets.index') }}" 
               class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">
                Back to List
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Basic Information</h2>
                <div class="space-y-4">
                    <div>
                        <h3 class="text-gray-600 text-sm font-bold">Asset Name</h3>
                        <p class="text-gray-800">{{ $asset->name }}</p>
                    </div>
                    <div>
                        <h3 class="text-gray-600 text-sm font-bold">Category</h3>
                        <p class="text-gray-800">{{ $asset->category }}</p>
                    </div>
                    <div>
                        <h3 class="text-gray-600 text-sm font-bold">Status</h3>
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $asset->status === 'approved' ? 'bg-green-100 text-green-800' : 
                               ($asset->status === 'fixed' ? 'bg-blue-100 text-blue-800' : 
                               ($asset->status === 'assigned' ? 'bg-yellow-100 text-yellow-800' : 
                               'bg-red-100 text-red-800')) }}">
                            {{ ucfirst($asset->status) }}
                        </span>
                    </div>
                    <div>
                        <h3 class="text-gray-600 text-sm font-bold">Created At</h3>
                        <p class="text-gray-800">{{ $asset->created_at->format('M d, Y H:i A') }}</p>
                    </div>
                </div>
            </div>

            <div>
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Details</h2>
                <div class="space-y-4">
                    <div>
                        <h3 class="text-gray-600 text-sm font-bold">Description</h3>
                        <p class="text-gray-800 whitespace-pre-line">{{ $asset->description }}</p>
                    </div>
                    <div>
                        <h3 class="text-gray-600 text-sm font-bold">Defect Description</h3>
                        <p class="text-gray-800 whitespace-pre-line">{{ $asset->defect_description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($asset->assignment)
    <div class="mt-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Assignment Details</h2>
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <div class="space-y-4">
                        <div>
                            <h3 class="text-gray-600 text-sm font-bold">Assigned To</h3>
                            <p class="text-gray-800">{{ $asset->assignment->technician->name }}</p>
                        </div>
                        <div>
                            <h3 class="text-gray-600 text-sm font-bold">Technician Email</h3>
                            <p class="text-gray-800">{{ $asset->assignment->technician->email }}</p>
                        </div>
                        <div>
                            <h3 class="text-gray-600 text-sm font-bold">Assignment Date</h3>
                            <p class="text-gray-800">{{ $asset->assignment->created_at->format('M d, Y H:i A') }}</p>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="space-y-4">
                        <div>
                            <h3 class="text-gray-600 text-sm font-bold">Fixed Date</h3>
                            <p class="text-gray-800">{{ $asset->assignment->fixed_at ? $asset->assignment->fixed_at->format('M d, Y H:i A') : 'Not fixed yet' }}</p>
                        </div>
                        <div>
                            <h3 class="text-gray-600 text-sm font-bold">Admin Approval</h3>
                            <p class="text-gray-800">{{ $asset->assignment->approved_by_admin ? 'Approved' : 'Pending Approval' }}</p>
                        </div>
                        @if($asset->status === 'fixed' && !$asset->assignment->approved_by_admin)
                        <div class="mt-4">
                            <form action="{{ route('admin.assignments.update', $asset->assignment) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" 
                                    class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                                    Approve Fix
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @elseif($asset->status === 'defective')
    <div class="mt-8">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl font-semibold text-gray-800">Assign Asset</h2>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('admin.assignments.store') }}" method="POST">
                @csrf
                <input type="hidden" name="asset_id" value="{{ $asset->id }}">
                
                <div class="mb-4">
                    <label for="technician_id" class="block text-gray-700 text-sm font-bold mb-2">Select Technician</label>
                    <select name="technician_id" id="technician_id" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">Select a technician...</option>
                        @foreach(\App\Models\User::where('role', 'technician')->get() as $technician)
                            <option value="{{ $technician->id }}">{{ $technician->name }} ({{ $technician->email }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-center justify-end">
                    <button type="submit" 
                        class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Assign Asset
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
@endsection
