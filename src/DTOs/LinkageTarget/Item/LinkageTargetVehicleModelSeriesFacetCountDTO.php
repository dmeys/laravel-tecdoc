<?php

namespace Composite\TecDoc\DTOs\LinkageTarget\Item;

class LinkageTargetVehicleModelSeriesFacetCountDTO
{
    /**
     * @param int $id
     * @param int $count
     * @param string $name
     * @param int|null $beginYearMonth
     * @param int|null $endYearMonth
     */
    public function __construct(
        public int $id,
        public int $count,
        public string $name,
        public ?int $beginYearMonth,
        public ?int $endYearMonth,
    )
    {
    }
}