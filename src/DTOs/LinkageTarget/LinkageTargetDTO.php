<?php

namespace Composite\TecDoc\DTOs\LinkageTarget;

use Illuminate\Support\Collection;

class LinkageTargetDTO
{
    /**
     * @param int $total
     * @param DescriptionFacetDTO|null $descriptionFacet
     * @param HmdModelFacetDTO|null $hmdModelFacet
     * @param Collection<LinkageTargetItemDTO>|null $linkageTargetItems
     * @param LinkageTargetTypeFacetDTO|null $linkageTargetTypeFacet
     * @param MfrFacetDTO|null $mfrFacet
     * @param VehicleModelSeriesFacetDTO|null $vehicleModelSeriesFacet
     * @param YearFacetDTO|null $yearFacet
     */
    public function __construct(
        public int $total,
        public ?DescriptionFacetDTO $descriptionFacet,
        public ?HmdModelFacetDTO $hmdModelFacet,
        public ?Collection $linkageTargetItems,
        public ?LinkageTargetTypeFacetDTO $linkageTargetTypeFacet,
        public ?MfrFacetDTO $mfrFacet,
        public ?VehicleModelSeriesFacetDTO $vehicleModelSeriesFacet,
        public ?YearFacetDTO $yearFacet,
    )
    {
    }
}