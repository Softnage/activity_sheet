@extends('layouts.app')

@section('content')

<div class="flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <div x-data="{ isOpen: true }" class="flex h-full bg-gray-50 shadow-lg transition-all duration-300">
        <div :class="isOpen ? 'w-64' : 'w-20'" class="p-4 h-full transition-all duration-300">
            <!-- Toggle Button -->
            <button @click="isOpen = !isOpen" class="text-gray-600 focus:outline-none mb-4 w-full text-left">
                <i :class="isOpen ? 'fa-solid fa-chevron-left' : 'fa-solid fa-chevron-right'" class="text-lg"></i>
            </button>

            <!-- Navigation Menu -->
            <ul class="space-y-4">
                <!-- Dashboard -->
                <li>
                    <a href="{{ route('dashboard') }}" 
                       class="flex items-center p-3 rounded-lg transition-all duration-300 
                       {{ Route::is('dashboard') ? 'bg-blue-500 text-white' : 'text-gray-700 hover:bg-blue-100' }}">
                        <i class="fa-solid fa-house mr-3"></i>
                        <span x-show="isOpen" class="transition-all duration-300">Dashboard</span>
                    </a>
                </li>

                <!-- Weekly Activities -->
                <li>
                    <a href="{{ route('weekly.activities') }}" 
                       class="flex items-center p-3 rounded-lg transition-all duration-300 
                       {{ Route::is('weekly.activities') ? 'bg-blue-500 text-white' : 'text-gray-700 hover:bg-blue-100' }}">
                        <i class="fa-solid fa-calendar-week mr-3"></i>
                        <span x-show="isOpen" class="transition-all duration-300">Weekly Activities</span>
                    </a>
                </li>

                <!-- User Links -->
                @cannot('isAdmin')
                    <!-- User Activities -->
                    <li>
                        <a href="{{ route('activities.index') }}" 
                           class="flex items-center p-3 rounded-lg transition-all duration-300 
                           {{ Route::is('activities.index') ? 'bg-blue-500 text-white' : 'text-gray-700 hover:bg-blue-100' }}">
                            <i class="fa-solid fa-list-check mr-3"></i>
                            <span x-show="isOpen" class="transition-all duration-300">My Activities</span>
                        </a>
                    </li>

                    <!-- User Tasks -->
                    <li>
                        <a href="{{ route('activities.tasks') }}" 
                           class="flex items-center p-3 rounded-lg transition-all duration-300 
                           {{ Route::is('activities.tasks') ? 'bg-blue-500 text-white' : 'text-gray-700 hover:bg-blue-100' }}">
                            <i class="fa-solid fa-tasks mr-3"></i>
                            <span x-show="isOpen" class="transition-all duration-300">My Tasks</span>
                        </a>
                    </li>
                @endcannot

                <!-- Admin Links -->
<!-- Admin Links -->
@can('admin')
    <!-- Admin Dashboard -->
    <li>
        <a href="{{ route('admin.dashboard') }}" 
           class="flex items-center p-3 rounded-lg transition-all duration-300 
           {{ Route::is('admin.dashboard') ? 'bg-blue-500 text-white' : 'text-gray-700 hover:bg-blue-100' }}">
            <i class="fa-solid fa-tachometer-alt mr-3"></i>
            <span x-show="isOpen" class="transition-all duration-300">Admin Dashboard</span>
        </a>
    </li>
@endcan

            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-6 bg-gray-100 overflow-auto">
        <div class="space-y-8">
            <!-- Metrics Section -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Pending Tasks Card -->
                <div class="bg-white shadow-md rounded-lg p-4 flex flex-col items-center text-center">
                    <div class="text-blue-500 mb-2">
                        <i class="fa-solid fa-clock fa-2x"></i>
                    </div>
                    <h4 class="text-lg font-bold text-gray-800">Pending Activities</h4>
                    <p class="text-gray-600 text-sm">{{ $pendingTasksCount }}</p>
                </div>

                <!-- Received Tasks Card -->
                <div class="bg-white shadow-md rounded-lg p-4 flex flex-col items-center text-center">
                    <div class="text-green-500 mb-2">
                        <i class="fa-solid fa-check-circle fa-2x"></i>
                    </div>
                    <h4 class="text-lg font-bold text-gray-800">Received Tasks</h4>
                    <p class="text-gray-600 text-sm">{{ $receivedTasksCount }}</p>
                </div>

                <!-- Overdue Tasks Card -->
                <div class="bg-white shadow-md rounded-lg p-4 flex flex-col items-center text-center">
                    <div class="text-red-500 mb-2">
                        <i class="fa-solid fa-exclamation-circle fa-2x"></i>
                    </div>
                    <h4 class="text-lg font-bold text-gray-800">Overdue Tasks</h4>
                    <p class="text-gray-600 text-sm">{{ $overdueTasksCount }}</p>
                </div>

                <!-- Upcoming Deadlines Card -->
                <div class="bg-white shadow-md rounded-lg p-4 flex flex-col items-center text-center">
                    <div class="text-yellow-500 mb-2">
                        <i class="fa-solid fa-calendar-day fa-2x"></i>
                    </div>
                    <h4 class="text-lg font-bold text-gray-800">Upcoming Deadlines</h4>
                    <p class="text-gray-600 text-sm">{{ $upcomingDeadlinesCount }}</p>
                </div>
            </div>

            <!-- Upcoming Deadlines Section -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h3 class="font-bold text-lg text-gray-700 mb-4">
                    <i class="fa-solid fa-calendar-check mr-2 text-green-500"></i> Upcoming Deadlines
                </h3>
                <ul class="space-y-4">
                    @forelse ($tasksWithDeadlines as $task)
                        <li class="flex items-center justify-between bg-gray-100 p-4 rounded-lg shadow-sm">
                            <div>
                                <h4 class="font-semibold text-gray-800">{{ $task->title }}</h4>
                                <p class="text-sm text-gray-600">
                                    <i class="fa-solid fa-clock text-blue-500 mr-1"></i>
                                    Due: <span class="font-semibold">{{ $task->due_date->format('d M, Y - h:i A') }}</span>
                                </p>
                            </div>
                            <span class="px-3 py-1 text-sm font-medium text-white bg-blue-500 rounded-full">
                                {{ $task->status }}
                            </span>
                        </li>
                    @empty
                        <li class="text-gray-500">No upcoming deadlines!</li>
                    @endforelse
                </ul>
            </div>

            <!-- Activity History Section -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h3 class="font-bold text-lg text-gray-700 mb-4">
                    <i class="fa-solid fa-history mr-2 text-gray-500"></i> Activity History
                </h3>
                <ul class="space-y-2 text-gray-600">
                    @forelse ($recentActivities as $activity)
                        <li>
                            <i class="fa-solid fa-circle text-blue-500 text-xs mr-2"></i>
                            {{ $activity->title }} 
                            <span class="text-gray-500 text-sm">({{ $activity->created_at->diffForHumans() }})</span>
                        </li>
                    @empty
                        <li>
                            <i class="fa-solid fa-exclamation-circle text-red-500 mr-2"></i>
                            No recent activities.
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection
