@extends('admin.layout')

@section('title', 'Admin Dashboard')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap');
    * {
        font-family: 'Nunito', sans-serif;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="bg-white p-6 rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-6">Admin Dashboard</h1>

<!-- Metrics Section -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Total Tasks -->
    <div class="p-4 bg-blue-100 rounded-lg shadow flex items-center">
        <div class="flex-shrink-0 p-2 bg-blue-200 rounded-full">
            <i class="fas fa-tasks text-blue-600 text-2xl"></i>
        </div>
        <div class="ml-4">
            <h2 class="text-xl font-semibold">Total Tasks Assigned</h2>
            <p class="text-3xl font-bold text-blue-800">{{ $totalTasks }}</p>
        </div>
    </div>

<!-- Completion Rate -->
<div class="p-4 rounded-lg shadow" style="background-color: {{ $completionRate >= 50 ? '#d1fae5' : '#fee2e2' }};">
    <div class="flex items-center">
        <div class="flex-shrink-0 p-2 rounded-full" 
             style="background-color: {{ $completionRate >= 50 ? '#a7f3d0' : '#fecaca' }};">
            <i class="fas fa-check-circle text-2xl" 
               style="color: {{ $completionRate >= 50 ? '#047857' : '#b91c1c' }};"></i>
        </div>
        <div class="ml-4">
            <h2 class="text-xl font-semibold">Completion Rate</h2>
            <p class="text-3xl font-bold" 
               style="color: {{ $completionRate >= 50 ? '#065f46' : '#991b1b' }};">
                {{ $completionRate }}%
            </p>
        </div>
    </div>
    <!-- Progress Bar -->
    <div class="w-full rounded mt-4" 
         style="background-color: {{ $completionRate >= 50 ? '#6ee7b7' : '#fca5a5' }};">
        <div class="text-xs font-medium text-white text-center p-1 leading-none rounded" 
             style="background-color: {{ $completionRate >= 50 ? '#047857' : '#b91c1c' }}; width: {{ $completionRate }}%;">
            {{ $completionRate }}%
        </div>
    </div>
</div>

    <!-- Tasks by Priority -->
    <div class="p-4 bg-yellow-100 rounded-lg shadow">
        <div class="flex items-center">
            <div class="flex-shrink-0 p-2 bg-yellow-200 rounded-full">
                <i class="fas fa-exclamation-circle text-yellow-600 text-2xl"></i>
            </div>
            <div class="ml-4">
                <h2 class="text-xl font-semibold">Tasks by Priority</h2>
            </div>
        </div>
        <div class="mt-4">
            <!-- Priority Levels -->
            <div class="mb-2">
                <label class="text-sm font-medium">High Priority</label>
                <div class="w-full bg-red-300 rounded">
                    <div class="bg-red-500 text-xs font-medium text-white text-center p-1 leading-none rounded" 
                         style="width: {{ ($tasksByPriority['High'] ?? 0) * 10 }}%">
                        {{ $tasksByPriority['High'] ?? 0 }}
                    </div>
                </div>
            </div>
            <div class="mb-2">
                <label class="text-sm font-medium">Medium Priority</label>
                <div class="w-full bg-yellow-300 rounded">
                    <div class="bg-yellow-500 text-xs font-medium text-white text-center p-1 leading-none rounded" 
                         style="width: {{ ($tasksByPriority['Medium'] ?? 0) * 10 }}%">
                        {{ $tasksByPriority['Medium'] ?? 0 }}
                    </div>
                </div>
            </div>
            <div>
                <label class="text-sm font-medium">Low Priority</label>
                <div class="w-full bg-blue-300 rounded">
                    <div class="bg-blue-500 text-xs font-medium text-white text-center p-1 leading-none rounded" 
                         style="width: {{ ($tasksByPriority['Low'] ?? 0) * 10 }}%">
                        {{ $tasksByPriority['Low'] ?? 0 }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- Charts Section -->
<!-- Charts Section -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Task Priority Chart -->
    <div class="p-6 bg-white shadow rounded-lg">
        <h2 class="text-lg font-bold text-gray-700 mb-2">Tasks by Priority</h2>
        <p class="text-sm text-gray-500 mb-4">Shows the distribution of tasks based on priority levels (High, Medium, Low).</p>
        <canvas id="tasksPriorityChart"></canvas>
    </div>

    <!-- Activity Completion Chart -->
    <div class="p-6 bg-white shadow rounded-lg">
        <h2 class="text-lg font-bold text-gray-700 mb-2">Activity Completion</h2>
        <p class="text-sm text-gray-500 mb-4">Displays the percentage of completed versus remaining activities.</p>
        <canvas id="activityCompletionChart"></canvas>
    </div>
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Tasks by Priority Line Chart
// Tasks by Priority Line Chart
const tasksPriorityCtx = document.getElementById('tasksPriorityChart').getContext('2d');
new Chart(tasksPriorityCtx, {
    type: 'line',
    data: {
        labels: ['High', 'Medium', 'Low'], // Priority Levels
        datasets: [{
            label: 'Tasks by Priority',
            data: [{{ $tasksByPriority['High'] ?? 0 }}, {{ $tasksByPriority['Medium'] ?? 0 }}, {{ $tasksByPriority['Low'] ?? 0 }}],
            backgroundColor: 'rgba(59, 130, 246, 0.2)', // Fill color
            borderColor: 'rgba(59, 130, 246, 1)',       // Line color
            borderWidth: 2,
            tension: 0.4,                               // Smoother curve
            fill: true,                                 // Enable fill under the curve
            pointBackgroundColor: 'rgba(59, 130, 246, 1)', // Point color
            pointRadius: 5                              // Point size
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { 
                display: true, 
                position: 'top',
                labels: { font: { family: 'Poppins' } } 
            }
        },
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'Priority Levels',
                    font: { weight: 'bold', family: 'Poppins' }
                },
                grid: { display: false } // Hide X-axis gridlines
            },
            y: {
                title: {
                    display: true,
                    text: 'Number of Tasks',
                    font: { weight: 'bold', family: 'Poppins' }
                },
                beginAtZero: true,
                ticks: { stepSize: 1 } // Ensure ticks are integers
            }
        }
    }
});

// Activity Completion Chart
const activityCompletionCtx = document.getElementById('activityCompletionChart').getContext('2d');
new Chart(activityCompletionCtx, {
    type: 'doughnut',
    data: {
        labels: ['Completed', 'Remaining'],
        datasets: [{
            data: [{{ $completedActivities }}, {{ $totalActivities - $completedActivities }}],
            backgroundColor: ['#34d399', '#f87171'], // Green for completed, red for remaining
            hoverOffset: 8
        }]
    },
    options: {
        plugins: {
            legend: { 
                position: 'bottom',
                labels: { font: { family: 'Poppins', size: 12 } }
            },
            tooltip: {
                callbacks: {
                    label: function (tooltipItem) {
                        const label = tooltipItem.label || '';
                        const value = tooltipItem.raw || 0;
                        const total = {{ $totalActivities }};
                        const percentage = ((value / total) * 100).toFixed(1);
                        return `${label}: ${value} (${percentage}%)`;
                    }
                }
            }
        },
        responsive: true,
        cutout: '70%' // Create a donut-like appearance
    }
});

</script>
@endsection
