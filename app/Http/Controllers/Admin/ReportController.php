<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Concrete\ReportService;
use App\Traits\ResponseAPI;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use ReflectionClass;
use App\Enums\BookingStatus;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

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
        $parms->status = $request->status;

        $pdf = Pdf::loadView('/reports/booking_report/partials.report', compact('parms'));
        return $pdf->stream('Booking Report .pdf');
    }
    public function getPreviewBookingReport(Request $request)
    {
        $parms['data'] = $this->report_service->getBookingReport($request->all());

        $parms = (object)$parms;
        $parms->start_date = $request->start_date;
        $parms->end_date = $request->end_date;
        $parms->status = $request->status;

        return view('/reports/booking_report/partials.report', compact('parms'));
    }

    ////////////////////////////Booking Detail Report////////////////////////////////
    public function bookingDetailReport()
    {
        $reflection = new ReflectionClass(BookingStatus::class);
        $statuses = $reflection->getConstants();
        return view('reports/booking_detail_report/index',compact('statuses'));
    }
    public function getBookingDetailReport(Request $request)
    {
        $parms['data'] = $this->report_service->getBookingDetailReport($request->all());

        $parms = (object)$parms;
        $parms->start_date = $request->start_date;
        $parms->end_date = $request->end_date;
        $parms->status = $request->status;

        $pdf = Pdf::loadView('/reports/booking_detail_report/partials.report', compact('parms'));
        return $pdf->stream('Booking Report .pdf');
    }
    public function getPreviewBookingDetailReport(Request $request)
    {
        $parms['data'] = $this->report_service->getBookingDetailReport($request->all());

        $parms = (object)$parms;
        $parms->start_date = $request->start_date;
        $parms->end_date = $request->end_date;
        $parms->status = $request->status;

        return view('/reports/booking_detail_report/partials.report', compact('parms'));
    }

    ////////////////////////////Order Report////////////////////////////////
    public function orderReport()
    {
        $reflection = new ReflectionClass(BookingStatus::class);
        $statuses = $reflection->getConstants();
        return view('reports/order_report/index',compact('statuses'));
    }
    public function getOrderReport(Request $request)
    {
        $parms['data'] = $this->report_service->getOrderReport($request->all());

        $parms = (object)$parms;
        $parms->start_date = $request->start_date;
        $parms->end_date = $request->end_date;
        $parms->status = $request->status;

        $pdf = Pdf::loadView('/reports/order_report/partials.report', compact('parms'));
        return $pdf->stream('Order Report .pdf');
    }
    public function getPreviewOrderReport(Request $request)
    {
        $parms['data'] = $this->report_service->getOrderReport($request->all());

        $parms = (object)$parms;
        $parms->start_date = $request->start_date;
        $parms->end_date = $request->end_date;
        $parms->status = $request->status;

        return view('/reports/order_report/partials.report', compact('parms'));
    }

    ////////////////////////////Order Detail Report////////////////////////////////
    public function orderDetailReport()
    {
        $reflection = new ReflectionClass(BookingStatus::class);
        $statuses = $reflection->getConstants();
        return view('reports/order_detail_report/index',compact('statuses'));
    }
    public function getOrderDetailReport(Request $request)
    {
        $parms['data'] = $this->report_service->getOrderDetailReport($request->all());

        $parms = (object)$parms;
        $parms->start_date = $request->start_date;
        $parms->end_date = $request->end_date;
        $parms->status = $request->status;

        $pdf = Pdf::loadView('/reports/order_detail_report/partials.report', compact('parms'));
        return $pdf->stream('Order Detail Report .pdf');
    }
    public function getPreviewOrderDetailReport(Request $request)
    {
        $parms['data'] = $this->report_service->getOrderDetailReport($request->all());

        $parms = (object)$parms;
        $parms->start_date = $request->start_date;
        $parms->end_date = $request->end_date;
        $parms->status = $request->status;

        return view('/reports/order_detail_report/partials.report', compact('parms'));
    }
}
