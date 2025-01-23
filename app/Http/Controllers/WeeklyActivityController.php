<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class WeeklyActivityController extends Controller
{
    public function index()
    {
        $activities = Auth::user()->activities; // Get activities for the logged-in user

        // Get current week range (start and end)
        $currentWeekStart = Carbon::now()->startOfWeek();
        $currentWeekEnd = Carbon::now()->endOfWeek();
        
        // Filter activities by the current week's range
        $weeklyActivities = $activities->filter(function ($activity) use ($currentWeekStart, $currentWeekEnd) {
            $activityDate = Carbon::parse($activity->created_at);
            return $activityDate->between($currentWeekStart, $currentWeekEnd);
        });

        // Define time slots
        $timeSlots = [
            '8:00 AM - 9:00 AM' => ['start' => '08:00', 'end' => '09:00'],
            '9:00 AM - 10:00 AM' => ['start' => '09:00', 'end' => '10:00'],
            '10:00 AM - 11:00 AM' => ['start' => '10:00', 'end' => '11:00'],
            '11:00 AM - 12:00 PM' => ['start' => '11:00', 'end' => '12:00'],
            '12:00 PM - 1:00 PM' => ['start' => '12:00', 'end' => '13:00'],
            '1:00 PM - 2:00 PM' => ['start' => '13:00', 'end' => '14:00'],
            '2:00 PM - 3:00 PM' => ['start' => '14:00', 'end' => '15:00'],
            '3:00 PM - 4:00 PM' => ['start' => '15:00', 'end' => '16:00'],
            '4:00 PM - 5:00 PM' => ['start' => '16:00', 'end' => '17:00'],
        ];

        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        // Initialize an empty structure for the table
        $structuredActivities = [];
        foreach ($daysOfWeek as $day) {
            $structuredActivities[$day] = array_fill_keys(array_keys($timeSlots), 'No Activity');
        }

        // Populate the structure with activities for the current week
        foreach ($weeklyActivities as $activity) {
            $day = Carbon::parse($activity->created_at)->format('l'); // Get day of the week
            $time = Carbon::parse($activity->created_at)->format('H:i'); // Get time in 24-hour format

            foreach ($timeSlots as $slot => $range) {
                if ($time >= $range['start'] && $time < $range['end']) {
                    $structuredActivities[$day][$slot] = $activity->title;
                    break;
                }
            }
        }

        // Pass the data to the view
        return view('weekly-activities', compact('structuredActivities', 'timeSlots', 'daysOfWeek', 'currentWeekStart', 'currentWeekEnd'));
    }
}
