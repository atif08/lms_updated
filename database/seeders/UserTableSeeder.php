<?php

namespace Database\Seeders;

use AmazonSellingPartner\Model\Sellers\Participation;
use App\AmazonSpClients\SellersApiClient;
use App\Models\Connections\Connection;
use App\Models\Connections\SpToken;
use App\Models\Marketplace;
use Domain\Users\Enums\UserTypeEnum;
use Domain\Users\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        /** @var User $admin_user */
        $admin_user = User::query()->updateOrCreate([
            'email' => 'super@admin.com',
        ], [
            'name'      => 'Admin',
            'password'  => Hash::make('development'),
            'user_type' => UserTypeEnum::ADMIN(),
            'is_active' => 1,
        ]);
    }

}
