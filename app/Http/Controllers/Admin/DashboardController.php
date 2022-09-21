<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {

        $monthly_sales = Order::whereMonth(
            'created_at',
            Carbon::now()->format('m')
        )->whereYear(
            'created_at',
            Carbon::now()->format('Y')
        )->sum('total_price');

        $pending_orders = Order::where('status', '0')->count();
        $completed_orders = Order::where('status', '1')->count();
        $users = User::where('role_as', '0')->count();
        return view('admin.dashboard', compact('pending_orders', 'completed_orders', 'monthly_sales', 'users'));
    }
}
