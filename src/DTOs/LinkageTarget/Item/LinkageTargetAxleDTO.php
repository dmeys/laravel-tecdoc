<?php

namespace Composite\TecDoc\DTOs\LinkageTarget\Item;

class LinkageTargetAxleDTO
{
    /**
     * @param int $id
     * @param string $description
     * @param int $mfrId
     * @param string $mfrName
     * @param string $mfrShortName
     * @param int|null $vehicleModelSeriesId
     * @param string|null $vehicleModelSeriesName
     */
    public function __construct(
        public int $id,
        public string $description,
        public int $mfrId,
        public string $mfrName,
        public string $mfrShortName,
        public ?int $vehicleModelSeriesId,
        public ?string $vehicleModelSeriesName,
    )
    {
    }
}