<?php

namespace Composite\TecDoc\Services;

use Composite\TecDoc\DTOs\LinkageTarget\LinkageTargetDTO;
use Composite\TecDoc\Facades\TecDoc;
use Composite\TecDoc\Mappers\LinkageTarget\LinkageTargetDataMapper;
use Illuminate\Support\Collection;

class LinkageTarget
{
    /**
     * TecDoc currently accepts maximum 100 linkage target IDs per request
     */
    private const LINKAGE_TARGETS_LIMIT = 100;

    public function __construct(
        protected LinkageTargetDataMapper $linkageTargetDataMapper,
    )
    {
    }

    /**
     * A method for finding information on vehicles, engines, axles and other linkage units
     *
     * $linkageTargetDTO = LinkageTargetDTO //required
     * $filter = [
     *      'engineCode' => 'CAGA',
     *      'engineIds' => 326,
     *      'filterMode' => 'all',
     *      'fuelTypeKeys' => 1,
     *      'horsePowerFrom' => 100,
     *      'horsePowerTo' => 150,
     *      'kiloWattsFrom' => 80,
     *      'kiloWattsTo' => 120,
     *      'lang' => 'HU',
     *      'linkageTargetCountry' => 'DE',
     *      'linkageTargetCountryGroupFlag' => false,
     *      'linkageTargetIds' => [
     *          'id' => 1309,
     *          'type' => 'P',
     *      ],
     *      'linkageTargetType' =>  'P',
     *      'page' =>  1,
     *      'perPage' =>  100,
     *      'sort' => [
     *          'field' => 'bodyStyle',
     *          'direction' => 'asc',
     *       ],
     *      'vehicleModelSeriesIds' => 13,
     *      'vehicleModelSeriesName' => '100 C3',
     *      'years' => 2008,
     * ]
     *
     * @param Collection $linkageTargetDTOCollection
     * @param array|null $filter
     * @return Collection
     */
    public function getLinkageTargets(Collection $linkageTargetDTOCollection, array $filter = null): Collection
    {
        return $linkageTargetDTOCollection
            ->chunk(self::LINKAGE_TARGETS_LIMIT)
            ->map(function (Collection $chunk) use ($filter) {
                $filter['perPage'] = self::LINKAGE_TARGETS_LIMIT;
                $response = TecDoc::post('', $this->linkageTargetDataMapper->createGetLinkageTargetsPayload($chunk, $filter));

                return $this->linkageTargetDataMapper->getResponseDTO($response);
            })
            ->values();
    }

    /**
     * A universal method for searching for information on vehicles, engines, axles and other units
     *
     * $linkageTargetDTO = LinkageTargetDTO //optional
     * $filter = [
     *      'engineCode' => 'CAGA',
     *      'engineIds' => 326,
     *      'filterMode' => 'all',
     *      'fuelTypeKeys' => 1,
     *      'horsePowerFrom' => 100,
     *      'horsePowerTo' => 150,
     *      'kiloWattsFrom' => 80,
     *      'kiloWattsTo' => 120,
     *      'lang' => 'HU',
     *      'linkageTargetCountry' => 'DE',
     *      'linkageTargetCountryGroupFlag' => false,
     *      'linkageTargetIds' => [
     *          'id' => 1309,
     *          'type' => 'P',
     *      ],
     *      'linkageTargetType' =>  'P',
     *      'page' =>  1,
     *      'perPage' =>  100,
     *      'sort' => [
     *          'field' => 'bodyStyle',
     *          'direction' => 'asc',
     *       ],
     *      'vehicleModelSeriesIds' => 13,
     *      'vehicleModelSeriesName' => '100 C3',
     *      'years' => 2008,
     * ]
     *
     * @param array|null $filter
     * @return LinkageTargetDTO
     */
    public function searchLinkageTargets(array $filter = null): LinkageTargetDTO
    {
        $response = TecDoc::post('', $this->linkageTargetDataMapper->createGetLinkageTargetsPayload(null, $filter));
        return $this->linkageTargetDataMapper->getResponseDTO($response);
    }
}