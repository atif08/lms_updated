<?php

namespace Domain\FileLibrary\DataTransferObject;

use Spatie\LaravelData\Data;

class FileLibraryIndexData extends Data
{
    public function __construct(
        public int $id,
        public string $name,

    ) {}

}
