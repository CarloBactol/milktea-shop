<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;

class DashboardController extends Controller
{
    public function index()
    {

        $yearly_income = DB::table('orders')
            ->whereYear('created_at', Carbon::now()->format('Y'))
            ->where('status', '3')
            ->sum('total_price');

        $pending_orders = Order::where('status', '0')->count();
        $completed_orders = Order::where('status', '3')->count();
        $users = User::where('role_as', '0')->count();
        return view('admin.dashboard', compact('pending_orders', 'completed_orders', 'users', 'yearly_income'));
    }

    public function orderChart(Request $request)
    {
        $entries =  Order::select(
            // DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total_price) as total_price'),
            DB::raw('COUNT(*) as count'),
        )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $labels = [
            1 => 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
        ];

        $total = $count = [];

        foreach ($entries as $entry) {
            $total[$entry->month] = $entry->total_price;
            $count[$entry->month] = $entry->count;
        }

        foreach ($labels as $month => $name) {
            if (!array_key_exists($month, $total)) {
                $total[$month] = 0;
            }

            if (!array_key_exists($month, $count)) {
                $count[$month] = 0;
            }
        }

        ksort($total);
        ksort($count);

        return [
            'labels' => array_values($labels),
            'datasets' => [
                [
                    'label' => 'Total Sales ₱',
                    'data' => array_values($total),
                ],
                [
                    'label' => 'Order #',
                    'data' => array_values($count),
                ],

            ],
        ];
    }

    public function generatePdf()
    {
        $monthly_income = DB::table('orders')
            ->whereMonth('created_at', Carbon::now()->format('m'))
            ->where('status', '1')
            ->sum('total_price');

        $orders = DB::table('orders')
            ->whereMonth('created_at', Carbon::now()->format('m'))
            ->where('status', '1')
            ->get();

        // $orders =  Order::select(
        //     // DB::raw('YEAR(created_at) as year'),
        //     DB::raw('MONTH(created_at) as month'),
        //     DB::raw('SUM(total_price) as total_price'),
        //     DB::raw('COUNT(*) as count'),
        // )
        //     ->groupBy('month')
        //     ->orderBy('month')
        //     ->get();
        $pdf = PDF::loadView('admin.pdf.index', compact('orders', 'monthly_income'));
        return $pdf->stream();
    }
}
