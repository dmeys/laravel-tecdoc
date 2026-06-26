<?php

namespace Composite\TecDoc\DTOs\LinkageTarget\Item;

class LinkageTargetDescriptionFacetCountDTO
{
    /**
     * @param int $count
     * @param string $description
     */
    public function __construct(
        public int $count,
        public string $description,
    )
    {
    }
}