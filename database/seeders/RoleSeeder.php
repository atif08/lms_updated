<?php

namespace Database\Seeders;

use App\Enums\RolesEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = RolesEnum::cases();

        foreach ($roles as $role){
            $item = Role::query()->updateOrCreate([
                'name' => $role,
            ], [
                'guard_name' => 'web',
            ]);
        }

        //
    }
}
