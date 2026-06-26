<?php

namespace Composite\TecDoc\DTOs\LinkageTarget\Item;

class LinkageTargetTypeFacetCountDTO
{
    /**
     * @param int $count
     * @param string $type
     */
    public function __construct(
        public int $count,
        public string $type,
    )
    {
    }
}