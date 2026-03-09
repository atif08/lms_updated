<?php

namespace Database\Seeders;

use App\Enums\UserTypeEnum;
use App\Models\Connections\Connection;
use Domain\Users\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     */
    public function run(): void {
        /** @var User $admin_user */
         User::query()->updateOrCreate([
            'email' => 'super@admin.com',
        ], [
            'name'      => 'Admin',
            'password'  => Hash::make('development'),
            'user_type' => UserTypeEnum::ADMIN(),
            'is_active' => 1,
        ]);
    }

}
