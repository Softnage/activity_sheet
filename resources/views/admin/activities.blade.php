@extends('admin.layout')

@section('content')
<div class="container mx-auto my-8">
    <h2 class="text-3xl font-bold text-center mb-6">Activities Submitted by Users</h2>

    <!-- User Filter Dropdown -->
    <form method="GET" action="{{ route('admin.viewAllActivities') }}" class="mb-6">
        <label for="user_id" class="block mb-2 text-sm font-medium text-gray-700">Select User:</label>
        <select name="user_id" id="user_id" class="w-full border border-gray-300 rounded px-3 py-2" onchange="this.form.submit()">
            <option value="">-- All Users --</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ $selectedUser == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
    </form>

    <!-- Activities Table -->
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
                @forelse($activities as $activity)
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
                            <form action="{{ route('admin.deleteActivity', $activity->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 ml-4" onclick="return confirm('Are you sure you want to delete this activity?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="border border-gray-300 px-4 py-2 text-center">No activities found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
