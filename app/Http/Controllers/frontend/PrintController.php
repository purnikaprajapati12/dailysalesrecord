<?php

namespace App\Http\Controllers;
use App\Models\Order;

use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function printInvoice($id)
    {
        $order = Order::with('order_detail.item')->find($id);
        if (!$order) {
            abort(404, 'Order not found');
        }
        return view('print.invoice', compact('order'));
    }

    // public function showReport(Request $request)
    // {
        
    //     $start = $request->input('start');
    //     $end = $request->input('end');

    //     if ($start && $end) {
    //         $orders = Order::whereBetween('date', [$start, $end])->get();
    //     } else {
    //         $orders = Order::all(); 
    //     }

    //     return view('admin.daily-sales-report', compact('orders', 'start', 'end'));
    // }
}
