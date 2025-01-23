@extends('admin.layout')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="container mx-auto my-12">
    <h2 class="text-3xl font-extrabold text-gray-800 mb-6">Assign Tasks to Users</h2>

    <div class="bg-white p-8 shadow-lg rounded-lg">
        <form action="{{ route('admin.tasks.store') }}" method="POST">
            @csrf

            <!-- Select User -->
            <div class="mb-6">
                <label for="user_id" class="block text-lg font-medium text-gray-700 mb-2">Select User</label>
                <select name="user_id" id="user_id" 
                        class="block w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">-- Select User --</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                    @endforeach
                </select>
                @error('user_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Task Title -->
            <div class="mb-6">
                <label for="title" class="block text-lg font-medium text-gray-700 mb-2">Task Title</label>
                <input type="text" name="title" id="title" 
                       class="block w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                       placeholder="Enter task title">
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Task Description -->
            <div class="mb-6">
                <label for="description" class="block text-lg font-medium text-gray-700 mb-2">Task Description</label>
                <textarea name="description" id="description" rows="5" 
                          class="block w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" 
                          placeholder="Enter task description"></textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Priority Level -->
            <div class="mb-6">
                <label for="priority" class="block text-lg font-medium text-gray-700 mb-2">Priority</label>
                <select name="priority" id="priority" 
                        class="block w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="Low">Low</option>
                    <option value="Medium">Medium</option>
                    <option value="High">High</option>
                </select>
                @error('priority')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Due Date -->
            <div class="mb-6">
                <label for="due_date" class="block text-lg font-medium text-gray-700 mb-2">Due Date</label>
                <input type="date" name="due_date" id="due_date" 
                       class="block w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                @error('due_date')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="text-right">
                <button type="submit" 
                        class="px-8 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                    Assign Task
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
