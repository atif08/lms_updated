<?php

namespace Database\Seeders;

use Domain\Users\Enums\PermissionsEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = PermissionsEnum::cases();

        foreach ($permissions as $permission){
            Permission::query()->updateOrCreate([
                'name' => $permission,
            ], [
                'guard_name' => 'web',
            ]);
        }

        //
    }
}
