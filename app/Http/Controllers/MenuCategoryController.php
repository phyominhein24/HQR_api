<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuCategoryStoreRequest;
use App\Http\Requests\MenuCategoryUpdateRequest;
use App\Models\MenuCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuCategoryController extends Controller
{
    public function index(Request $request)
    {
        DB::beginTransaction();

        try {
            $categorys = MenuCategory::searchQuery()
                ->sortingQuery()
                ->filterQuery()
                ->filterDateQuery()
                ->paginationQuery();

            $categorys->transform(function ($category) {
                $category->created_by = $category->created_by ? User::find($category->created_by)->name : "Unknown";
                $category->updated_by = $category->updated_by ? User::find($category->updated_by)->name : "Unknown";
                $category->deleted_by = $category->deleted_by ? User::find($category->deleted_by)->name : "Unknown";
                
                return $category;
            });

            DB::commit();

            return $this->success('categories retrieved successfully', $categorys);

        } catch (Exception $e) {
            DB::rollback();

            return $this->internalServerError();
        }
    }

    public function store(MenuCategoryStoreRequest $request)
    {
        DB::beginTransaction();
        $payload = collect($request->validated());

        try {

            $category = MenuCategory::create($payload->toArray());

            DB::commit();

            return $this->success('category created successfully', $category);

        } catch (Exception $e) {
            DB::rollback();

            return $this->internalServerError();
        }
    }

    public function show($id)
    {
        DB::beginTransaction();

        try {

            $category = MenuCategory::findOrFail($id);
            DB::commit();

            return $this->success('category retrived successfully by id', $category);

        } catch (Exception $e) {
            DB::rollback();

            return $this->internalServerError();
        }
    }

    public function update(MenuCategoryUpdateRequest $request, $id)
    {
        DB::beginTransaction();

        $payload = collect($request->validated());

        try {

            $category = MenuCategory::findOrFail($id);
            $category->update($payload->toArray());
            DB::commit();

            return $this->success('category updated successfully by id', $category);

        } catch (Exception $e) {
            DB::rollback();

            return $this->internalServerError();
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {

            $category = MenuCategory::findOrFail($id);
            $category->forceDelete();

            DB::commit();

            return $this->success('category deleted successfully by id', []);

        } catch (Exception $e) {
            DB::rollback();

            return $this->internalServerError();
        }
    }
}
