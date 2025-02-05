<?php

namespace App\Http\Requests;

use App\Enums\GeneralStatusEnum;
use App\Helpers\Enum;
use App\Models\RoomsType;
use Illuminate\Foundation\Http\FormRequest;

class RoomsTypeUpdateRequest extends FormRequest
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
        $roomType = RoomsType::findOrFail(request('id'));
        $roomTypeId = $roomType->id;

        $statusEnum = implode(',', (new Enum(GeneralStatusEnum::class))->values());

        return [
            'room_type' => "required|string|max:255|unique:rooms_types,room_type,$roomTypeId",
            'description' => 'nullable|string|max:1000',
            'price_rate_min' => ['required', 'numeric', 'between:0,999999999.99'],
            'price_rate_max' => ['required', 'numeric', 'between:0,999999999.99'],
            'status' => "required|in:$statusEnum",
        ];
    }
}
