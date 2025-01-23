@extends('admin.layout')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Create Meeting</h1>

    <form action="{{ route('admin.storeMeeting') }}" method="POST" class="bg-white p-8 rounded-lg shadow-lg">
        @csrf

        <div class="mb-6">
            <label for="title" class="block text-lg font-medium text-gray-700">Title</label>
            <input type="text" name="title" id="title" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500" required>
        </div>

        <div class="mb-6">
            <label for="description" class="block text-lg font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500"></textarea>
        </div>

        <div class="mb-6">
            <label for="start_time" class="block text-lg font-medium text-gray-700">Start Time</label>
            <input type="datetime-local" name="start_time" id="start_time" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500" required>
        </div>

        <div class="mb-6">
            <label for="end_time" class="block text-lg font-medium text-gray-700">End Time</label>
            <input type="datetime-local" name="end_time" id="end_time" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500" required>
        </div>

        <div class="mb-6">
            <label for="users" class="block text-lg font-medium text-gray-700">Invite Users</label>
            <select name="users[]" id="users" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-indigo-500" multiple required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Create Meeting</button>
    </form>
</div>
@endsection
