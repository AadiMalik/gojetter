<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        return view('home');
    }

    public function filterDashboard(Request $request)
    {
        $type = $request->filter ?? 'daily';

        $pdo = DB::getPdo();
        $stmt = $pdo->prepare("CALL GetDashboardStats(:type)");
        $stmt->bindParam(':type', $type, PDO::PARAM_STR);
        $stmt->execute();

        $summary = $stmt->fetchAll(PDO::FETCH_OBJ);
        $stmt->nextRowset();
        $line_data = $stmt->fetchAll(PDO::FETCH_OBJ);
        $summary = $summary[0];

        $initialData = [
            'approved_users' => $summary->approved_users,
            'total_users' => $summary->total_users,
            'total_tours' => $summary->total_tours,
            'total_bookings' => $summary->total_bookings,
            'total_orders' => $summary->total_orders,
            'total_earnings' => $summary->total_earnings,
            'chart_data' => $line_data
        ];

        // Prepare chart labels and data separately
        $labels = array_map(fn($row) => $row->label, $line_data);
        $data   = array_map(fn($row) => (float) $row->total_amount, $line_data);

        return response()->json([
            'view' => view('partials.dashboard', compact('initialData'))->render(),
            'chart' => [
                'labels' => $labels,
                'data' => $data
            ],
            'data' => $initialData // <-- Add this
        ]);
    }
}
