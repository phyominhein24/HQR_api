<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomStoreRequest;
use App\Http\Requests\RoomUpdateRequest;
use App\Models\Room;
use App\Models\RoomsType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        DB::beginTransaction();

        try {
            $rooms = Room::searchQuery()
                ->sortingQuery()
                ->filterQuery()
                ->filterDateQuery()
                ->paginationQuery();

            $rooms->transform(function ($room) {
                $room->room_type_id = $room->room_type_id ? RoomsType::find($room->room_type_id)->name : "Unknown";
                $room->created_by = $room->created_by ? User::find($room->created_by)->name : "Unknown";
                $room->updated_by = $room->updated_by ? User::find($room->updated_by)->name : "Unknown";
                $room->deleted_by = $room->deleted_by ? User::find($room->deleted_by)->name : "Unknown";
                
                return $room;
            });

            DB::commit();

            return $this->success('Rooms retrieved successfully', $rooms);

        } catch (Exception $e) {
            DB::rollback();

            return $this->internalServerError();
        }
    }

    public function store(RoomStoreRequest $request)
    {
        DB::beginTransaction();
        $payload = collect($request->validated());

        try {

            $room = Room::create($payload->toArray());

            DB::commit();

            return $this->success('room created successfully', $room);

        } catch (Exception $e) {
            DB::rollback();

            return $this->internalServerError();
        }
    }

    public function show($id)
    {
        DB::beginTransaction();

        try {

            $room = Room::findOrFail($id);
            DB::commit();

            return $this->success('room retrived successfully by id', $room);

        } catch (Exception $e) {
            DB::rollback();

            return $this->internalServerError();
        }
    }

    public function update(RoomUpdateRequest $request, $id)
    {
        DB::beginTransaction();

        $payload = collect($request->validated());

        try {

            $room = Room::findOrFail($id);
            $room->update($payload->toArray());
            DB::commit();

            return $this->success('room updated successfully by id', $room);

        } catch (Exception $e) {
            DB::rollback();

            return $this->internalServerError();
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {

            $room = Room::findOrFail($id);
            $room->forceDelete();

            DB::commit();

            return $this->success('room deleted successfully by id', []);

        } catch (Exception $e) {
            DB::rollback();

            return $this->internalServerError();
        }
    }
}
