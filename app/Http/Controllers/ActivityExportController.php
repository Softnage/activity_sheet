<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ActivityExportController extends Controller
{
    public function exportCsv(Request $request)
    {
        $activities = $this->filterActivities($request);

        // Generate CSV content
        $csvData = [];
        foreach ($activities as $activity) {
            $csvData[] = [
                'Title' => $activity->title,
                'Status' => $activity->status,
                'Created At' => $activity->created_at->format('d M, Y H:i'),
            ];
        }

        $fileName = 'activities_export_' . now()->format('Y_m_d_H_i_s') . '.csv';
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",
        ];

        $callback = function () use ($csvData) {
            $file = fopen('php://output', 'w');
            fputcsv($file, array_keys($csvData[0]));
            foreach ($csvData as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPdf(Request $request)
    {
        $activities = $this->filterActivities($request);

        $pdf = Pdf::loadView('exports.activities_pdf', compact('activities'));
        return $pdf->download('activities_export_' . now()->format('Y_m_d_H_i_s') . '.pdf');
    }

    private function filterActivities(Request $request)
    {
        $query = Activity::query();

        // Filter by user (if not admin, only show their activities)
        if (!Auth::user()->is_admin) {
            $query->where('user_id', Auth::id());
        }

        // Filter by week
        if ($request->has('week')) {
            $weekStart = Carbon::parse($request->get('week'))->startOfWeek();
            $weekEnd = $weekStart->copy()->endOfWeek();
            $query->whereBetween('created_at', [$weekStart, $weekEnd]);
        }

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->get('status'));
        }

        return $query->get();
    }
}

