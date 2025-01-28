<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        
        $userId = Auth::id();

        // Calculate statistics
        $pendingTasksCount = Activity::where('user_id', $userId)
            ->where('status', 'Pending')
            ->count();

        $receivedTasksCount = Task::where('user_id', $userId)
            ->where('status', 'received')
            ->count();

        $completedActivities = Activity::where('user_id', $userId)
            ->where('status', 'Completed')
            // ->where('due_date', '<', now())
            ->count();

// Count overdue tasks with incomplete activities
$overdueTaskWithIncompleteActivitiesCount = Task::where('status', 'received')
    ->where('due_date', '<', now()) // Tasks with past due dates
    ->whereHas('activity', function ($query) {
        $query->where('status', '!=', 'Completed'); // Incomplete activities
    })
    ->count();

        $tasksWithDeadlines = Task::where('user_id', $userId)
            ->where('status', '!=', 'received')
            // ->where('due_date', '>==', now())
            ->orderBy('due_date', 'asc')
            ->take(5)
            ->get();

        $recentActivities = Activity::where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

                // Calculate total hours spent
    $totalHoursSpent = Activity::whereNotNull('start_time')
    ->whereNotNull('end_time')
    ->get()
    ->sum(function ($activity) {
        return $activity->end_time->diffInHours($activity->start_time);
    });


        return view('dashboard', compact(
            'pendingTasksCount',
            'receivedTasksCount',
            'completedActivities',
            'overdueTaskWithIncompleteActivitiesCount',
            'tasksWithDeadlines',
            'recentActivities',
            'totalHoursSpent'
        ));
    }
    
}
