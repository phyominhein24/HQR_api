<?php

namespace App\Http\Requests;

use App\Enums\ItemStatusEnum;
use App\Helpers\Enum;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Foundation\Http\FormRequest;

class OrderItemUpdateRequest extends FormRequest
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
        $orders = Order::all()->pluck('id')->toArray();
        $orders = implode(',', $orders);

        $orderItem = OrderItem::findOrFail(request('id'));
        $orderItemId = $orderItem->id;

        $itemStatuses = implode(',', (new Enum(ItemStatusEnum::class))->values());

        return [
            'order_id' => "required|in:$orders",
            'item_name' => 'required|string|max:255',
            'qty' => 'required|integer|min:1',
            'price' => ['required', 'numeric', 'between:0,999999999.99'],
            'amount' => ['required', 'numeric', 'between:0,999999999.99'],
            'status' => "required|in:$itemStatuses",
        ];
    }
}
