<?php

namespace Composite\TecDoc\DTOs\LinkageTarget;

use Composite\TecDoc\DTOs\LinkageTarget\Item\LinkageTargetMfrFacetCountDTO;
use Illuminate\Support\Collection;

class MfrFacetDTO
{
    /**
     * @param int $total
     * @param Collection<LinkageTargetMfrFacetCountDTO>|null $counts
     */
    public function __construct(
        public int $total,
        public ?Collection $counts,
    )
    {
    }
}