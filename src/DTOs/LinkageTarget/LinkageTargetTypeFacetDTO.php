<?php

namespace Composite\TecDoc\DTOs\LinkageTarget;

use Composite\TecDoc\DTOs\LinkageTarget\Item\LinkageTargetTypeFacetCountDTO;
use Illuminate\Support\Collection;

class LinkageTargetTypeFacetDTO
{
    /**
     * @param int $total
     * @param Collection<LinkageTargetTypeFacetCountDTO>|null $counts
     */
    public function __construct(
        public int $total,
        public ?Collection $counts,
    )
    {
    }
}