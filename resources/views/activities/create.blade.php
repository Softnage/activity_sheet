@extends('layouts.app')

@section('content')

<div class="container mx-auto my-12">
    <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-6">
            <h2 class="text-3xl font-bold">Add Activity</h2>
            <p class="mt-2 text-sm">Fill out the form below to create a new activity.</p>
        </div>
        <div class="p-6">
            <form action="{{ route('activities.store') }}" method="POST">
                @csrf

                <!-- Activity Title -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-700">Activity Title</label>
                    <input type="text" name="title" id="title" class="w-full mt-2 p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter activity title" required>
                </div>

                <!-- Activity Description -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700">Activity Description</label>
                    <textarea name="description" id="description" rows="4" class="w-full mt-2 p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Write a detailed description..." required></textarea>
                </div>

                <!-- Activity Date -->
                <div class="mb-6">
                    <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                    <input type="date" name="date" id="date" class="w-full mt-2 p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>

                <!-- Activity Status -->
                <div class="mb-6">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="status" class="w-full mt-2 p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                        <option value="" disabled selected>Select status</option>
                        <option value="Pending">Pending</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Completed">Completed</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="mt-8">
                    <button type="submit" class="w-full py-3 px-5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-lg shadow-md hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-transform transform hover:scale-105">
                        Save Activity
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
