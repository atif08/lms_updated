<?php

namespace Support\Traits;

trait StatusChangeable
{
    public function changeStatus(): void
    {
        $this->is_active = ! $this->is_active;
        $this->save();
    }
}
