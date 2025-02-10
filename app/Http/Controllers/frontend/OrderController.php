<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderDetail;

class OrderController extends Controller
{
    public function orders()
    {
        $orders = Order::with('order_detail')->orderBy('created_at', 'desc')->get();
        return view('admin.manage-orders', compact('orders'));
    }

    public function create_orders()
    {
        $items = Item::all();
        $url = url('/create-sales');
        $title = "Create order";
        $label = "Create";
        $order = new Order();
        $data = compact('url', 'title', 'label', 'order', 'items');
        return view('admin.create-orders')->with($data);
    }
    public function store(Request $request)
    {
        // $incommingFields = $request->validate([
        //     // 'order_id' => ['required', Rule::unique('order', 'order_id')],
        //     'customer_name' => ['required'],
        //     'item_id' => 'required',
        //     'quantity' => 'required',
        //     'price' => 'required',
        //     // 'amount' => 'required',
        //     // 'total' => 'required'
        // ]);

        $previous_order = Order::latest()->first();
        if ($previous_order != null) {
            $code = explode('-', $previous_order->order_code);
            $count = (int)$code[1] + 1;
            $order_code = 'OT-' . $count;
        } else {
            $order_code = 'OT-' . 1;
        }
        $customer_name = $request->customername;
        $date = $request->date;
        $discount = $request->discount;
        $itemDetails = $request->items;
        $total = 0;
        foreach ($itemDetails as $row) {
            $amount = $row['quantity'] * $row['price'];
            $total += $amount;
        }
        $order = Order::create([
            'order_code' => $order_code,
            'customer_name' => $customer_name,
            'date' => date('Y-m-d', strtotime($date)),
            'discount' => $discount,
            'total' => $total - $discount
        ]);

        $order_detail = new OrderDetail();
        foreach ($itemDetails as $row) {
            $row['order_id'] = $order->id;
            $row['amount'] = $row['quantity'] * $row['price'];
            $order_detail->create($row);
        }
        return redirect('manage-sales')->with('success', 'created successfully');

        $orders = Order::with('order_detail')->orderBy('date', 'desc')->get();
    }

    public function view($id)
    {
        $order = Order::with('order_detail')->where('id', $id)->first();
        return view('admin.view-order', compact('order'));
    }

    public function delete($id)
    {
        $res = Order::find($id);
        if (!is_null($res)) {
            $detail = OrderDetail::where('order_id', $id)->delete();
            $res->delete();
        }
        return redirect()->back()->with('message', 'sales record deleted');
    }

    public function daily_sales_report(Request $request)
    {
        $start = $request->query('start');
        $end = $request->query('end');
        $start = ($start == null) ? date('Y-m-d') : $start;
        $end = ($end == null) ? date('Y-m-d') : $end;
        $orders = Order::where('date', '>=', $start)->where('date', '<=', $end)->get();
        
        return view('admin.daily-sales-report', compact('orders', 'start', 'end'));
    }
}
