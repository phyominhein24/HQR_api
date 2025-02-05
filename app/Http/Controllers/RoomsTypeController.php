<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomsTypeStoreRequest;
use App\Http\Requests\RoomsTypeUpdateRequest;
use App\Models\RoomsType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomsTypeController extends Controller
{
    public function index(Request $request)
    {
        DB::beginTransaction();

        try {
            $roomsTypes = RoomsType::searchQuery()
                ->sortingQuery()
                ->filterQuery()
                ->filterDateQuery()
                ->paginationQuery();

            $roomsTypes->transform(function ($roomsType) {
                $roomsType->created_by = $roomsType->created_by ? User::find($roomsType->created_by)->name : "Unknown";
                $roomsType->updated_by = $roomsType->updated_by ? User::find($roomsType->updated_by)->name : "Unknown";
                $roomsType->deleted_by = $roomsType->deleted_by ? User::find($roomsType->deleted_by)->name : "Unknown";
                
                return $roomsType;
            });

            DB::commit();

            return $this->success('RoomsTypes retrieved successfully', $roomsTypes);

        } catch (Exception $e) {
            DB::rollback();

            return $this->internalServerError();
        }
    }

    public function store(RoomsTypeStoreRequest $request)
    {
        DB::beginTransaction();
        $payload = collect($request->validated());

        try {

            $roomsType = RoomsType::create($payload->toArray());

            DB::commit();

            return $this->success('roomsType created successfully', $roomsType);

        } catch (Exception $e) {
            DB::rollback();

            return $this->internalServerError();
        }
    }

    public function show($id)
    {
        DB::beginTransaction();

        try {

            $roomsType = RoomsType::findOrFail($id);
            DB::commit();

            return $this->success('roomsType retrived successfully by id', $roomsType);

        } catch (Exception $e) {
            DB::rollback();

            return $this->internalServerError();
        }
    }

    public function update(RoomsTypeUpdateRequest $request, $id)
    {
        DB::beginTransaction();

        $payload = collect($request->validated());

        try {

            $roomsType = RoomsType::findOrFail($id);
            $roomsType->update($payload->toArray());
            DB::commit();

            return $this->success('roomsType updated successfully by id', $roomsType);

        } catch (Exception $e) {
            DB::rollback();

            return $this->internalServerError();
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {

            $roomsType = RoomsType::findOrFail($id);
            $roomsType->forceDelete();

            DB::commit();

            return $this->success('roomsType deleted successfully by id', []);

        } catch (Exception $e) {
            DB::rollback();

            return $this->internalServerError();
        }
    }
}
