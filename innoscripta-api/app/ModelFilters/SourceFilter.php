<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class SourceFilter extends ModelFilter
{
    public function title($value)
    {
        return $this->where('title', 'LIKE', "%$value%")
            ->orWhere('reference', 'LIKE', "%$value%")
            ->orWhere('category', 'LIKE', "%$value%");
    }

}
