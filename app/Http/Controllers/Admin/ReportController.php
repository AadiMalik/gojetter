<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Concrete\ReportService;
use App\Traits\ResponseAPI;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use ReflectionClass;
use App\Enums\BookingStatus;

class ReportController extends Controller
{
    use ResponseAPI;
    protected $report_service;

    public function __construct(ReportService $report_service)
    {
        $this->report_service = $report_service;
    }

    ////////////////////////////Customer Report////////////////////////////////
    public function customerReport()
    {
        return view('reports/customer_report/index');
    }
    public function getCustomerReport(Request $request)
    {
        $parms['data'] = $this->report_service->getCustomerReport($request->all());

        $parms = (object)$parms;
        $parms->start_date = $request->start_date;
        $parms->end_date = $request->end_date;

        $pdf = Pdf::loadView('/reports/customer_report/partials.report', compact('parms'));
        return $pdf->stream('Customer Report .pdf');
    }
    public function getPreviewCustomerReport(Request $request)
    {
        $parms['data'] = $this->report_service->getCustomerReport($request->all());

        $parms = (object)$parms;
        $parms->start_date = $request->start_date;
        $parms->end_date = $request->end_date;

        return view('/reports/customer_report/partials.report', compact('parms'));
    }

    ////////////////////////////Booking Report////////////////////////////////
    public function bookingReport()
    {
        $reflection = new ReflectionClass(BookingStatus::class);
        $statuses = $reflection->getConstants();
        return view('reports/booking_report/index',compact('statuses'));
    }
    public function getBookingReport(Request $request)
    {
        $parms['data'] = $this->report_service->getBookingReport($request->all());

        $parms = (object)$parms;
        $parms->start_date = $request->start_date;
        $parms->end_date = $request->end_date;

        $pdf = Pdf::loadView('/reports/booking_report/partials.report', compact('parms'));
        return $pdf->stream('Booking Report .pdf');
    }
    public function getPreviewBookingReport(Request $request)
    {
        $parms['data'] = $this->report_service->getBookingReport($request->all());

        $parms = (object)$parms;
        $parms->start_date = $request->start_date;
        $parms->end_date = $request->end_date;

        return view('/reports/booking_report/partials.report', compact('parms'));
    }
}
