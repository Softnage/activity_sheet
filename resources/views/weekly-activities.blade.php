@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col bg-gray-50">

    <!-- Content Section -->
    <div class="flex-1 container mx-auto py-6 px-4 lg:px-8">

        <!-- Week Selector -->
        <div class="flex justify-between items-center bg-teal-100 p-4 rounded-lg shadow-md">
        <a href="{{ route('weekly.activities', ['week' => $weekStart->copy()->subWeek()->format('Y-m-d')]) }}" 
   class="text-teal-600 hover:underline flex items-center">
    <i class="fa-solid fa-chevron-left mr-2"></i>Previous Week
</a>
<span class="text-xl font-semibold text-gray-800">
    {{ $weekStart->format('d M, Y') }} - {{ $weekEnd->format('d M, Y') }}
</span>
<a href="{{ route('weekly.activities', ['week' => $weekStart->copy()->addWeek()->format('Y-m-d')]) }}" 
   class="text-teal-600 hover:underline flex items-center">
    Next Week<i class="fa-solid fa-chevron-right ml-2"></i>
</a>

        </div>

        <!-- Filters -->
        <div class="mt-8 flex flex-wrap gap-4">
            <!-- <div class="flex-1">
                <label for="status-filter" class="block text-gray-600 mb-2 font-medium">Filter by Status</label>
                <select id="status-filter" class="w-full p-3 border border-gray-300 rounded-lg">
                    <option value="all">All</option>
                    <option value="pending">Pending</option>
                    <option value="in-progress">In Progress</option>
                    <option value="completed">Completed</option>
                </select>
            </div> -->
            <div>
                <a href="{{ route('activities.create') }}" class="block bg-indigo-500 text-white py-3 px-6 rounded-lg hover:bg-indigo-600 transition-colors duration-300">
                    Add New Activity
                </a>
            </div>
        </div>

        <!-- Weekly Schedule -->
        <div class="mt-8 bg-white rounded-lg shadow-md overflow-hidden">
            <table class="min-w-full border-collapse">
                <thead class="bg-indigo-50">
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
                            <span class="block bg-green-100 text-green-600 px-3 py-1 rounded-lg text-center">
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
