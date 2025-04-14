@extends('layouts.app')

@section('title', 'Technician Dashboard')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Dashboard</h1>

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Assigned Assets Card -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-gray-600">Assigned Assets</h2>
                    <p class="text-2xl font-semibold text-gray-800">
                        {{ \App\Models\Assignment::where('technician_id', Auth::id())->count() }}
                    </p>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('technician.assets.index') }}" class="text-blue-600 hover:text-blue-800">
                    View all assets →
                </a>
            </div>
        </div>

        <!-- Profile Card -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-gray-600">Profile</h2>
                    <p class="text-2xl font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('technician.profile.edit') }}" class="text-green-600 hover:text-green-800">
                    Update profile →
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Assignments -->
    <div class="mt-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Recent Assignments</h2>
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Asset</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach(\App\Models\Assignment::with('asset')->where('technician_id', Auth::id())->latest()->take(5)->get() as $assignment)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $assignment->asset->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $assignment->status === 'approved' ? 'bg-green-100 text-green-800' : 
                                           ($assignment->status === 'fixed' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800') }}">
                                        {{ ucfirst($assignment->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $assignment->created_at->format('M d, Y') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
