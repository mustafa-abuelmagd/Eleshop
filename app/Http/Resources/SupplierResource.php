<?php

namespace App\Http\Resources;

use App\Models\Order;
use Illuminate\Http\Resources\Json\JsonResource;

class SupplierResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $orders = $this->orders()->where('status', Order::DELIVERED)->get();
        $performance = count($orders) > 0 ? array_sum($orders->pluck('delay')->toArray()) / count($orders) : 0;
//        dd($this->orderHistory);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'performance' => $performance,
            'history' => OrderEstimatedDateResource::collection($this->orderHistory),
            'orders' => $this->orders,
            'created_at' => $this->created_at,


        ];
    }
}
