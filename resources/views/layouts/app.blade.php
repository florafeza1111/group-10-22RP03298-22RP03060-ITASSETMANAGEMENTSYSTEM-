<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Assets Management - @yield('title')</title>
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100">
    <div x-data="{ sidebarOpen: false }">
        <!-- Sidebar -->
        @auth
        <div class="fixed inset-y-0 left-0 z-30 w-64 transform bg-blue-700 overflow-y-auto lg:translate-x-0 lg:static lg:inset-0 transition duration-300 ease-in-out"
            :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}">
            
            <div class="flex items-center justify-center mt-8">
                <div class="flex items-center">
                    <span class="text-white text-2xl font-semibold">IT Assets MS</span>
                </div>
            </div>

            <nav class="mt-10">
                @if(auth()->user()->isAdmin())
                    <a class="flex items-center py-2 px-6 text-gray-100 hover:bg-blue-600 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600' : '' }}"
                        href="{{ route('admin.dashboard') }}">
                        <span class="mx-3">Dashboard</span>
                    </a>
                    <a class="flex items-center py-2 px-6 text-gray-100 hover:bg-blue-600 {{ request()->routeIs('admin.technicians.*') ? 'bg-blue-600' : '' }}"
                        href="{{ route('admin.technicians.index') }}">
                        <span class="mx-3">Technicians</span>
                    </a>
                    <a class="flex items-center py-2 px-6 text-gray-100 hover:bg-blue-600 {{ request()->routeIs('admin.assets.*') ? 'bg-blue-600' : '' }}"
                        href="{{ route('admin.assets.index') }}">
                        <span class="mx-3">Assets</span>
                    </a>
                    <a class="flex items-center py-2 px-6 text-gray-100 hover:bg-blue-600 {{ request()->routeIs('admin.assignments.*') ? 'bg-blue-600' : '' }}"
                        href="{{ route('admin.assignments.index') }}">
                        <span class="mx-3">Assignments</span>
                    </a>
                @else
                    <a class="flex items-center py-2 px-6 text-gray-100 hover:bg-blue-600 {{ request()->routeIs('technician.dashboard') ? 'bg-blue-600' : '' }}"
                        href="{{ route('technician.dashboard') }}">
                        <span class="mx-3">Dashboard</span>
                    </a>
                    <a class="flex items-center py-2 px-6 text-gray-100 hover:bg-blue-600 {{ request()->routeIs('technician.assets.*') ? 'bg-blue-600' : '' }}"
                        href="{{ route('technician.assets.index') }}">
                        <span class="mx-3">My Assets</span>
                    </a>
                    <a class="flex items-center py-2 px-6 text-gray-100 hover:bg-blue-600 {{ request()->routeIs('technician.profile.*') ? 'bg-blue-600' : '' }}"
                        href="{{ route('technician.profile.edit') }}">
                        <span class="mx-3">Profile</span>
                    </a>
                @endif
            </nav>
        </div>
        @endauth

        <div class="flex-1 flex flex-col min-h-screen lg:pl-64">
            <!-- Top Navbar -->
            <header class="bg-white shadow">
                <div class="flex items-center justify-between h-16 px-6">
                    @auth
                    <button class="text-gray-500 focus:outline-none lg:hidden" @click="sidebarOpen = true">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 6H20M4 12H20M4 18H20" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>

                    <div class="flex items-center">
                        <span class="text-gray-800">{{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="ml-4">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-gray-800">Logout</button>
                        </form>
                    </div>
                    @endauth
                </div>
            </header>

            <!-- Main Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
                <div class="container mx-auto px-6 py-8">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>
    </div>
</body>
</html>
