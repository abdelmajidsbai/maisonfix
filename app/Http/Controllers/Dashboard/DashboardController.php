<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use App\Models\Order;
use App\Models\ServiceOrder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $totalorders=Order::count();
        $totalservices=ServiceOrder::count();

        $total = Visitor::sum('count'); // Total depuis le début
        $today = Visitor::where('visited_date', today())->value('count') ?? 0;




        $visiteurs = Visitor::orderBy('visited_date', 'asc')
        ->where('visited_date', '>=', now()->subDays(6))
        ->get(['visited_date', 'count']);

        $labels_v = $visiteurs->pluck('visited_date');
        $totals_v = $visiteurs->pluck('count');

        $orders = Order::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as total'))
                    ->where('created_at', '>=', now()->subDays(7))
                    ->groupBy('date')
                    ->orderBy('date')
                    ->get();

        $labels_o = $orders->pluck('date');
        $totals_o = $orders->pluck('total');


        $services=ServiceOrder::select(DB::raw('DATE(created_at) as date'),DB::raw('COUNT(*) as total'))
            ->where('created_at','>=',now()->subDay(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        
        $labels_s=$services->pluck('date');
        $totals_s=$services->pluck('total');
             

        return view('dashboard.dashboard_home', compact('total','totalorders','totalservices','labels_o', 'totals_o','labels_s','totals_s','labels_v','totals_v'));
    }
}
