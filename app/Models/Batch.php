<?php

namespace App\Models;

use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Batch extends Model
{

    protected $fillable = ['name', 'month', 'year'];

    public function students(): HasMany
    {

        return $this->hasMany(User::class);
    }
}
