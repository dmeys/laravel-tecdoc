<?php

namespace Composite\TecDoc\DTOs\LinkageTarget\Item;

class LinkageTargetMfrFacetCountDTO
{
    /**
     * @param int $id
     * @param int $count
     * @param string $name
     * @param string $linkageTargetType
     */
    public function __construct(
        public int $id,
        public int $count,
        public string $name,
        public string $linkageTargetType,
    )
    {
    }
}