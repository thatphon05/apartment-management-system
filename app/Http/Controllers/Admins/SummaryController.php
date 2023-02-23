<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExportSummaryRequest;
use App\Services\SummaryService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\View\View;

class SummaryController extends Controller
{

    public function __construct(private readonly SummaryService $summaryService)
    {
    }

    public function index(): View
    {
        return view('admins.summary.index');
    }

    public function exportPdf(ExportSummaryRequest $request)
    {
        $pdf = Pdf::loadView('pdfs.summary',
            $this->summaryService->getSummaryMonth($request)
        );

        return $pdf->stream(now() . '.pdf');
    }

}
