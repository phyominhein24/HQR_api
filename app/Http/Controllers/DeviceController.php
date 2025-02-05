<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeviceStoreRequest;
use App\Http\Requests\DeviceUpdateRequest;
use App\Models\Device;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeviceController extends Controller
{
    public function index(Request $request)
    {
        DB::beginTransaction();

        try {
            $devices = Device::searchQuery()
                ->sortingQuery()
                ->filterQuery()
                ->filterDateQuery()
                ->paginationQuery();

            $devices->transform(function ($device) {
                $device->room_id = $device->room_id ? Room::find($device->room_id)->name : "Unknown";
                $device->created_by = $device->created_by ? User::find($device->created_by)->name : "Unknown";
                $device->updated_by = $device->updated_by ? User::find($device->updated_by)->name : "Unknown";
                $device->deleted_by = $device->deleted_by ? User::find($device->deleted_by)->name : "Unknown";
                
                return $device;
            });

            DB::commit();

            return $this->success('Devices retrieved successfully', $devices);

        } catch (Exception $e) {
            DB::rollback();

            return $this->internalServerError();
        }
    }

    public function store(DeviceStoreRequest $request)
    {
        DB::beginTransaction();
        $payload = collect($request->validated());

        try {

            $device = Device::create($payload->toArray());

            DB::commit();

            return $this->success('device created successfully', $device);

        } catch (Exception $e) {
            DB::rollback();

            return $this->internalServerError();
        }
    }

    public function show($id)
    {
        DB::beginTransaction();

        try {

            $device = Device::findOrFail($id);
            DB::commit();

            return $this->success('device retrived successfully by id', $device);

        } catch (Exception $e) {
            DB::rollback();

            return $this->internalServerError();
        }
    }

    public function update(DeviceUpdateRequest $request, $id)
    {
        DB::beginTransaction();

        $payload = collect($request->validated());

        try {

            $device = Device::findOrFail($id);
            $device->update($payload->toArray());
            DB::commit();

            return $this->success('device updated successfully by id', $device);

        } catch (Exception $e) {
            DB::rollback();

            return $this->internalServerError();
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {

            $device = Device::findOrFail($id);
            $device->forceDelete();

            DB::commit();

            return $this->success('device deleted successfully by id', []);

        } catch (Exception $e) {
            DB::rollback();

            return $this->internalServerError();
        }
    }
}
