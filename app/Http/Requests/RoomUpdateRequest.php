<?php

namespace App\Http\Requests;

use App\Enums\GeneralStatusEnum;
use App\Helpers\Enum;
use App\Models\Room;
use App\Models\RoomsType;
use Illuminate\Foundation\Http\FormRequest;

class RoomUpdateRequest extends FormRequest
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
        $roomTypes = RoomsType::all()->pluck('id')->toArray();
        $roomTypes = implode(',', $roomTypes);

        $room = Room::findOrFail(request('id'));
        $roomId = $room->id;

        $statusEnum = implode(',', (new Enum(GeneralStatusEnum::class))->values());

        return [
            'room_type_id' => "required|in:$roomTypes",
            'room_name' => 'nullable|string|max:255',
            'room_photo' => 'nullable|json',
            'beds' => 'required|json',
            'price' => ['required', 'numeric', 'between:0,999999999.99'],
            'promotion_price' => ['required', 'numeric', 'between:0,999999999.99'],
            'currency_type' => 'required|string|max:10',
            'room_qr' => 'required|string|max:255',
            'status' => "required|in:$statusEnum",
        ];
    }
}
