<?php

namespace Database\Seeders;

use App\Models\RoomsType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RoomsType::factory()->count(10)->create();
    }
}
