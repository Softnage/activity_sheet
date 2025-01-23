<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Models\User;

class ActivityController extends Controller
{
    // Show the form for creating a new activity
    public function create()
    {
        return view('activities.create');
    }

    // Store the newly created activity
    public function store(Request $request)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'status' => 'required|string|in:Pending,In Progress,Completed',
        ]);

        // Create the activity
        Activity::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'date' => $validatedData['date'],
            'status' => $validatedData['status'],
            'user_id' => auth()->id(), // assuming user is authenticated
        ]);

        // Redirect with success message
        return redirect()->route('activities.index')->with('success', 'Activity added successfully!');
    }
    public function index(Request $request)
    {
        $query = Activity::query();

        // Search by title
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Get activities with pagination
        $activities = $query->where('user_id', auth()->id())->paginate(10);

        return view('activities.index', compact('activities'));
    }

    public function edit($id)
{
    $activity = Activity::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
    return view('activities.edit', compact('activity'));
}

public function update(Request $request, $id)
{
    $activity = Activity::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'date' => 'required|date',
        'status' => 'required|in:Pending,In Progress,Completed',
    ]);

    $activity->update($validated);

    return redirect()->route('activities.index')->with('success', 'Activity updated successfully.');
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

}
