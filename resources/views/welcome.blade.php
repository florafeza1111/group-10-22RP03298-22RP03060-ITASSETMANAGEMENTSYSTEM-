<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IT Assets Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="antialiased bg-gray-100">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <span class="text-2xl font-bold text-blue-600">ITAMS</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        @if (Route::has('login'))
                            @auth
                                @if(auth()->user()->role === 'admin')
                                    <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-blue-600">Dashboard</a>
                                @else
                                    <a href="{{ route('technician.dashboard') }}" class="text-gray-700 hover:text-blue-600">Dashboard</a>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600">Login</a>
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="relative bg-gradient-to-r from-blue-600 to-blue-800 overflow-hidden">
            <div class="max-w-7xl mx-auto">
                <div class="relative z-10 pb-8 sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                    <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                        <div class="sm:text-center lg:text-left">
                            <h1 class="text-4xl tracking-tight font-extrabold text-white sm:text-5xl md:text-6xl">
                                <span class="block">IT Assets Management</span>
                                <span class="block text-blue-200">Made Simple</span>
                            </h1>
                            <p class="mt-3 text-base text-blue-100 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                                Streamline your IT asset tracking, maintenance, and management with our comprehensive solution.
                            </p>
                            <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                                @guest
                                    <div class="rounded-md shadow">
                                        <a href="{{ route('login') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-blue-700 bg-white hover:bg-blue-50 md:py-4 md:text-lg md:px-10">
                                            Get Started
                                        </a>
                                    </div>
                                @endguest
                            </div>
                        </div>
                    </main>
                </div>
            </div>
            <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
                <div class="h-56 w-full bg-blue-900 sm:h-72 md:h-96 lg:w-full lg:h-full flex items-center justify-center">
                    <i class="fas fa-laptop-code text-9xl text-blue-200 opacity-50"></i>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="py-12 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="lg:text-center">
                    <h2 class="text-base text-blue-600 font-semibold tracking-wide uppercase">Features</h2>
                    <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                        Better Asset Management
                    </p>
                </div>

                <div class="mt-10">
                    <div class="grid grid-cols-1 gap-10 sm:grid-cols-2 lg:grid-cols-3">
                        <!-- Feature 1 -->
                        <div class="relative">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-600 text-white">
                                        <i class="fas fa-desktop"></i>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900">Asset Tracking</h3>
                                    <p class="mt-2 text-base text-gray-500">
                                        Keep track of all your IT assets in one centralized location.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Feature 2 -->
                        <div class="relative">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-600 text-white">
                                        <i class="fas fa-tools"></i>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900">Maintenance Management</h3>
                                    <p class="mt-2 text-base text-gray-500">
                                        Schedule and track maintenance tasks for your IT equipment.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Feature 3 -->
                        <div class="relative">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-600 text-white">
                                        <i class="fas fa-chart-line"></i>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900">Reports & Analytics</h3>
                                    <p class="mt-2 text-base text-gray-500">
                                        Generate detailed reports on asset status and maintenance history.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-800">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <p class="text-base text-gray-400">
                        &copy; {{ date('Y') }} IT Assets Management System. All rights reserved.
                    </p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
