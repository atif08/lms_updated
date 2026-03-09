<?php

namespace Domain\Courses\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topicable extends Model
{
    use HasFactory;

    protected $table = 'topicables';

    protected $fillable = ['topic_id', 'topicable_type', 'topicable_id', 'order'];

    public function topicable()
    {
        return $this->morphTo();
    }
}
