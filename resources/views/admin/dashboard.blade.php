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
        <div class="p-4 bg-blue-100 rounded-lg shadow">
            <h2 class="text-xl font-semibold">Total Tasks Assigned</h2>
            <p class="text-3xl font-bold">{{ $totalTasks }}</p>
        </div>

        <!-- Completion Rate -->
        <div class="p-4 bg-green-100 rounded-lg shadow">
            <h2 class="text-xl font-semibold">Completion Rate</h2>
            <p class="text-3xl font-bold">{{ $completionRate }}%</p>
        </div>

        <!-- Tasks by Priority -->
        <div class="p-4 bg-yellow-100 rounded-lg shadow">
            <h2 class="text-xl font-semibold">Tasks by Priority</h2>
            <ul class="mt-2">
                <li>High: {{ $tasksByPriority['High'] ?? 0 }}</li>
                <li>Medium: {{ $tasksByPriority['Medium'] ?? 0 }}</li>
                <li>Low: {{ $tasksByPriority['Low'] ?? 0 }}</li>
            </ul>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Task Priority Chart -->
        <div class="p-4 bg-white shadow rounded-lg">
            <h2 class="text-lg font-semibold mb-4">Tasks by Priority</h2>
            <canvas id="tasksPriorityChart"></canvas>
        </div>

        <!-- Activity Completion Chart -->
        <div class="p-4 bg-white shadow rounded-lg">
            <h2 class="text-lg font-semibold mb-4">Activity Completion</h2>
            <canvas id="activityCompletionChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Tasks by Priority Line Chart
const tasksPriorityCtx = document.getElementById('tasksPriorityChart').getContext('2d');
new Chart(tasksPriorityCtx, {
    type: 'line',
    data: {
        labels: ['High', 'Medium', 'Low'], // Priority Levels
        datasets: [{
            label: 'Tasks by Priority',
            data: [{{ $tasksByPriority['High'] ?? 0 }}, {{ $tasksByPriority['Medium'] ?? 0 }}, {{ $tasksByPriority['Low'] ?? 0 }}],
            backgroundColor: 'rgba(59, 130, 246, 0.2)', // Fill color (light blue)
            borderColor: 'rgba(59, 130, 246, 1)',       // Line color (blue)
            borderWidth: 2,
            tension: 0.4,                               // Curve tension for smoother lines
            fill: true,                                 // Enable area fill under the line
            pointBackgroundColor: 'rgba(59, 130, 246, 1)', // Point color
            pointRadius: 5                              // Size of points
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: true, position: 'top' }, // Display the legend at the top
        },
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'Priority Levels',
                    font: { weight: 'bold' }
                }
            },
            y: {
                title: {
                    display: true,
                    text: 'Number of Tasks',
                    font: { weight: 'bold' }
                },
                beginAtZero: true                        // Ensure the Y-axis starts at 0
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
                backgroundColor: ['#34d399', '#f87171'],
                hoverOffset: 4
            }]
        },
        options: {
            plugins: {
                legend: { position: 'bottom' },
            },
        },
    });
</script>
@endsection
