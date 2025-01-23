<?php

namespace App\Http\Controllers;
use App\Models\Task;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // Display tasks assigned to the logged-in user
    public function showAssignedTasks()
    {
        // Assuming you're using Laravel's authentication system
        // get tasks assigned to the logged-in user
        $tasks = Task::where('user_id', Auth::id())->get();
    
        return view('activities.tasks', compact('tasks'));
    }

    // Mark the task as received and create an activity
    public function markAsReceived($taskId)
    {
        // Find the task by ID
        $task = Task::findOrFail($taskId);

        // Ensure the task belongs to the authenticated user
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('activities.tasks')->with('error', 'You are not authorized to mark this task.');
        }

        // Update the task status to 'received'
        $task->status = 'Received';
        $task->save();

        // Create a new activity record with the current timestamp
        Activity::create([
            'user_id' => Auth::id(),
            'task_id' => $task->id,
            'title' => $task->title,
            'description' => $task-> task_description,
            'status' => 'In Progress',
            'created_at' => now(), // Current timestamp
        ]);

        // Redirect back with success message
        return redirect()->route('activities.tasks')->with('success', 'Task marked as received.');
    }
    public function deleteTask($taskId)
    {
        // Find the task by ID
        $task = Task::findOrFail($taskId);

        // Ensure the task belongs to the authenticated user
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('activities.tasks')->with('error', 'You are not authorized to delete this task.');
        }

        // Check if the task's status is 'received'
        if ($task->status !== 'received') {
            return redirect()->route('activities.tasks')->with('error', 'Only received tasks can be deleted.');
        }

        // Delete the task
        $task->delete();

        // Redirect back with success message
        return redirect()->route('activities.tasks')->with('success', 'Task deleted successfully.');
    }

}

