@extends('admin.layout')

@section('content')
@include('components.export-activities')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="container mx-auto my-8">
    <h2 class="text-3xl font-bold text-center mb-6">Activities Submitted by Users</h2>

    <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
        <table class="min-w-full table-auto border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2 bg-gray-200 text-left font-bold text-sm">Activity Title</th>
                    <th class="border border-gray-300 px-4 py-2 bg-gray-200 text-left font-bold text-sm">User</th>
                    <th class="border border-gray-300 px-4 py-2 bg-gray-200 text-left font-bold text-sm">Status</th>
                    <th class="border border-gray-300 px-4 py-2 bg-gray-200 text-left font-bold text-sm">Created At</th>
                    <th class="border border-gray-300 px-4 py-2 bg-gray-200 text-left font-bold text-sm">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($activities as $activity)
                    <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }}">
                        <td class="border border-gray-300 px-4 py-2">{{ $activity->title }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $activity->user->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <span class="px-2 py-1 text-sm font-semibold 
                                {{ $activity->status == 'Completed' ? 'bg-green-500 text-white' : '' }}
                                {{ $activity->status == 'In Progress' ? 'bg-yellow-500 text-white' : '' }}
                                {{ $activity->status == 'Pending' ? 'bg-gray-500 text-white' : '' }}">
                                {{ $activity->status }}
                            </span>
                        </td>
                        <td class="border border-gray-300 px-4 py-2">{{ $activity->created_at->format('M d, Y') }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <a href="{{ route('admin.editActivity', $activity->id) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                            <!-- Optional: Add a delete link if needed -->
                            <a href="{{ route('admin.deleteActivity', $activity->id) }}" class="text-red-600 hover:text-red-800 ml-4">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
