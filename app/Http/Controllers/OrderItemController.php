<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderItemStoreRequest;
use App\Http\Requests\OrderItemUpdateRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderItemController extends Controller
{
    public function index(Request $request)
    {
        DB::beginTransaction();

        try {
            $items = OrderItem::searchQuery()
                ->sortingQuery()
                ->filterQuery()
                ->filterDateQuery()
                ->paginationQuery();

            $items->transform(function ($item) {
                $item->order_id = $item->order_id ? Order::find($item->order_id)->name : "Unknown";
                $item->created_by = $item->created_by ? User::find($item->created_by)->name : "Unknown";
                $item->updated_by = $item->updated_by ? User::find($item->updated_by)->name : "Unknown";
                $item->deleted_by = $item->deleted_by ? User::find($item->deleted_by)->name : "Unknown";
                
                return $item;
            });

            DB::commit();

            return $this->success('OrderItems retrieved successfully', $items);

        } catch (Exception $e) {
            DB::rollback();

            return $this->internalServerError();
        }
    }

    public function store(OrderItemStoreRequest $request)
    {
        DB::beginTransaction();
        $payload = collect($request->validated());

        try {

            $item = OrderItem::create($payload->toArray());

            DB::commit();

            return $this->success('item created successfully', $item);

        } catch (Exception $e) {
            DB::rollback();

            return $this->internalServerError();
        }
    }

    public function show($id)
    {
        DB::beginTransaction();

        try {

            $item = OrderItem::findOrFail($id);
            DB::commit();

            return $this->success('item retrived successfully by id', $item);

        } catch (Exception $e) {
            DB::rollback();

            return $this->internalServerError();
        }
    }

    public function update(OrderItemUpdateRequest $request, $id)
    {
        DB::beginTransaction();

        $payload = collect($request->validated());

        try {

            $item = OrderItem::findOrFail($id);
            $item->update($payload->toArray());
            DB::commit();

            return $this->success('item updated successfully by id', $item);

        } catch (Exception $e) {
            DB::rollback();

            return $this->internalServerError();
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {

            $item = OrderItem::findOrFail($id);
            $item->forceDelete();

            DB::commit();

            return $this->success('item deleted successfully by id', []);

        } catch (Exception $e) {
            DB::rollback();

            return $this->internalServerError();
        }
    }
}
