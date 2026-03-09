<?php

namespace Support\Traits;

use Illuminate\Support\Str;

trait GeneratesUniqueSlug
{
    public function generateUniqueSlug(string $name, string $modelClass, string $field = 'slug'): string
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $count = 1;
        while ($modelClass::where($field, $slug)->exists()) {
            $slug = $originalSlug.'-'.$count;

            $count++;
        }

        return $slug;
    }
}
