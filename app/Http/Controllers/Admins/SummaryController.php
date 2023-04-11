<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExportSummaryMonthRequest;
use App\Http\Requests\ExportSummaryOverdueRequest;
use App\Services\SummaryService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;
use Illuminate\View\View;

class SummaryController extends Controller
{
    public function __construct(private readonly SummaryService $summaryService)
    {
    }

    public function summaryMonth(): View
    {
        return view('admins.summary.month');
    }

    public function exportSummaryPdf(ExportSummaryMonthRequest $request): Response
    {
        $pdf = Pdf::loadView(
            'pdfs.summary_month',
            $this->summaryService->getSummaryMonth($request)
        );

        return $pdf->stream(now() . '.pdf');
    }

    public function summaryOverdue(): View
    {
        return view('admins.summary.overdue');
    }

    public function exportOverduePdf(ExportSummaryOverdueRequest $request): Response
    {
        $pdf = Pdf::loadView('pdfs.summary_overdue', [
            'invoices' => $this->summaryService->getSummaryOverdue($request),
        ]);

        return $pdf->stream(now() . '.pdf');
    }
}
