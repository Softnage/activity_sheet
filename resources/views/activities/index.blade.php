@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 flex flex-col">
    <!-- Main Content -->
    <main class="container mx-auto px-6 py-8 flex-1">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Sidebar -->
            <aside class="bg-white shadow-lg rounded-lg p-6 hidden lg:block">
                <h2 class="text-xl font-bold text-gray-700 mb-4">Navigation</h2>
                <ul class="space-y-4">
                    <li>
                        <a href="{{ route('dashboard') }}" class="block p-3 rounded-lg transition-all {{ Route::is('dashboard') ? 'bg-blue-100 text-blue-600' : 'text-gray-700 hover:bg-gray-100' }}">
                            <i class="fa-solid fa-house mr-2"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('weekly.activities') }}" class="block p-3 rounded-lg transition-all {{ Route::is('weekly.activities') ? 'bg-blue-100 text-blue-600' : 'text-gray-700 hover:bg-gray-100' }}">
                            <i class="fa-solid fa-calendar-week mr-2"></i> Weekly Activities
                        </a>
                    </li>
                        <li>
                            <a href="{{ route('activities.index') }}" class="block p-3 rounded-lg transition-all {{ Route::is('activities.index') ? 'bg-blue-100 text-blue-600' : 'text-gray-700 hover:bg-gray-100' }}">
                                <i class="fa-solid fa-list-check mr-2"></i> My Activities
                            </a>
                        </li>
                    @if (auth()->user() && auth()->user()->role === 'admin')
                        <li>
                            <a href="{{ route('admin.manageUsers') }}" class="block p-3 rounded-lg transition-all {{ Route::is('admin.manageUsers') ? 'bg-blue-100 text-blue-600' : 'text-gray-700 hover:bg-gray-100' }}">
                                <i class="fa-solid fa-users-cog mr-2"></i> Manage Users
                            </a>
                        </li>
                    @endif
                </ul>
            </aside>

            <!-- Main Section -->
            <section class="col-span-2 bg-white shadow-lg rounded-lg p-6">
                <h2 class="text-xl font-bold text-gray-700 mb-6">Your Activities</h2>

                <!-- Search & Filters -->
                <div class="flex flex-col md:flex-row justify-between items-center mb-8">
                    <form method="GET" action="{{ route('activities.index') }}" class="flex items-center w-full md:w-2/3">
                        <input type="text" name="search" placeholder="Search activities..." class="w-full py-2 px-4 border rounded-lg shadow-sm focus:ring-blue-500 focus:outline-none" value="{{ request('search') }}">
                        <button type="submit" class="ml-4 px-6 py-2 bg-blue-600 text-white rounded-lg shadow-sm hover:bg-blue-700">Search</button>
                    </form>
                    <form method="GET" action="{{ route('activities.index') }}" class="mt-4 md:mt-0 md:ml-4">
                        <select name="status" class="w-full py-2 px-4 border rounded-lg shadow-sm focus:ring-blue-500 focus:outline-none" onchange="this.form.submit()">
                            <option value="">All Activities</option>
                            <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="In Progress" {{ request('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </form>
                </div>

                <!-- Activity Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($activities as $activity)
                        <div class="bg-gray-50 shadow-md rounded-lg p-6 hover:shadow-xl transition">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $activity->title }}</h3>
                            <p class="text-gray-600 text-sm line-clamp-2 mb-4">{{ $activity->description }}</p>
                            <div class="text-sm text-gray-500">
                                <p>Date: {{ \Carbon\Carbon::parse($activity->date)->format('M d, Y') }}</p>
                                <p>Status: 
                                    <span class="font-semibold {{ $activity->status == 'Pending' ? 'text-yellow-500' : ($activity->status == 'In Progress' ? 'text-blue-500' : 'text-green-500') }}">
                                        {{ $activity->status }}
                                    </span>
                                </p>
                            </div>
                            <div class="mt-4 flex justify-between items-center">
                                <a href="{{ route('activities.edit', $activity->id) }}" class="text-blue-600 hover:text-blue-800 font-medium">Edit</a>
                                <span class="bg-gray-100 text-xs text-gray-600 py-1 px-3 rounded-lg">{{ $activity->priority }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $activities->links('pagination::tailwind') }}
                </div>
            </section>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white py-4">
        <div class="container mx-auto px-6 text-center text-gray-500">
            &copy; {{ date('Y') }} Activity Management System. All rights reserved.
        </div>
    </footer>
</div>
@endsection
