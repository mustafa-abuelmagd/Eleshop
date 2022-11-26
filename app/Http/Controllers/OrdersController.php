<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrdersRequest;
use App\Http\Requests\UpdateOrdersRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderEstimatedDates;
use App\Models\OrderItem;
use Carbon\Carbon;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $orders = Order::all();
        return OrderResource::collection($orders);
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
     * @param \App\Http\Requests\StoreOrdersRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreOrdersRequest $request)
    {
        $order_data = Order::create(
            $request->validated() +['status' => Order::SHIPPED] ,
        );
        $default_date= 0;
        foreach ($request->order_items as $order_item) {
            $order_item = OrderItem::create($order_item + ['order_id' => $order_data->id]);
            $default_date= $order_item->menuItem->default_delivery_time > $default_date ?  $order_item->menuItem->default_delivery_time : $default_date;
        }


        $order_data->initial_date= Carbon::now()->addDays($default_date);
        $order_data->save();

        OrderEstimatedDates::create([
            'order_id' => $order_data->id,
            'phase' => OrderEstimatedDates::INITIAL,
            'estimated_date' => Carbon::now()->addDays($default_date)
        ]);

        return response()->json([
            'status' => 'success',
            'data' => OrderResource::make($order_data),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Order $orders
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('OrderShow' , [
            'order' => $order
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Order $orders
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateOrdersRequest $request
     * @param \App\Models\Order $orders
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrdersRequest $request, Order $orders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Order $orders
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $orders)
    {
        //
    }
}
