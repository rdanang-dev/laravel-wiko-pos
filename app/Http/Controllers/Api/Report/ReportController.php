<?php

namespace App\Http\Controllers\Api\Report;

use App\Http\Controllers\Controller;
use App\Http\Resources\AllTransactionReportResource;
use App\Http\Resources\DashboardDailyReportResource;
use App\Http\Resources\DashboardRecentTransactionResource;
use App\Http\Resources\DashboardWeeklyReportResource;
// use App\Http\Resources\DailyReportResource;
// use App\Http\Resources\DashboardWeeklyReportResource;
// use App\Http\Resources\YearlyReportResource;
use App\Http\Resources\DashboardYearlyReportResource;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function dashboardDailyReport()
    {
        $currentDate = Carbon::now();
        $currentDateString = $currentDate->toDateString();
        $getDaily = Order::selectRaw("sum(total_price) as order_total,count(id) as total_transaction, (DATE_FORMAT(created_at,'%Y-%m-%d')) as order_date, status")
            ->where('status', 2)
            ->groupBy('order_date')
            ->having('order_date', $currentDateString)
            ->first();

        if (!$getDaily) {
            return response()->json(['data' => [
                'order_total' => 0,
                'total_transaction' => 0,
                'order_date' => $currentDateString
            ]]);
        }

        // dd($getDaily);
        return new DashboardDailyReportResource($getDaily);
        // return response()->json(['data' => $getDaily]);
    }

    public function dashboardWeeklyReport()
    {
        $currentDate = Carbon::now()->addDay();
        $currentDateString = $currentDate->toDateString();
        $lastWeek = $currentDate->subWeek()->toDateString();
        $getWeekly = Order::selectRaw("sum(total_price) as order_total,count(id) as total_transaction, (DATE_FORMAT(created_at,'%Y-%m-%d')) as order_date")
            ->where('status', 2)
            ->groupBy('order_date')
            ->having('order_date', '>=', $lastWeek)
            ->having('order_date', '<=', $currentDateString)
            ->get();
        // dd($getWeekly);
        return DashboardWeeklyReportResource::collection($getWeekly);
        // return response()->json(['data' => $getWeekly]);
    }

    public function dasboardYearlyReport()
    {
        $getYearly = Order::selectRaw("sum(total_price) as order_total, MIN(created_at) as first_trans , MAX(created_at) as last_trans,   YEAR(created_at) as tahun")
            ->where('status', 2)
            ->groupBy('tahun')
            ->having('tahun', date('Y'))
            ->first();

        if (!$getYearly) {
            return response()->json(['data' => [
                'order_total' => 0,
                'bulan' => 'no transaction yet',
                'tahun' => Carbon::now()->format('Y'),
            ]]);
        }

        return new DashboardYearlyReportResource($getYearly);
        // return response()->json(['data' => $getYearly]);
    }

    public function dashboardRecentTransaction()
    {
        $getRecent = Order::selectRaw('sum(total_price) as order_total,employee_id, order_code, created_at')
            ->with('employee')
            ->where('status', 2)
            ->groupBy('created_at')
            ->limit(5)
            ->orderBy('created_at', 'desc')
            ->get();
        // return response()->json(['data' => $getRecent]);
        return DashboardRecentTransactionResource::collection($getRecent);
    }

    public function allTransactionReport()
    {
        $getAll = Order::selectRaw("sum(total_price) as order_total,employee_id, order_code, created_at, id")
            ->with('employee')
            ->with('details')
            // ->with('menu')
            // ->with('order')
            ->where('status', 2)
            ->groupBy('created_at')
            ->orderBy('created_at', 'desc')
            ->get();
        // return response()->json(['data' => $getAll]);
        return AllTransactionReportResource::collection($getAll);
    }
}