<?php

namespace App\Http\Requests;

use App\Enums\OrderStatusEnum;
use App\Enums\PaymentMethodEnum;
use App\Helpers\Enum;
use App\Models\Order;
use App\Models\Room;
use Illuminate\Foundation\Http\FormRequest;

class OrderUpdateRequest extends FormRequest
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
        $rooms = Room::all()->pluck('id')->toArray();
        $rooms = implode(',', $rooms);

        $order = Order::findOrFail(request('id'));
        $orderId = $order->id;

        $paymentMethods = implode(',', (new Enum(PaymentMethodEnum::class))->values());
        $orderStatuses = implode(',', (new Enum(OrderStatusEnum::class))->values());

        return [
            'room_id' => "required|in:$rooms",
            'mac_address' => 'required|string|max:255',
            'order_session' => "required|string|unique:orders,order_session,$orderId|max:255",
            'order_confirm_at' => 'nullable|date',
            'order_cancel_at' => 'nullable|date',
            'order_complete_at' => 'nullable|date',
            'total_amount' => ['required', 'numeric', 'between:0,999999999.99'],
            'pay_amount' => ['required', 'numeric', 'between:0,999999999.99'],
            'refund_amount' => ['required', 'numeric', 'between:0,999999999.99'],
            'remark' => 'nullable|string|max:1000',
            'currency_type' => 'required|string|max:10',
            'waiting_time' => 'required|date_format:H:i:s',
            'payment_method' => "required|in:$paymentMethods",
            'status' => "required|in:$orderStatuses",
        ];
    }
}
