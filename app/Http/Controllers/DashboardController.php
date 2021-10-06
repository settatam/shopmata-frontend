<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Store;
use App\Models\Theme;

class DashboardController extends Controller
{
    /**
     * Dashboard Data
     */
    public function index() {
        $store_id = session()->get('store_id');
        if($store_id) {
            $store = Store::find($store_id);      
            if(null !== $store) {
                if($store->step == 4) {
                    $notifications = $store->getDashBoardNotifications();
                    return \Inertia\Inertia::render('Dashboard', compact('notifications'));
                }else if($store->step == 3){
                    return \Redirect::route('register-step-3');
                }else if($store->step == 2){
                    return \Redirect::route('register-step-2');  
                }else if($store->step == 1) {
                    return \Redirect::route('register');
                }  
            }
        }
        return \Redirect::route('register'); 
    }
    

    public function getData()
    {
        try {
            $date = date("Y-m-d");
            $yesterdaysDate = date('Y-m-d', strtotime("-1 days"));

            $totalSales = Order::where('user_id', Auth::id())->sum('total');
            $todaySales = Order::where('user_id', Auth::id())->whereBetween('created_at', [$date . " 00:00:00", $date . " 23:59:59"])->sum('total');
            $ordersToFulfill = Order::where([
                ['user_id', '=', Auth::id()],
                ['status', '=', 'received'],
            ])->whereBetween('created_at', [$date . " 00:00:00", $date . " 23:59:59"])->count('id');
            $paymentToCapture = Order::where([
                ['user_id', '=', Auth::id()],
                ['status', '=', 'paid'],
            ])->whereBetween('created_at', [$date . " 00:00:00", $date . " 23:59:59"])->count('id');
            $highRiskOrder = 0;

            $yesterdaysSales = Order::where('user_id', Auth::id())->whereBetween('created_at', [$yesterdaysDate . " 00:00:00", $yesterdaysDate . " 23:59:59"])->sum('total');
            $yesterdaysSales = $yesterdaysSales < 1 ? 1 : $yesterdaysSales;
            $percentage = ($todaySales / $yesterdaysSales) * 100;

            $graphData = $this->getGraphData();

            $dashboard = [
                'totalSales' => $totalSales,
                'todaySales' => $todaySales,
                'ordersToFulfill' => $ordersToFulfill,
                'paymentToCapture' => $paymentToCapture,
                'highRiskOrder' => $highRiskOrder,
                'percentage' => $percentage,
                'graphData' => $graphData
            ];
            return response()->json(['dashboard' => $dashboard], 200);

        } catch (\Exception $e) {
            $exceptionDetails = [
                "message" => $e->getMessage(),
                'file' => basename($e->getFile()),
                'line' => $e->getLine(),
                'type' => class_basename($e),
            ];

            \Log::info("Dashboard Data Exception" . print_r($exceptionDetails, true));

            $notification = [
                "title" => "An Exception Occurred",
                "type" => "failed",
                "message" => $exceptionDetails['message'],
            ];

            return response()->json(['notification' => $notification], 500);
        }

    }

    private function getGraphData()
    {
        $t = Carbon::now();
        $months = ["JAN", 'FEB', "MAR", "APR", "MAY", "JUN", "JUL","AUG", "SEPT", "OCT", "NOV", "DEC"];
        $totalSales = [];

        foreach ($months as $i => $month) {
            $m = $i + 1;
            $startOfMonth = $t->month($m)->startOfMonth()->format('Y-m-d H:i:s');
            $endOfMonth = $t->month($m)->endOfMonth()->format('Y-m-d H:i:s');

            $order = Order::where('user_id', Auth::id())->whereBetween('created_at', [$startOfMonth, $endOfMonth])->sum('total');
            array_push($totalSales, (int)$order);
        }
        
        $data = [
            'months' => $months,
            'sales' => $totalSales
        ];

        \Log::info("Graph Data Retrieved" .print_r($data, true));

        return $data;

    }
}
