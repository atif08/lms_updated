<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Spatie\Enum\Enum;

class SpatieEnumCast implements CastsAttributes
{
    public function __construct(protected string $enumClass) {}

    public function get(Model $model, string $key, mixed $value, array $attributes): ?Enum
    {
        return $value !== null ? $this->enumClass::from($value) : null;
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): ?string
    {
        return $value instanceof Enum ? $value->value : $value;
    }
}
