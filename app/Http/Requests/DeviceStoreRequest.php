<?php

namespace App\Http\Requests;

use App\Enums\GeneralStatusEnum;
use App\Helpers\Enum;
use Illuminate\Foundation\Http\FormRequest;

class DeviceStoreRequest extends FormRequest
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
        $statusEnum = implode(',', (new Enum(GeneralStatusEnum::class))->values());

        return [
            'mac_address' => 'required|string|max:255|unique:devices,mac_address',
            'expired_at' => 'required|date',
            'status' => "required|in:$statusEnum",
        ];

    }
}
