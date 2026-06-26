<?php

namespace Composite\TecDoc\DTOs\LinkageTarget;

use Composite\TecDoc\DTOs\LinkageTarget\Item\LinkageTargetHMDModelFacetCountDTO;
use Illuminate\Support\Collection;

class HmdModelFacetDTO
{
    /**
     * @param int $total
     * @param Collection<LinkageTargetHMDModelFacetCountDTO>|null $counts
     */
    public function __construct(
        public int $total,
        public ?Collection $counts,
    )
    {
    }
}