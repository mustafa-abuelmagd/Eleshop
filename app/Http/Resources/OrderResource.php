<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class   OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'total_price' => $this->total_price,
            'initial_date' => $this->initial_date,
            'supplier' =>[
                'id' => $this->supplier?->id,
                'name' => $this->supplier?->name,
            ],
            'order_items' => OrderItemsResource::collection($this->orderItems),
            'status' => $this->status

        ];
    }
}
