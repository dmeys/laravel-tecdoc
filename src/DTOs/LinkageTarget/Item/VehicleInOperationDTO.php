<?php

namespace Composite\TecDoc\DTOs\LinkageTarget\Item;

class VehicleInOperationDTO
{
    /**
     * @param int $count
     * @param string $dataSource
     * @param string|null $dateFrom
     * @param string|null $dateTo
     */
    public function __construct(
        public int $count,
        public string $dataSource,
        public ?string $dateFrom,
        public ?string $dateTo,
    )
    {
    }
}