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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $orders = OrderEstimatedDates::all();
        return OrderEstimatedDateResource::collection($orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreOrdersEstimatedDateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
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
            $start_time = Carbon::parse($order->initial_date);
            $finish_time = Carbon::now();
            $result = $start_time->diffInDays($finish_time, false);
            $order->delay = $result;
            $order->save();
        }


        return response()->json([
            'status' => 'success',
            'data' => OrderEstimatedDateResource::make($order_estimated_dates),
            'order' => OrderResource::make($order)
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\OrderEstimatedDates $ordersEstimatedDate
     * @return \Illuminate\Http\Response
     */
    public function show(OrderEstimatedDates $ordersEstimatedDate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\OrderEstimatedDates $ordersEstimatedDate
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderEstimatedDates $ordersEstimatedDate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateOrdersEstimatedDateRequest $request
     * @param \App\Models\OrderEstimatedDates $ordersEstimatedDate
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrdersEstimatedDateRequest $request, OrderEstimatedDates $ordersEstimatedDate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\OrderEstimatedDates $ordersEstimatedDate
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderEstimatedDates $ordersEstimatedDate)
    {
        //
    }
}
