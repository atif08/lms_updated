<?php

namespace Domain\Courses\DataTransferObject;

use Spatie\LaravelData\Data;

class CoursesIndexData extends Data
{
    public function __construct(
        public int $id,
        public string $name,

    ) {}

}
