<?php

namespace Composite\TecDoc\DTOs\LinkageTarget\Item;

class LinkageTargetHMDModelFacetCountDTO
{
    /**
     * @param int $mfrId
     * @param int $hmdMfrModelId
     * @param string $name
     * @param int $count
     */
    public function __construct(
        public int $mfrId,
        public int $hmdMfrModelId,
        public string $name,
        public int $count,
    )
    {
    }
}