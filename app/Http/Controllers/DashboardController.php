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

        $overdueTasksCount = Task::where('user_id', $userId)
            ->where('status', '!=', 'received')
            ->where('due_date', '<', now())
            ->count();

        $upcomingDeadlinesCount = Task::where('user_id', $userId)
            ->where('status', '!=', 'received')
            ->where('due_date', '>=', now())
            ->count();

        $tasksWithDeadlines = Task::where('user_id', $userId)
            ->where('status', '!=', 'received')
            ->where('due_date', '>=', now())
            ->orderBy('due_date', 'asc')
            ->take(5)
            ->get();

        $recentActivities = Activity::where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'pendingTasksCount',
            'receivedTasksCount',
            'overdueTasksCount',
            'upcomingDeadlinesCount',
            'tasksWithDeadlines',
            'recentActivities'
        ));
    }
}
