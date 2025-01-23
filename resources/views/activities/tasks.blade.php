@extends('layouts.app')

@section('content')
@include('components.export-activities')
    <div class="container mx-auto my-12 px-4">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Assigned Tasks</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-500 text-green-800 p-4 mb-6 rounded-lg">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="bg-red-100 border border-red-500 text-red-800 p-4 mb-6 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <div class="space-y-6">
            @forelse($tasks as $task)
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
                    <h2 class="text-lg font-semibold text-gray-900">{{ $task->title }}</h2>
                    <p class="text-sm text-gray-600 mt-2">
                        <i class="fa-solid fa-clock text-blue-500 mr-2"></i>
                        Due Date: {{ \Carbon\Carbon::parse($task->due_date)->format('d M, Y - h:i A') }}
                    </p>

                    <div class="mt-4 flex flex-wrap gap-4 items-center">
                        <form action="{{ route('activities.tasks.received', $task->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" 
                                    class="px-4 py-2 bg-blue-600 text-white font-medium text-sm rounded-lg hover:bg-blue-700 transition">
                                {{ $task->status === 'Received' ? 'Mark as Unreceived' : 'Mark as Received' }}
                            </button>
                        </form>

                        @if($task->status === 'Received' && $task->activities->isNotEmpty())
                            <span class="text-green-600 text-sm flex items-center">
                                <i class="fa-solid fa-check-circle mr-2"></i>
                                Received at {{ $task->activities->last()->created_at->format('d M, Y - h:i A') }}
                            </span>
                        @endif

                        @if($task->status === 'Received')
                            <form action="{{ route('tasks.delete', $task->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="px-4 py-2 bg-red-500 text-white font-medium text-sm rounded-lg hover:bg-red-600 transition">
                                    Delete Task
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <div class="bg-gray-100 text-gray-600 p-6 rounded-lg shadow-md">
                    <p>No tasks assigned yet.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
