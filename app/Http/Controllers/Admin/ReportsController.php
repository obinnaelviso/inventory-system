<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Services\ReportService;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    protected $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function accomplishedRequests(Request $request)
    {
        $requests = $this->reportService->getAccomplishedRequests($request->dept, $request->start_date, $request->end_date);
        $depts = Department::all();
        $title = "Accomplished Requests";
        return view('admin.reports.requests', compact('requests', 'depts', 'title'));
    }

    public function pendingRequests(Request $request)
    {
        $requests = $this->reportService->getPendingRequests($request->dept, $request->start_date, $request->end_date);
        $depts = Department::all();
        $title = "Pending Requests";
        return view('admin.reports.requests', compact('requests', 'depts', 'title'));
    }

    public function exportRequests(Request $request)
    {
        $title = $request->title;
        $dept = $request->dept;
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        if ($title == 'Accomplished Requests') {
            $requests = $this->reportService->getAccomplishedRequests($dept, $startDate, $endDate);
        } else {
            $requests = $this->reportService->getPendingRequests($dept, $startDate, $endDate);
        }
        return view('admin.reports.export-requests', compact('requests', 'title'));
    }

    public function lowStocks()
    {
        $products = $this->reportService->getLowStocks();
        return view('admin.reports.low-stocks', compact('products'));
    }

    public function exportLowStocks(Request $request)
    {
        $products = $this->reportService->getLowStocks();
        return view('admin.reports.export-low-stocks', compact('products'));
    }
}
