<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderEstimatedDateResource extends JsonResource
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
            'order_id' => $this->order?->id,
            'supplier' =>[
                'id' => $this->order?->supplier?->id,
                'name' => $this->order?->supplier?->name,
            ],
            'phase' => $this->phase,
            'estimated_date' => $this->estimated_date,
            'reason' => $this->reason
        ];
    }
}
