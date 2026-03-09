<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePurchaseOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'connect_po_option' => 'required|string|max:255',
            'name' => 'required_if:connect_po_option,create|max:255',
            'purchase_order_id' => 'required_if:connect_po_option,connect|max:255',
            'supplier_id' => 'required|integer|exists:suppliers,id',
            'supplier_sheet_id' => 'required|integer|exists:supplier_sheets,id',
        ];
    }
}
