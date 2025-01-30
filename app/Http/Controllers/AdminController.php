<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Import User model
use App\Models\Activity; // Import Activity model
use App\Models\Task; // Import Task model
use App\Models\Meeting; // Import Meeting model

class AdminController extends Controller
{
    // Admin Dashboard
    public function dashboard()
    {
        // Metrics for tasks
        $totalTasks = Task::count();
        $tasksByPriority = Task::select('priority', \DB::raw('count(*) as total'))
            ->groupBy('priority')
            ->pluck('total', 'priority')
            ->toArray();

        // Metrics for activities
        $totalActivities = Activity::count();
        $completedActivities = Activity::where('status', 'Completed')->count();
        $completionRate = $totalActivities > 0 ? round(($completedActivities / $totalActivities) * 100, 2) : 0;

        // Pass data to the view
        return view('admin.dashboard', [
            'users' => User::all(),
            'totalTasks' => $totalTasks,
            'tasksByPriority' => $tasksByPriority,
            'completionRate' => $completionRate,
            'completedActivities' => $completedActivities,
            'totalActivities' => $totalActivities,
        ]);
    }

    // View a specific user's activities
    public function viewUserActivities($userId)
    {
        $activities = Activity::where('user_id', $userId)->get();
        return view('admin.user-activities', compact('activities'));
    }


    // Search for activities by title or date
    public function searchActivities(Request $request)
    {
        $query = Activity::query();

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $activities = $query->get();

        return view('admin.search-results', compact('activities'));
    }

    // Filter activities by status
    public function filterByStatus(Request $request)
    {
        $status = $request->status; // e.g., Completed, In Progress, Pending
        $activities = Activity::where('status', $status)->get();

        return view('admin.filtered-activities', compact('activities'));
    }
   
public function getSummary(Request $request)
{
    [$startDate, $endDate] = getDateRange($request->input('type', 'weekly'));

    $totalActivities = Activity::whereBetween('created_at', [$startDate, $endDate])->count();
    $statusCounts = Activity::whereBetween('created_at', [$startDate, $endDate])
        ->select('status', DB::raw('count(*) as total'))
        ->groupBy('status')
        ->get();

    return response()->json([
        'totalActivities' => $totalActivities,
        'statusCounts' => $statusCounts,
    ]);
}

// View all tasks assigned to users
public function viewAllTasks()
{
    // Fetch all tasks with user details
    $tasks = Task::with('user')->get(); // Get all tasks along with user data
    
    return view('admin.tasks', compact('tasks'));
}

// View all activities added by users with optional user filtering
public function viewAllActivities(Request $request)
{
    $users = User::all(); // Fetch all users for the dropdown
    $selectedUser = $request->input('user_id'); // Get the selected user ID from the request

    // Fetch activities, optionally filtering by the selected user
    $activities = Activity::with('user')
        ->when($selectedUser, function ($query, $selectedUser) {
            return $query->where('user_id', $selectedUser);
        })
        ->get();

    return view('admin.activities', compact('activities', 'users', 'selectedUser'));
}


// Show the task assignment form
public function showAssignTaskForm()
{
    $users = User::all(); // Fetch all users
    return view('admin.assign-task', compact('users'));
}

// Store the assigned task
public function storeTask(Request $request)
{
    $validated = $request->validate([
        'user_id' => 'required|exists:users,id',
        'title' => 'required|string|max:255',
        'description' => 'required|string|nullable',
        'priority' => 'required|in:Low,Medium,High',
        'due_date' => 'required|date',
    ]);

    Task::create([
        'user_id' => $validated['user_id'],
        'title' => $validated['title'],
        'description' => $validated['description'],
        'priority' => $validated['priority'],
        'due_date' => $validated['due_date'],
    ]);

    return redirect()->route('admin.viewAllTasks')->with('success', 'Task assigned successfully.');
}
public function deleteTask($id)
{
    $task = Task::findOrFail($id);
    $task->delete();

    return redirect()->route('admin.viewAllTasks')->with('success', 'Task deleted successfully.');
}

public function manageUsers()
{
    // Fetch all users with pagination for better performance in case of a large number of users
    $users = User::paginate(10);

    return view('admin.manage-users', compact('users'));
}
public function editUser($id)
{
    // Find the user by ID or throw a 404 if not found
    $user = User::findOrFail($id);

    return view('admin.edit-user', compact('user'));
}
public function updateUser(Request $request, $id)
{
    // Validate the input
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'role' => 'required|string|in:admin,member', // Validate role as a string
    ]);

    // Find the user and update details
    $user = User::findOrFail($id);
    $user->update([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'role' => $validated['role'], // Update the role
    ]);

    return redirect()->route('admin.manageUsers')->with('success', 'User updated successfully.');
}

public function deleteUser($id)
{
    // Find the user and delete
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->route('admin.manageUsers')->with('success', 'User deleted successfully.');
}
// Edit activity
public function editActivity($id)
{
    $activity = Activity::findOrFail($id);
    $users = User::all();
    return view('admin.edit-activity', compact('activity', 'users'));
}

// Delete activity
public function deleteActivity($id)
{
    $activity = Activity::findOrFail($id);
    $activity->delete();
    return redirect()->route('admin.viewAllActivities')->with('success', 'Activity deleted successfully.');
}
public function updateActivity(Request $request, $id)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'status' => 'required|in:Pending,In Progress,Completed',
        'user_id' => 'nullable|exists:users,id',
    ]);

    $activity = Activity::findOrFail($id);
    $activity->update([
        'title' => $validated['title'],
        'description' => $validated['description'],
        'status' => $validated['status'],
        'user_id' => $validated['user_id'] ?? $activity->user_id, // Preserve existing user if no new one is selected
    ]);

    return redirect()->route('admin.viewAllActivities')->with('success', 'Activity updated successfully.');
}
public function showCreateMeetingForm()
{
    $users = User::all();
    return view('admin.create-meeting', compact('users'));
}
public function storeMeeting(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'start_time' => 'required|date',
        'end_time' => 'required|date|after:start_time',
        'users' => 'required|array',
        'users.*' => 'exists:users,id',
    ]);

    $meeting = Meeting::create([
        'title' => $validated['title'],
        'description' => $validated['description'],
        'start_time' => $validated['start_time'],
        'end_time' => $validated['end_time'],
    ]);

    $meeting->users()->attach($validated['users']);

    // Send notifications to invited users
    foreach ($validated['users'] as $userId) {
        $user = User::find($userId);
        $user->notify(new \App\Notifications\MeetingNotification($meeting));
    }
    dd($request->all());


    return redirect()->route('admin.dashboard')->with('success', 'Meeting created successfully, and invitations have been sent.');
}

}