<?php

namespace Domain\Users\Models\UserAttributes;

use App\Enums\UserTypeEnum;
use Domain\Users\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;

trait HasTypeAttributes {
    public function isTeacher(): bool
    {
        return $this->user_type == \Domain\Users\Enums\UserTypeEnum::TEACHER();
    }
    /**
     * @return bool
     */
    public function isAdmin(): bool {
        return $this->user_type == UserTypeEnum::ADMIN();
    }

    /**
     * @return bool
     */
    public function isBuyer(): bool {
        return $this->user_type == UserTypeEnum::BUYER();
    }

    /**
     * @return bool
     */
    public function isWarehouse(): bool {
        return $this->user_type == UserTypeEnum::WAREHOUSE();
    }

    /**
     * @return bool
     */
    public function isDeveloper(): bool {
        return $this->user_type == UserTypeEnum::DEVELOPER();
    }

    /**
     * @return boolean
     */
    public function isSeller(): bool {
        return $this->user_type == UserTypeEnum::SELLER();
    }

    /**
     * @param Marketplace $marketplace
     * @param string|null $seller_id
     * @param string|null $name
     * @return User
     */
    public function registerSeller(Marketplace $marketplace, string $seller_id = null, string $name = null): User {
        /** @var User $account */
        $account = self::query()->firstOrCreate([
            'user_type'      => UserTypeEnum::SELLER(),
            'parent_id'      => $this->id,
            'seller_id'      => $seller_id,
            'marketplace_id' => $marketplace->id,
            'region_code'    => $marketplace->region_code
        ]);

        if ($name) {
            $account->name = $name;
        }

        $account->save();

        return $account;
    }

    /**
     * @param array $user_type
     * @return Collection
     */
    public static function getActiveCallables(array $user_type = []): Collection {
        $user_types = $user_type ?: [UserTypeEnum::SELLER()];

        return self::query()
            ->whereIn('user_type', $user_types)
            ->where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('parent_id')
                    ->orWhereHas('parent', function ($query) {
                        $query->where('is_active', true);
                    });
            })
            ->get();
    }

    /**
     * @param array $user_type
     * @return Collection
     */
    public function getActiveMarketplaces(array $user_type = []): Collection {
        $user_type = $user_type ?: [UserTypeEnum::SELLER()];

        return match (true) {
            $this->isAdmin() => self::query()
                ->whereIn('user_type', $user_type)
                ->where('is_active', true)
                ->where('parent_id', $this->id)
                ->get(),

            default => self::query()
                ->whereIn('user_type', $user_type)
                ->where('is_active', true)
                ->where('parent_id', $this->parent_id)
                ->get()
        };
    }

    /**
     * @return array
     */
    public function getActiveIds(): array {
        return $this->getActiveMarketplaces()->pluck('id')->toArray();
    }

    /**
     * @return bool
     */
    public function hasSellingPartnerAccess(): bool {
        try {
            (new SellersApiClient($this))->listParticipations();
            return true;
        } catch (ApiException|InvalidArgumentException|JsonException|ClientExceptionInterface|Exception $e) {
            console_log($e->getMessage());
            return false;
        }
    }
}
