<?php

namespace Composite\TecDoc\Mappers\LinkageTarget;

use Composite\TecDoc\DTOs\Article\ArticleLinkageTargetDTO;
use Composite\TecDoc\DTOs\LinkageTarget\DescriptionFacetDTO;
use Composite\TecDoc\DTOs\LinkageTarget\HmdModelFacetDTO;
use Composite\TecDoc\DTOs\LinkageTarget\Item\AxleBodyTypeRecordDTO;
use Composite\TecDoc\DTOs\LinkageTarget\Item\LinkageTargetAxleDTO;
use Composite\TecDoc\DTOs\LinkageTarget\Item\LinkageTargetCabDTO;
use Composite\TecDoc\DTOs\LinkageTarget\Item\LinkageTargetDescriptionFacetCountDTO;
use Composite\TecDoc\DTOs\LinkageTarget\Item\LinkageTargetEngineDTO;
use Composite\TecDoc\DTOs\LinkageTarget\Item\LinkageTargetHMDModelFacetCountDTO;
use Composite\TecDoc\DTOs\LinkageTarget\Item\LinkageTargetMfrFacetCountDTO;
use Composite\TecDoc\DTOs\LinkageTarget\Item\LinkageTargetSecondaryTypeDTO;
use Composite\TecDoc\DTOs\LinkageTarget\Item\LinkageTargetTypeFacetCountDTO;
use Composite\TecDoc\DTOs\LinkageTarget\Item\LinkageTargetVehicleModelSeriesFacetCountDTO;
use Composite\TecDoc\DTOs\LinkageTarget\Item\LinkageTargetWheelBaseDTO;
use Composite\TecDoc\DTOs\LinkageTarget\Item\LinkageTargetYearFacetCountDTO;
use Composite\TecDoc\DTOs\LinkageTarget\Item\PerformanceRecordDTO;
use Composite\TecDoc\DTOs\LinkageTarget\Item\VehicleBodyTypeRecordDTO;
use Composite\TecDoc\DTOs\LinkageTarget\Item\VehicleImageRecordDTO;
use Composite\TecDoc\DTOs\LinkageTarget\Item\VehicleInOperationDTO;
use Composite\TecDoc\DTOs\LinkageTarget\LinkageTargetDTO;
use Composite\TecDoc\DTOs\LinkageTarget\LinkageTargetItemDTO;
use Composite\TecDoc\DTOs\LinkageTarget\LinkageTargetTypeFacetDTO;
use Composite\TecDoc\DTOs\LinkageTarget\MfrFacetDTO;
use Composite\TecDoc\DTOs\LinkageTarget\VehicleModelSeriesFacetDTO;
use Composite\TecDoc\DTOs\LinkageTarget\YearFacetDTO;
use Composite\TecDoc\Traits\Payload;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;

class LinkageTargetDataMapper
{
    use Payload;

    /**
     * @param array $descriptionFacet
     * @return DescriptionFacetDTO|null
     */
    private function createDescriptionFacetDTO(array $descriptionFacet): ?DescriptionFacetDTO
    {
        if (!$descriptionFacet) {
            return null;
        }

        return new DescriptionFacetDTO(
            total: $descriptionFacet['total'] ?? 0,
            counts: Collection::make($descriptionFacet['counts'] ?? [])
                ->map(fn(array $item) => $this->createLinkageTargetDescriptionFacetCountDTO($item))
                ->values(),
        );
    }

    /**
     * @param array $descriptionCount
     * @return LinkageTargetDescriptionFacetCountDTO|null
     */
    private function createLinkageTargetDescriptionFacetCountDTO(array $descriptionCount): ?LinkageTargetDescriptionFacetCountDTO
    {
        if (!$descriptionCount) {
            return null;
        }

        return new LinkageTargetDescriptionFacetCountDTO(
            count: $descriptionCount['count'],
            description: $descriptionCount['description'],
        );
    }

    /**
     * @param array $hdmModelFacet
     * @return HmdModelFacetDTO|null
     */
    private function createHmdModelFacetDTO(array $hdmModelFacet): ?HmdModelFacetDTO
    {
        if (!$hdmModelFacet) {
            return null;
        }

        return new HmdModelFacetDTO(
            total: $hdmModelFacet['total'] ?? 0,
            counts: Collection::make($hdmModelFacet['counts'] ?? [])
                ->map(fn(array $item) => $this->createLinkageTargetHMDModelFacetCountDTO($item))
                ->values(),
        );
    }

    /**
     * @param array $hdmModelCount
     * @return LinkageTargetHMDModelFacetCountDTO|null
     */
    private function createLinkageTargetHMDModelFacetCountDTO(array $hdmModelCount): ?LinkageTargetHMDModelFacetCountDTO
    {
        if (!$hdmModelCount) {
            return null;
        }

        return new LinkageTargetHMDModelFacetCountDTO(
            mfrId: $hdmModelCount['mfrId'],
            hmdMfrModelId: $hdmModelCount['hmdMfrModelId'],
            name: $hdmModelCount['name'],
            count: $hdmModelCount['count'],
        );
    }

    /**
     * @param array $linkageTarget
     * @return LinkageTargetItemDTO|null
     */
    private function createLinkageTargetItemDTO(array $linkageTarget): ?LinkageTargetItemDTO
    {
        if (!$linkageTarget) {
            return null;
        }

        return new LinkageTargetItemDTO(
            linkageTargetId: $linkageTarget['linkageTargetId'],
            linkageTargetType: $linkageTarget['linkageTargetType'],
            mfrId: $linkageTarget['mfrId'],
            mfrName: $linkageTarget['mfrName'],
            mfrShortName: $linkageTarget['mfrShortName'],
            aspiration: $linkageTarget['aspiration'] ?? null,
            aspirationKey: $linkageTarget['aspirationKey'] ?? null,
            axles: Collection::make($linkageTarget['axles'] ?? [])
                ->map(fn(array $item) => $this->createLinkageTargetAxleDTO($item))
                ->values(),
            axleBody: $linkageTarget['axleBody'] ?? null,
            axleBodyKey: $linkageTarget['axleBodyKey'] ?? null,
            axleBodyTypes: Collection::make($linkageTarget['axleBodyTypes'] ?? [])
                ->map(fn(array $item) => $this->createAxleBodyTypeRecordDTO($item))
                ->values(),
            axleConfiguration: $linkageTarget['axleConfiguration'] ?? null,
            axleConfigurationKey: $linkageTarget['axleConfigurationKey'] ?? null,
            axleLoadFromKg: $linkageTarget['axleLoadFromKg'] ?? null,
            axleLoadToKg: $linkageTarget['axleLoadToKg'] ?? null,
            axleStyle: $linkageTarget['axleStyle'] ?? null,
            axleStyleKey: $linkageTarget['axleStyleKey'] ?? null,
            axleType: $linkageTarget['axleType'] ?? null,
            axleTypeKey: $linkageTarget['axleTypeKey'] ?? null,
            beginYearMonth: $linkageTarget['beginYearMonth'] ?? null,
            bodyStyle: $linkageTarget['bodyStyle'] ?? null,
            bodyStyleKey: $linkageTarget['bodyStyleKey'] ?? null,
            boreDiameter: $linkageTarget['boreDiameter'] ?? null,
            brakeType: $linkageTarget['brakeType'] ?? null,
            brakeTypeKey: $linkageTarget['brakeTypeKey'] ?? null,
            cabs: Collection::make($linkageTarget['cabs'] ?? [])
                ->map(fn(array $item) => $this->createLinkageTargetCabDTO($item))
                ->values(),
            capacityCC: $linkageTarget['capacityCC'] ?? null,
            capacityLiters: $linkageTarget['capacityLiters'] ?? null,
            compressionFrom: $linkageTarget['compressionFrom'] ?? null,
            compressionTo: $linkageTarget['compressionTo'] ?? null,
            coolingType: $linkageTarget['coolingType'] ?? null,
            coolingTypeKey: $linkageTarget['coolingTypeKey'] ?? null,
            crankshaftBearings: $linkageTarget['crankshaftBearings'] ?? null,
            cylinders: $linkageTarget['cylinders'] ?? null,
            cylinderDesign: $linkageTarget['cylinderDesign'] ?? null,
            cylinderDesignKey: $linkageTarget['cylinderDesignKey'] ?? null,
            description: $linkageTarget['description'] ?? null,
            driveType: $linkageTarget['driveType'] ?? null,
            driveTypeKey: $linkageTarget['driveTypeKey'] ?? null,
            emissionStandard: $linkageTarget['emissionStandard'] ?? null,
            endYearMonth: $linkageTarget['endYearMonth'] ?? null,
            engines: Collection::make($linkageTarget['engines'] ?? [])
                ->map(fn(array $item) => $this->createLinkageTargetEngineDTO($item))
                ->values(),
            engineConstructionType: $linkageTarget['engineConstructionType'] ?? null,
            engineConstructionTypeKey: $linkageTarget['engineConstructionTypeKey'] ?? null,
            engineManagement: $linkageTarget['engineManagement'] ?? null,
            engineManagementKey: $linkageTarget['engineManagementKey'] ?? null,
            engineType: $linkageTarget['engineType'] ?? null,
            engineTypeKey: $linkageTarget['engineTypeKey'] ?? null,
            fuelMixtureFormationType: $linkageTarget['fuelMixtureFormationType'] ?? null,
            fuelMixtureFormationTypeKey: $linkageTarget['fuelMixtureFormationTypeKey'] ?? null,
            fuelType: $linkageTarget['fuelType'] ?? null,
            fuelTypeKey: $linkageTarget['fuelTypeKey'] ?? null,
            hmdMfrModelId: $linkageTarget['hmdMfrModelId'] ?? null,
            hmdMfrModelName: $linkageTarget['hmdMfrModelName'] ?? null,
            horsePowerFrom: $linkageTarget['horsePowerFrom'] ?? null,
            horsePowerTo: $linkageTarget['horsePowerTo'] ?? null,
            kbaNumbers: $linkageTarget['kbaNumbers'] ?? null,
            kiloWattsFrom: $linkageTarget['kiloWattsFrom'] ?? null,
            kiloWattsTo: $linkageTarget['kiloWattsTo'] ?? null,
            performance: $this->createPerformanceRecordDTO($linkageTarget['performance'] ?? []),
            rmiTypeId: $linkageTarget['rmiTypeId'] ?? null,
            rpmKwFrom: $linkageTarget['rpmKwFrom'] ?? null,
            salesDescription: $linkageTarget['salesDescription'] ?? null,
            secondaryTypes: Collection::make($linkageTarget['secondaryTypes'] ?? [])
                ->map(fn(array $item) => $this->createLinkageTargetSecondaryTypeDTO($item))
                ->values(),
            stroke: $linkageTarget['stroke'] ?? null,
            subLinkageTargetType: $linkageTarget['subLinkageTargetType'] ?? null,
            tonnage: $linkageTarget['tonnage'] ?? null,
            valves: $linkageTarget['valves'] ?? null,
            valveControl: $linkageTarget['valveControl'] ?? null,
            valveControlKey: $linkageTarget['valveControlKey'] ?? null,
            vehicleBodyTypes: Collection::make($linkageTarget['vehicleBodyTypes'] ?? [])
                ->map(fn(array $item) => $this->createVehicleBodyTypeRecordDTO($item))
                ->values(),
            vehicleImages: Collection::make($linkageTarget['vehicleImages'] ?? [])
                ->map(fn(array $item) => $this->createVehicleImageRecordDTO($item))
                ->values(),
            vehicleModelSeriesId: $linkageTarget['vehicleModelSeriesId'] ?? null,
            vehicleModelSeriesName: $linkageTarget['vehicleModelSeriesName'] ?? null,
            vehicleSalesDescription: $linkageTarget['vehicleSalesDescription'] ?? null,
            vehiclesInOperation: Collection::make($linkageTarget['vehiclesInOperation'] ?? [])
                ->map(fn(array $item) => $this->createVehicleInOperationDTO($item))
                ->values(),
            wheelBases: Collection::make($linkageTarget['wheelBases'] ?? [])
                ->map(fn(array $item) => $this->createLinkageTargetWheelBaseDTO($item))
                ->values(),
            wheelMounting: $linkageTarget['wheelMounting'] ?? null,
            wheelMountingKey: $linkageTarget['wheelMountingKey'] ?? null,
        );
    }

    /**
     * @param array $axle
     * @return LinkageTargetAxleDTO|null
     */
    private function createLinkageTargetAxleDTO(array $axle): ?LinkageTargetAxleDTO
    {
        if (!$axle) {
            return null;
        }

        return new LinkageTargetAxleDTO(
            id: $axle['id'],
            description: $axle['description'],
            mfrId: $axle['mfrId'],
            mfrName: $axle['mfrName'],
            mfrShortName: $axle['mfrShortName'],
            vehicleModelSeriesId: $axle['vehicleModelSeriesId'] ?? null,
            vehicleModelSeriesName: $axle['vehicleModelSeriesName'] ?? null,
        );
    }

    /**
     * @param array $axleBodyTypes
     * @return AxleBodyTypeRecordDTO|null
     */
    private function createAxleBodyTypeRecordDTO(array $axleBodyTypes): ?AxleBodyTypeRecordDTO
    {
        if (!$axleBodyTypes) {
            return null;
        }

        return new AxleBodyTypeRecordDTO(
            bodyTypeCode: $axleBodyTypes['bodyTypeCode'],
        );
    }

    /**
     * @param array $cabs
     * @return LinkageTargetCabDTO|null
     */
    private function createLinkageTargetCabDTO(array $cabs): ?LinkageTargetCabDTO
    {
        if (!$cabs) {
            return null;
        }

        return new LinkageTargetCabDTO(
            id: $cabs['id'],
            description: $cabs['description'],
        );
    }

    /**
     * @param array $engines
     * @return LinkageTargetEngineDTO|null
     */
    private function createLinkageTargetEngineDTO(array $engines): ?LinkageTargetEngineDTO
    {
        if (!$engines) {
            return null;
        }

        return new LinkageTargetEngineDTO(
            code: $engines['code'],
            id: $engines['id'] ?? null,
        );
    }

    /**
     * @param array $performance
     * @return PerformanceRecordDTO|null
     */
    private function createPerformanceRecordDTO(array $performance): ?PerformanceRecordDTO
    {
        if (!$performance) {
            return null;
        }

        return new PerformanceRecordDTO(
            continuousPower: $performance['continuousPower'] ?? null,
            systemPower: $performance['systemPower'] ?? null,
            boostModePower: $performance['boostModePower'] ?? null,
            maximumPower: $performance['maximumPower'] ?? null,
            combustionPower: $performance['combustionPower'] ?? null,
        );
    }

    /**
     * @param array $secondaryTypes
     * @return LinkageTargetSecondaryTypeDTO|null
     */
    private function createLinkageTargetSecondaryTypeDTO(array $secondaryTypes): ?LinkageTargetSecondaryTypeDTO
    {
        if (!$secondaryTypes) {
            return null;
        }

        return new LinkageTargetSecondaryTypeDTO(
            id: $secondaryTypes['id'],
            description: $secondaryTypes['description'],
        );
    }

    /**
     * @param array $vehicleBodyTypes
     * @return VehicleBodyTypeRecordDTO|null
     */
    private function createVehicleBodyTypeRecordDTO(array $vehicleBodyTypes): ?VehicleBodyTypeRecordDTO
    {
        if (!$vehicleBodyTypes) {
            return null;
        }

        return new VehicleBodyTypeRecordDTO(
            bodyTypeCode: $vehicleBodyTypes['bodyTypeCode'],
        );
    }

    /**
     * @param array $vehicleImages
     * @return VehicleImageRecordDTO|null
     */
    private function createVehicleImageRecordDTO(array $vehicleImages): ?VehicleImageRecordDTO
    {
        if (!$vehicleImages) {
            return null;
        }

        return new VehicleImageRecordDTO(
            imageURL50: $vehicleImages['imageURL50'],
            imageURL100: $vehicleImages['imageURL100'],
            imageURL200: $vehicleImages['imageURL200'],
            imageURL400: $vehicleImages['imageURL400'],
            imageURL800: $vehicleImages['imageURL800'],
        );
    }

    /**
     * @param array $vehicleInOperation
     * @return VehicleInOperationDTO|null
     */
    private function createVehicleInOperationDTO(array $vehicleInOperation): ?VehicleInOperationDTO
    {
        if (!$vehicleInOperation) {
            return null;
        }

        return new VehicleInOperationDTO(
            count: $vehicleInOperation['count'],
            dataSource: $vehicleInOperation['dataSource'],
            dateFrom: $vehicleInOperation['dateFrom'] ?? null,
            dateTo: $vehicleInOperation['dateTo'] ?? null,
        );
    }

    /**
     * @param array $wheelBase
     * @return LinkageTargetWheelBaseDTO|null
     */
    private function createLinkageTargetWheelBaseDTO(array $wheelBase): ?LinkageTargetWheelBaseDTO
    {
        if (!$wheelBase) {
            return null;
        }

        return new LinkageTargetWheelBaseDTO(
            axlePosition: $wheelBase['axlePosition'],
            axlePositionKey: $wheelBase['axlePositionKey'],
            wheelBase: $wheelBase['wheelBase'],
        );
    }

    /**
     * @param array $linkageTargetTypeFacet
     * @return LinkageTargetTypeFacetDTO|null
     */
    private function createLinkageTargetTypeFacetDTO(array $linkageTargetTypeFacet): ?LinkageTargetTypeFacetDTO
    {
        if (!$linkageTargetTypeFacet) {
            return null;
        }

        return new LinkageTargetTypeFacetDTO(
            total: $linkageTargetTypeFacet['total'] ?? 0,
            counts: Collection::make($linkageTargetTypeFacet['counts'] ?? [])
                ->map(fn(array $item) => $this->createLinkageTargetTypeFacetCountDTO($item))
                ->values(),
        );
    }

    /**
     * @param array $linkageTargetTypeCount
     * @return LinkageTargetTypeFacetCountDTO|null
     */
    private function createLinkageTargetTypeFacetCountDTO(array $linkageTargetTypeCount): ?LinkageTargetTypeFacetCountDTO
    {
        if (!$linkageTargetTypeCount) {
            return null;
        }

        return new LinkageTargetTypeFacetCountDTO(
            count: $linkageTargetTypeCount['count'],
            type: $linkageTargetTypeCount['type'],
        );
    }

    /**
     * @param array $mfrFacet
     * @return MfrFacetDTO|null
     */
    private function createMfrFacetDTO(array $mfrFacet): ?MfrFacetDTO
    {
        if (!$mfrFacet) {
            return null;
        }

        return new MfrFacetDTO(
            total: $mfrFacet['total'] ?? 0,
            counts: Collection::make($mfrFacet['counts'] ?? [])
                ->map(fn(array $item) => $this->createLinkageTargetMfrFacetCountDTO($item))
                ->values(),
        );
    }

    /**
     * @param array $mfrCount
     * @return LinkageTargetMfrFacetCountDTO|null
     */
    private function createLinkageTargetMfrFacetCountDTO(array $mfrCount): ?LinkageTargetMfrFacetCountDTO
    {
        if (!$mfrCount) {
            return null;
        }

        return new LinkageTargetMfrFacetCountDTO(
            id: $mfrCount['id'],
            count: $mfrCount['count'],
            name: $mfrCount['name'],
            linkageTargetType: $mfrCount['linkageTargetType'],
        );
    }

    /**
     * @param array $vehicleModelSeriesFacet
     * @return VehicleModelSeriesFacetDTO|null
     */
    private function createVehicleModelSeriesFacetDTO(array $vehicleModelSeriesFacet): ?VehicleModelSeriesFacetDTO
    {
        if (!$vehicleModelSeriesFacet) {
            return null;
        }

        return new VehicleModelSeriesFacetDTO(
            total: $vehicleModelSeriesFacet['total'] ?? 0,
            counts: Collection::make($vehicleModelSeriesFacet['counts'] ?? [])
                ->map(fn(array $item) => $this->createLinkageTargetVehicleModelSeriesFacetCountDTO($item))
                ->values(),
        );
    }

    /**
     * @param array $vehicleModelSeriesCount
     * @return LinkageTargetVehicleModelSeriesFacetCountDTO|null
     */
    private function createLinkageTargetVehicleModelSeriesFacetCountDTO(array $vehicleModelSeriesCount): ?LinkageTargetVehicleModelSeriesFacetCountDTO
    {
        if (!$vehicleModelSeriesCount) {
            return null;
        }

        return new LinkageTargetVehicleModelSeriesFacetCountDTO(
            id: $vehicleModelSeriesCount['id'],
            count: $vehicleModelSeriesCount['count'],
            name: $vehicleModelSeriesCount['name'],
            beginYearMonth: $vehicleModelSeriesCount['beginYearMonth'] ?? null,
            endYearMonth: $vehicleModelSeriesCount['endYearMonth'] ?? null,
        );
    }

    /**
     * @param array $yearFacet
     * @return YearFacetDTO|null
     */
    private function createYearFacetDTO(array $yearFacet): ?YearFacetDTO
    {
        if (!$yearFacet) {
            return null;
        }

        return new YearFacetDTO(
            total: $yearFacet['total'] ?? 0,
            counts: Collection::make($yearFacet['counts'] ?? [])
                ->map(fn(array $item) => $this->createLinkageTargetYearFacetCountDTO($item))
                ->values(),
        );
    }

    /**
     * @param array $yearCount
     * @return LinkageTargetYearFacetCountDTO|null
     */
    private function createLinkageTargetYearFacetCountDTO(array $yearCount): ?LinkageTargetYearFacetCountDTO
    {
        if (!$yearCount) {
            return null;
        }

        return new LinkageTargetYearFacetCountDTO(
            year: $yearCount['year'],
            count: $yearCount['count'],
        );
    }

    /**
     * @param array|null $targets
     * @param array|null $filter
     * @return array[]
     */
    private function createLinkageTargetsPayload(?array $targets = null, ?array $filter = null): array
    {
        $requestData = [
            'axleBodyKeys' => $filter['axleBodyKeys'] ?? null,
            'axleBrakeSizeKeys' => $filter['axleBrakeSizeKeys'] ?? null,
            'axleConfigurationKeys' => $filter['axleConfigurationKeys'] ?? null,
            'axleDescription' => $filter['axleDescription'] ?? null,
            'axleStyleKeys' => $filter['axleStyleKeys'] ?? null,
            'axleTypeKeys' => $filter['axleTypeKeys'] ?? null,
            'bodyTypeCode' => $filter['bodyTypeCode'] ?? null,
            'brakeTypeKeys' => $filter['brakeTypeKeys'] ?? null,
            'capacityCCFrom' => $filter['capacityCCFrom'] ?? null,
            'capacityCCTo' => $filter['capacityCCTo'] ?? null,
            'cvBodyStyleKeys' => $filter['cvBodyStyleKeys'] ?? null,
            'cvBodyTypeIds' => $filter['cvBodyTypeIds'] ?? null,
            'description' => $filter['description'] ?? null,
            'engineCode' => $filter['engineCode'] ?? null,
            'engineIds' => $filter['engineIds'] ?? null,
            'filterMode' => $filter['filterMode'] ?? 'all',
            'fuelTypeKeys' => $filter['fuelTypeKeys'] ?? null,
            'hmdMfrModelIds' => $filter['hmdMfrModelIds'] ?? null,
            'horsePowerFrom' => $filter['horsePowerFrom'] ?? null,
            'horsePowerTo' => $filter['horsePowerTo'] ?? null,
            'includeAllFacets' => $filter['includeAllFacets'] ?? false,
            'includeDescriptionFacets' => $filter['includeDescriptionFacets'] ?? false,
            'includeHMDModelFacets' => $filter['includeHMDModelFacets'] ?? false,
            'includeLinkageTargetTypeFacets' => $filter['includeLinkageTargetTypeFacets'] ?? false,
            'includeMfrFacets' => $filter['includeMfrFacets'] ?? false,
            'includeVehicleModelSeriesFacets' => $filter['includeVehicleModelSeriesFacets'] ?? false,
            'includeYearFacets' => $filter['includeYearFacets'] ?? false,
            'kiloWattsFrom' => $filter['kiloWattsFrom'] ?? null,
            'kiloWattsTo' => $filter['kiloWattsTo'] ?? null,
            'lang' => $filter["lang"] ?? Config::get('tecdoc.lang'),
            'linkageTargetCountry' => Config::get('tecdoc.country'),
            'linkageTargetCountryGroupFlag' => $filter['linkageTargetCountryGroupFlag'] ?? false,
            'linkageTargetType' => $filter['linkageTargetType'] ?? 'P',
            'mfrIds' => $filter['mfrIds'] ?? null,
            'nuts1' => $filter['nuts1'] ?? null,
            'page' => 1,
            'perPage' => $filter['perPage'] ?? null,
            'provider' => Config::get('tecdoc.provider_id'),
            'query' => $filter['query'] ?? null,
            'rmiTypeIds' => $filter['rmiTypeIds'] ?? null,
            'salesDescription' => $filter['salesDescription'] ?? null,
            'sort' => $filter['sort'] ?? null,
            'tonnageFrom' => $filter['tonnageFrom'] ?? null,
            'tonnageTo' => $filter['tonnageTo'] ?? null,
            'vehicleModelSeriesIds' => $filter['vehicleModelSeriesIds'] ?? null,
            'vehicleModelSeriesName' => $filter['vehicleModelSeriesName'] ?? null,
            'wheelMountingKeys' => $filter['wheelMountingKeys'] ?? null,
            'years' => $filter['years'] ?? null,
        ];

        if ($targets) {
            $requestData['linkageTargetIds'] = $targets;
        }

        return [
            'getLinkageTargets' => $this->cleanPayload($requestData),
        ];
    }

    /**
     * @param Collection<ArticleLinkageTargetDTO>|null $targetDTOCollection
     * @param array|null $filter
     * @return array[]
     */
    public function createGetLinkageTargetsPayload(?Collection $targetDTOCollection = null, ?array $filter = null): array
    {
        $payload = $targetDTOCollection?->map(fn(ArticleLinkageTargetDTO $item) => $item->forLinkageTargetPayload())->values()->toArray();
        return $this->createLinkageTargetsPayload($payload, $filter);
    }

    /**
     * @param array $item
     * @return LinkageTargetDTO
     */
    public function getResponseDTO(array $item): LinkageTargetDTO
    {
        return new LinkageTargetDTO(
            total: $item["total"] ?? 0,
            descriptionFacet: $this->createDescriptionFacetDTO($item["descriptionFacets"] ?? []),
            hmdModelFacet: $this->createHmdModelFacetDTO($item["hmdModelFacets"] ?? []),
            linkageTargetItems: Collection::make($item['linkageTargets'] ?? [])
                ->map(fn(array $target) => $this->createLinkageTargetItemDTO($target))
                ->values(),
            linkageTargetTypeFacet: $this->createLinkageTargetTypeFacetDTO($item["linkageTargetTypeFacets"] ?? []),
            mfrFacet: $this->createMfrFacetDTO($item["mfrFacets"] ?? []),
            vehicleModelSeriesFacet: $this->createVehicleModelSeriesFacetDTO($item["vehicleModelSeriesFacets"] ?? []),
            yearFacet: $this->createYearFacetDTO($item["yearFacets"] ?? []),
        );
    }
}