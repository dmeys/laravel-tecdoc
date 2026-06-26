<?php

namespace Composite\TecDoc\DTOs\LinkageTarget;

use Composite\TecDoc\DTOs\LinkageTarget\Item\LinkageTargetDescriptionFacetCountDTO;
use Illuminate\Support\Collection;

class DescriptionFacetDTO
{
    /**
     * @param int $total
     * @param Collection<LinkageTargetDescriptionFacetCountDTO>|null $counts
     */
    public function __construct(
        public int $total,
        public ?Collection $counts,
    )
    {
    }
}