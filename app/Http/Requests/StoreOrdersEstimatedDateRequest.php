<?php

namespace App\Http\Requests;

use App\Models\Order;
use App\Models\OrderEstimatedDates;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOrdersEstimatedDateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $order = Order::findOrFail(request()->id);
//        dd($order);
        return [
//            'order_id' => 'required|exists:orders,id',
            'reason' => [
//                'required_if:phase'.OrderEstimatedDates::DELAY,
                Rule::requiredIf(fn () => $this->phase == OrderEstimatedDates::DELAY),
                'max:500'],
            'estimated_date' => [
                Rule::requiredIf(fn () => $order?->status != Order::DELIVERED),
                'date',
                'after:'. Carbon::parse($order?->initial_date)
            ],
            'phase' => ['required',
                'in:' . implode(',', OrderEstimatedDates::STATUSES),
            ]

        ];
    }
}
