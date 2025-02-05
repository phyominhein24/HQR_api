<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuItemStoreRequest;
use App\Http\Requests\MenuItemUpdateRequest;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuItemController extends Controller
{
    public function index(Request $request)
    {
        DB::beginTransaction();

        try {
            $items = MenuItem::searchQuery()
                ->sortingQuery()
                ->filterQuery()
                ->filterDateQuery()
                ->paginationQuery();

            $items->transform(function ($item) {
                $item->menu_category_id = $item->menu_category_id ? MenuCategory::find($item->menu_category_id)->name : "Unknown";
                $item->created_by = $item->created_by ? User::find($item->created_by)->name : "Unknown";
                $item->updated_by = $item->updated_by ? User::find($item->updated_by)->name : "Unknown";
                $item->deleted_by = $item->deleted_by ? User::find($item->deleted_by)->name : "Unknown";
                
                return $item;
            });

            DB::commit();

            return $this->success('Items retrieved successfully', $items);

        } catch (Exception $e) {
            DB::rollback();

            return $this->internalServerError();
        }
    }

    public function store(MenuItemStoreRequest $request)
    {
        DB::beginTransaction();
        $payload = collect($request->validated());

        try {

            $item = MenuItem::create($payload->toArray());

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

            $item = MenuItem::findOrFail($id);
            DB::commit();

            return $this->success('item retrived successfully by id', $item);

        } catch (Exception $e) {
            DB::rollback();

            return $this->internalServerError();
        }
    }

    public function update(MenuItemUpdateRequest $request, $id)
    {
        DB::beginTransaction();

        $payload = collect($request->validated());

        try {

            $item = MenuItem::findOrFail($id);
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

            $item = MenuItem::findOrFail($id);
            $item->forceDelete();

            DB::commit();

            return $this->success('item deleted successfully by id', []);

        } catch (Exception $e) {
            DB::rollback();

            return $this->internalServerError();
        }
    }
}
