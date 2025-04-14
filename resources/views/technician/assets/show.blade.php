@extends('layouts.app')

@section('title', 'View Asset')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-semibold text-gray-800">Asset Details</h1>
        <a href="{{ route('technician.assets.index') }}" 
           class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">
            Back to List
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Asset Information -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Asset Information</h2>
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
                    <h3 class="text-gray-600 text-sm font-bold">Description</h3>
                    <p class="text-gray-800 whitespace-pre-line">{{ $asset->description }}</p>
                </div>
                <div>
                    <h3 class="text-gray-600 text-sm font-bold">Defect Description</h3>
                    <p class="text-gray-800 whitespace-pre-line">{{ $asset->defect_description }}</p>
                </div>
            </div>
        </div>

        <!-- Assignment Information -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Assignment Status</h2>
            <div class="space-y-4">
                <div>
                    <h3 class="text-gray-600 text-sm font-bold">Assignment Date</h3>
                    <p class="text-gray-800">{{ $asset->assignment->created_at->format('M d, Y H:i A') }}</p>
                </div>
                <div>
                    <h3 class="text-gray-600 text-sm font-bold">Status</h3>
                    @if($asset->assignment->fixed_at)
                        @if($asset->assignment->approved_by_admin)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Approved
                            </span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Pending Approval
                            </span>
                        @endif
                    @else
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                            In Progress
                        </span>
                    @endif
                </div>
                <div>
                    <h3 class="text-gray-600 text-sm font-bold">Fixed Date</h3>
                    <p class="text-gray-800">{{ $asset->assignment->fixed_at ? $asset->assignment->fixed_at->format('M d, Y H:i A') : 'Not fixed yet' }}</p>
                </div>
            </div>

            @if(!$asset->assignment->fixed_at)
            <div class="mt-6">
                <form action="{{ route('technician.assets.mark-fixed', $asset) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" 
                        class="w-full bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500"
                        onclick="return confirm('Are you sure this asset is fixed?')">
                        Mark as Fixed
                    </button>
                </form>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
