<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Models\Order;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        DB::beginTransaction();

        try {
            $orders = Order::searchQuery()
                ->sortingQuery()
                ->filterQuery()
                ->filterDateQuery()
                ->paginationQuery();

            $orders->transform(function ($order) {
                $order->room_id = $order->room_id ? Room::find($order->room_id)->name : "Unknown";
                $order->created_by = $order->created_by ? User::find($order->created_by)->name : "Unknown";
                $order->updated_by = $order->updated_by ? User::find($order->updated_by)->name : "Unknown";
                $order->deleted_by = $order->deleted_by ? User::find($order->deleted_by)->name : "Unknown";
                
                return $order;
            });

            DB::commit();

            return $this->success('Orders retrieved successfully', $orders);

        } catch (Exception $e) {
            DB::rollback();

            return $this->internalServerError();
        }
    }

    public function store(OrderStoreRequest $request)
    {
        DB::beginTransaction();
        $payload = collect($request->validated());

        try {

            $order = Order::create($payload->toArray());

            DB::commit();

            return $this->success('order created successfully', $order);

        } catch (Exception $e) {
            DB::rollback();

            return $this->internalServerError();
        }
    }

    public function show($id)
    {
        DB::beginTransaction();

        try {

            $order = Order::findOrFail($id);
            DB::commit();

            return $this->success('order retrived successfully by id', $order);

        } catch (Exception $e) {
            DB::rollback();

            return $this->internalServerError();
        }
    }

    public function update(OrderUpdateRequest $request, $id)
    {
        DB::beginTransaction();

        $payload = collect($request->validated());

        try {

            $order = Order::findOrFail($id);
            $order->update($payload->toArray());
            DB::commit();

            return $this->success('order updated successfully by id', $order);

        } catch (Exception $e) {
            DB::rollback();

            return $this->internalServerError();
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {

            $order = Order::findOrFail($id);
            $order->forceDelete();

            DB::commit();

            return $this->success('order deleted successfully by id', []);

        } catch (Exception $e) {
            DB::rollback();

            return $this->internalServerError();
        }
    }
}
