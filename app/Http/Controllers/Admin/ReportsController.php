<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ReportService;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    protected $reportService;

    public function __construct(ReportService $reportService) {
        $this->reportService = $reportService;
    }

    public function accomplishedRequests(Request $request)
    {
        $requests = $this->reportService->getAccomplishedRequests($request->dept);
        $depts = $requests->pluck('request.dept')->unique();
        $title = "Accomplished Requests";
        return view('admin.reports.requests', compact('requests', 'depts', 'title'));
    }

    public function pendingRequests(Request $request)
    {
        $requests = $this->reportService->getPendingRequests($request->dept);
        $depts = $requests->pluck('request.dept')->unique();
        $title = "Pending Requests";
        return view('admin.reports.requests', compact('requests', 'depts', 'title'));
    }

    public function lowStocks()
    {
        $products = $this->reportService->getLowStocks();
        return view('admin.reports.low-stocks', compact('products'));
    }
}
