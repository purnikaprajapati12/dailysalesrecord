<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Order;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function employeeIndex()
    {
        return view('frontend.employee-index');
    }


    public function adminIndex()
    {
        $totalAmount = Order::sum('total');
        $totalItem = Item::whereIn('category_id', ['1', '2'])->count();
        $vegItem = Item::where('category_id', 1)->count();
        $nonVegItem = Item::where('category_id', 2)->count();
        $beverage = Item::where('category_id', 3)->count();
        $items = Item::all();
        $veg = Item::where('category_id', 1)->get();
        $nonveg = Item::where('category_id', 2)->take(10)->get();
        $bev = Item::where('category_id', 3)->get();

        $topItemsVeg = Order::join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('item', 'item.id', '=', 'order_details.item_id')
            ->where('item.category_id', 1)
            ->select('item.name', \DB::raw('SUM(order_details.quantity) as total_quantity'))
            ->groupBy('item.id', 'item.name')
            ->orderByDesc('total_quantity')
            ->take(10)
            ->get()->toArray();

        $topItemsNonVeg = Order::join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('item', 'item.id', '=', 'order_details.item_id')
            ->where('item.category_id', 2)
            ->select('item.name', \DB::raw('SUM(order_details.quantity) as total_quantity'))
            ->groupBy('item.id', 'item.name')
            ->orderByDesc('total_quantity')
            ->take(10)
            ->get()->toArray();

        $monthlyOrders = Order::select(
            DB::raw('YEAR(date) as year'),
            DB::raw('MONTH(date) as month'),
            DB::raw('SUM(total) as total_sales')
        )
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get()->toArray();
        $monthlySalesData = [];
        for ($month = 1; $month <= 12; $month++) {
            $monthName = date('M', mktime(0, 0, 0, $month, 1));
            $data = array_filter($monthlyOrders, function ($order) use ($month) {
                return $order['month'] == $month;
            });
            $data = array_values($data);
            $monthlySalesData[] = [
                'month' => $monthName,
                'total' => isset($data[0]['total_sales']) ? $data[0]['total_sales'] : 0
            ];
        }
        $monthlySales = [
            'months' => array_column($monthlySalesData, 'month'),
            'sales' => array_column($monthlySalesData, 'total'),
            'year' => date('Y')
        ];
        $dailyOrders = Order::select(
            DB::raw('DATE(date) as date'),
            DB::raw('SUM(total) as total_sales')
        )
            ->groupBy('date')
            ->orderBy('date')
            ->get()->toArray();
        $dailySalesData = [];
        $currentYear = date('Y'); // Get the current year
        $currentMonth = date('m'); // Get the current month
        // Get the number of days in the specified month
        $numDays = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

        // Loop through each day of the month
        for ($day = 1; $day <= $numDays; $day++) {
            // Create a DateTime object for the current day
            $date = new DateTime("$currentYear-$currentMonth-$day");

            $data = array_filter($dailyOrders, function ($order) use ($date) {
                return $order['date'] == $date->format('Y-m-d');
            });
            $data = array_values($data);
            $dailySalesData[] = [
                'date' => $date->format('d'),
                'total' => isset($data[0]['total_sales']) ? $data[0]['total_sales'] : 0
            ];
        }
        $dailySales = [
            'daily' => array_column($dailySalesData, 'date'),
            'sales' => array_column($dailySalesData, 'total'),
            'year' => $currentYear,
            'month' => date('M')
        ];

        $weeklyOrders = Order::select(
            DB::raw('DAYNAME(date) as day_of_week'),
            DB::raw('DATE(date) as date'),
            DB::raw('SUM(total) as total_sales')
        )
            ->groupBy('day_of_week', 'date')
            ->orderBy('date')
            ->get()->toArray();
        // Get the current date
        $currentDate = new DateTime();
        $currentDate->modify('this week');
        $weeklySalesData = [];

        // Loop through each day of the week
        for ($i = 0; $i < 7; $i++) {
            $weekDate = $currentDate->format('Y-m-d');
            $weekDay = $currentDate->format('D');
            $currentDate->modify('+1 day');

            $data = array_filter($weeklyOrders, function ($order) use ($weekDate) {
                return $order['date'] == $weekDate;
            });
            $data = array_values($data);
            $weeklySalesData[] = [
                'day' => $weekDay,
                'total' => isset($data[0]['total_sales']) ? $data[0]['total_sales'] : 0
            ];
        }
        $weeklySales = [
            'weekly' => array_column($weeklySalesData, 'day'),
            'sales' => array_column($weeklySalesData, 'total'),
        ];
        return view('admin.admin-index', compact('topItemsVeg', 'topItemsNonVeg', 'monthlySales', 'dailySales', 'weeklySales'));
    }
}
