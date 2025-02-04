<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = [
            'id' => '1',
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'phone' => '755704230',
            'address' => fake()->address(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'shop_id' => '1',
            'created_by' => '1',
            'is_superuser' => 1,
            'updated_by' => '1',
            'status' => 'ACTIVE'
        ];

        $role = RoleEnum::SUPER_ADMIN->value;

        $superAdmin2 = [
            'id' => '2',
            'name' => 'admin2',
            'email' => 'admin2@gmail.com',
            'phone' => '755704231',
            'address' => fake()->address(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'shop_id' => '1',
            'created_by' => '1',
            'is_superuser' => 1,
            'updated_by' => '1',
            'status' => 'ACTIVE'
        ];

        $role2 = RoleEnum::SUPER_ADMIN->value;

        try {

            $user = User::updateOrCreate($superAdmin)->assignRole($role);
            $user2 = User::updateOrCreate($superAdmin2)->assignRole($role2);

        } catch (Exception $e) {

            info($e);

        }
    }
}
