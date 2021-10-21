<?php

namespace App\Repositories\Core\JuzBrazil\Record;

trait ToArrayTrait
{
    public function toArray() : array
    {
        return get_object_vars($this);
    }
}
