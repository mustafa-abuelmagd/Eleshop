<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrdersRequest extends FormRequest
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
//        dd($this);
        return [
            'supplier_id' => 'required|exists:suppliers,id',
            'total_price' => 'required|numeric|gt:0',
            'initial_date' => 'nullable|date|after:tomorrow',
//            'total_price' => 'required|numeric|gt:0',
        ];
    }
}
