@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col bg-white">

    <!-- Content Section -->
    <div class="flex-1 container mx-auto mt-6 px-4 lg:px-8">

        <!-- Week Selector -->
        <div class="flex justify-between items-center bg-blue-50 p-4 rounded-lg shadow-md">
            <a href="{{ route('weekly.activities', ['week' => $currentWeekStart->subWeek()->format('Y-m-d')]) }}" 
               class="text-blue-500 hover:underline">
                <i class="fa-solid fa-chevron-left mr-2"></i>Previous Week
            </a>
            <span class="text-lg font-medium text-gray-800">
                {{ $currentWeekStart->format('d M, Y') }} - {{ $currentWeekEnd->format('d M, Y') }}
            </span>
            <a href="{{ route('weekly.activities', ['week' => $currentWeekStart->addWeek()->format('Y-m-d')]) }}" 
               class="text-blue-500 hover:underline">
                Next Week<i class="fa-solid fa-chevron-right ml-2"></i>
            </a>
        </div>

        <!-- Filters -->
        <div class="mt-6 flex flex-wrap gap-4">
            <div class="flex-1">
                <label for="status-filter" class="block text-gray-600 mb-2 font-medium">Filter by Status</label>
                <select id="status-filter" class="w-full p-3 border border-gray-300 rounded-lg">
                    <option value="all">All</option>
                    <option value="pending">Pending</option>
                    <option value="in-progress">In Progress</option>
                    <option value="completed">Completed</option>
                </select>
            </div>
            <div>
                <a href="{{ route('activities.create') }}" class="block bg-green-500 text-white py-3 px-6 rounded-lg hover:bg-green-600">
                    Add New Activity
                </a>
            </div>
        </div>

        <!-- Weekly Schedule -->
        <div class="mt-8 bg-white rounded-lg shadow-lg overflow-hidden">
            <table class="min-w-full border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-4 text-left font-semibold text-gray-700">Time</th>
                        @foreach ($daysOfWeek as $day)
                        <th class="py-3 px-4 text-left font-semibold text-gray-700">{{ $day }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($timeSlots as $slot => $range)
                    <tr class="border-t">
                        <td class="py-3 px-4 text-gray-800 font-medium">{{ $slot }}</td>
                        @foreach ($daysOfWeek as $day)
                        <td class="py-3 px-4">
                            @if ($structuredActivities[$day][$slot] !== 'No Activity')
                            <span class="block bg-blue-100 text-blue-600 px-3 py-1 rounded-lg text-center">
                                {{ $structuredActivities[$day][$slot] }}
                            </span>
                            @else
                            <span class="block text-gray-500 italic">No Activity</span>
                            @endif
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
