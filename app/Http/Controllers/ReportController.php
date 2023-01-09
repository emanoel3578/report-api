<?php

namespace App\Http\Controllers;

use App\Http\Services\Report\ReportService;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    private ReportService $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function __invoke()
    {
        $reportsTablesInformations = $this->reportService->getReports();
        return response()->json(['Report Information' => $reportsTablesInformations]);
    }
}
