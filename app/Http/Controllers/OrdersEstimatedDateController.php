<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrdersEstimatedDateRequest;
use App\Http\Requests\UpdateOrdersEstimatedDateRequest;
use App\Http\Resources\OrderEstimatedDateResource;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderEstimatedDates;
use Carbon\Carbon;

class OrdersEstimatedDateController extends Controller
{

    public function index()
    {
        $orders = OrderEstimatedDates::all();
        return OrderEstimatedDateResource::collection($orders);
    }


    public function store(StoreOrdersEstimatedDateRequest $request, $id)
    {
        $order = Order::findOrFail($id);
        $order_estimated_dates = OrderEstimatedDates::create($request->validated() + ['order_id' => $order->id]);
        $phase = $order_estimated_dates->phase;
        if ($phase == OrderEstimatedDates::INITIAL) {
            $order->status = Order::SHIPPED;
            $order->save();
        } elseif ($phase == OrderEstimatedDates::CONFIRMED) {
            $order->status = Order::ONWAY;
            $order->save();
        } elseif ($phase == OrderEstimatedDates::DELIVERED) {
            $order->status = Order::DELIVERED;
            $start_time = Carbon::parse($order->orderHistory->where('phase' , OrderEstimatedDates::CONFIRMED)->first()->estimated_date
//            initial_date
            );
            $finish_time = Carbon::parse($request->estimated_date);
            $result = $start_time->diffInDays($finish_time, false);
            $order->delay = $result;
            $order->save();

            $supplier = $order->supplier;

            $orders = $supplier->orders()->where('status', Order::DELIVERED)->get();
            $performance = count($orders) > 0 ? array_sum($orders->pluck('delay')->toArray()) / count($orders) : 0;
            $supplier->performance = $performance;
            $supplier->save();
        }


        return redirect()->route('Orders.show', ['Order' => $id]);
//            response()->json([
//            'status' => 'success',
//            'data' => OrderEstimatedDateResource::make($order_estimated_dates),
//            'order' => OrderResource::make($order)
//        ]);

    }


    public function update(UpdateOrdersEstimatedDateRequest $request, OrderEstimatedDates $ordersEstimatedDate)
    {
        //
    }

}
