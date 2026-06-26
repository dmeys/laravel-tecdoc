<?php

namespace Composite\TecDoc\DTOs\LinkageTarget;

use Composite\TecDoc\DTOs\LinkageTarget\Item\LinkageTargetVehicleModelSeriesFacetCountDTO;
use Illuminate\Support\Collection;

class VehicleModelSeriesFacetDTO
{
    /**
     * @param int $total
     * @param Collection<LinkageTargetVehicleModelSeriesFacetCountDTO>|null $counts
     */
    public function __construct(
        public int $total,
        public ?Collection $counts,
    )
    {
    }
}