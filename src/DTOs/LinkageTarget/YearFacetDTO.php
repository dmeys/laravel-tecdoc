<?php

namespace Composite\TecDoc\DTOs\LinkageTarget;

use Composite\TecDoc\DTOs\LinkageTarget\Item\LinkageTargetYearFacetCountDTO;
use Illuminate\Support\Collection;

class YearFacetDTO
{
    /**
     * @param int $total
     * @param Collection<LinkageTargetYearFacetCountDTO>|null $counts
     */
    public function __construct(
        public int $total,
        public ?Collection $counts,
    )
    {
    }
}