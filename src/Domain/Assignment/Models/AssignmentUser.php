<?php

namespace Domain\Assignment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class AssignmentUser extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;

    protected $guarded = [];
}
