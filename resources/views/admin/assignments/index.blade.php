@extends('layouts.app')

@section('title', 'Manage Assignments')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-semibold text-gray-800">Asset Assignments</h1>
        <a href="{{ route('admin.assets.index') }}" 
           class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            Assign New Asset
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-4 border-b">
            <div class="flex space-x-4">
                <button class="px-4 py-2 text-sm font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500
                    {{ request('filter') === 'pending' ? 'bg-blue-100 text-blue-800' : 'text-gray-600 hover:text-gray-800' }}"
                    onclick="window.location.href='{{ route('admin.assignments.index', ['filter' => 'pending']) }}'">
                    Pending Approval
                </button>
                <button class="px-4 py-2 text-sm font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500
                    {{ request('filter') === 'approved' ? 'bg-green-100 text-green-800' : 'text-gray-600 hover:text-gray-800' }}"
                    onclick="window.location.href='{{ route('admin.assignments.index', ['filter' => 'approved']) }}'">
                    Approved
                </button>
                <button class="px-4 py-2 text-sm font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500
                    {{ !request('filter') ? 'bg-gray-100 text-gray-800' : 'text-gray-600 hover:text-gray-800' }}"
                    onclick="window.location.href='{{ route('admin.assignments.index') }}'">
                    All
                </button>
            </div>
        </div>

        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Asset</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Technician</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Assigned Date</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fixed Date</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($assignments as $assignment)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $assignment->asset->name }}</div>
                        <div class="text-sm text-gray-500">{{ $assignment->asset->category }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $assignment->technician->name }}</div>
                        <div class="text-sm text-gray-500">{{ $assignment->technician->email }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($assignment->fixed_at)
                            @if($assignment->approved_by_admin)
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
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-500">{{ $assignment->created_at->format('M d, Y') }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-500">
                            {{ $assignment->fixed_at ? $assignment->fixed_at->format('M d, Y') : 'Not fixed yet' }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-3">
                            <a href="{{ route('admin.assignments.show', $assignment) }}" class="text-blue-600 hover:text-blue-900">View</a>
                            @if($assignment->fixed_at && !$assignment->approved_by_admin)
                                <form action="{{ route('admin.assignments.update', $assignment) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="text-green-600 hover:text-green-900">
                                        Approve
                                    </button>
                                </form>
                            @endif
                            @if(!$assignment->fixed_at)
                                <form action="{{ route('admin.assignments.destroy', $assignment) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to cancel this assignment?')">
                                        Cancel
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                        No assignments found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
