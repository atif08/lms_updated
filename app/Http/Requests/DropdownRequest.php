<?php

namespace App\Http\Requests;

use App\Enums\ReportTypeEnum;
use App\Rules\UniqueDropdown;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class DropdownRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        if ($this->get('report_type') == ReportTypeEnum::UPCS()) {
            return [
                'upc'       => ['required', new UniqueDropdown($this->all())],
                'asin'      => ['required', new UniqueDropdown($this->all())],
                'import_id' => ['required']
            ];
        }

        return [
            'upc'              => ['required', new UniqueDropdown($this->all())],
            'case_pack'        => ['required', new UniqueDropdown($this->all())],
            'net_unit_cost'    => ['required', new UniqueDropdown($this->all())],
            'net_case_cost'    => ['required', new UniqueDropdown($this->all())],
//            'base_case_cost'   => ['required', new UniqueDropdown($this->all())],
//            'sell_uom'         => ['required', new UniqueDropdown($this->all())],
            'item_code'        => ['required', new UniqueDropdown($this->all())],
            'item_description' => ['required', new UniqueDropdown($this->all())],
//            'category'         => ['required', new UniqueDropdown($this->all())],
//            'sell_size'        => ['required', new UniqueDropdown($this->all())],
//            'base_unit_cost'   => ['required', new UniqueDropdown($this->all())],
            'import_id'        => ['required']
        ];
    }
}
