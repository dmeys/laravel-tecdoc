<?php

namespace Composite\TecDoc\DTOs\LinkageTarget\Item;

class LinkageTargetYearFacetCountDTO
{
    /**
     * @param int $year
     * @param int $count
     */
    public function __construct(
        public int $year,
        public int $count,
    )
    {
    }
}