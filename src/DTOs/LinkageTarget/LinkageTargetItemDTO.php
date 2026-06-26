<?php

namespace Composite\TecDoc\DTOs\LinkageTarget;

use Composite\TecDoc\DTOs\LinkageTarget\Item\AxleBodyTypeRecordDTO;
use Composite\TecDoc\DTOs\LinkageTarget\Item\LinkageTargetAxleDTO;
use Composite\TecDoc\DTOs\LinkageTarget\Item\LinkageTargetCabDTO;
use Composite\TecDoc\DTOs\LinkageTarget\Item\LinkageTargetEngineDTO;
use Composite\TecDoc\DTOs\LinkageTarget\Item\LinkageTargetSecondaryTypeDTO;
use Composite\TecDoc\DTOs\LinkageTarget\Item\LinkageTargetWheelBaseDTO;
use Composite\TecDoc\DTOs\LinkageTarget\Item\PerformanceRecordDTO;
use Composite\TecDoc\DTOs\LinkageTarget\Item\VehicleBodyTypeRecordDTO;
use Composite\TecDoc\DTOs\LinkageTarget\Item\VehicleImageRecordDTO;
use Composite\TecDoc\DTOs\LinkageTarget\Item\VehicleInOperationDTO;
use Illuminate\Support\Collection;

class LinkageTargetItemDTO
{
    /**
     * @param int $linkageTargetId
     * @param string $linkageTargetType
     * @param int $mfrId
     * @param string $mfrName
     * @param string $mfrShortName
     * @param string|null $aspiration
     * @param int|null $aspirationKey
     * @param Collection<LinkageTargetAxleDTO>|null $axles
     * @param string|null $axleBody
     * @param int|null $axleBodyKey
     * @param Collection<AxleBodyTypeRecordDTO>|null $axleBodyTypes
     * @param string|null $axleConfiguration
     * @param int|null $axleConfigurationKey
     * @param int|null $axleLoadFromKg
     * @param int|null $axleLoadToKg
     * @param string|null $axleStyle
     * @param int|null $axleStyleKey
     * @param string|null $axleType
     * @param int|null $axleTypeKey
     * @param string|null $beginYearMonth
     * @param string|null $bodyStyle
     * @param int|null $bodyStyleKey
     * @param float|null $boreDiameter
     * @param string|null $brakeType
     * @param int|null $brakeTypeKey
     * @param Collection<LinkageTargetCabDTO>|null $cabs
     * @param int|null $capacityCC
     * @param float|null $capacityLiters
     * @param int|null $compressionFrom
     * @param int|null $compressionTo
     * @param string|null $coolingType
     * @param int|null $coolingTypeKey
     * @param int|null $crankshaftBearings
     * @param int|null $cylinders
     * @param string|null $cylinderDesign
     * @param int|null $cylinderDesignKey
     * @param string|null $description
     * @param string|null $driveType
     * @param int|null $driveTypeKey
     * @param string|null $emissionStandard
     * @param string|null $endYearMonth
     * @param Collection<LinkageTargetEngineDTO>|null $engines
     * @param string|null $engineConstructionType
     * @param int|null $engineConstructionTypeKey
     * @param string|null $engineManagement
     * @param int|null $engineManagementKey
     * @param string|null $engineType
     * @param int|null $engineTypeKey
     * @param string|null $fuelMixtureFormationType
     * @param int|null $fuelMixtureFormationTypeKey
     * @param string|null $fuelType
     * @param int|null $fuelTypeKey
     * @param int|null $hmdMfrModelId
     * @param string|null $hmdMfrModelName
     * @param int|null $horsePowerFrom
     * @param int|null $horsePowerTo
     * @param array|null $kbaNumbers
     * @param int|null $kiloWattsFrom
     * @param int|null $kiloWattsTo
     * @param PerformanceRecordDTO|null $performance
     * @param int|null $rmiTypeId
     * @param int|null $rpmKwFrom
     * @param string|null $salesDescription
     * @param Collection<LinkageTargetSecondaryTypeDTO>|null $secondaryTypes
     * @param float|null $stroke
     * @param string|null $subLinkageTargetType
     * @param int|null $tonnage
     * @param int|null $valves
     * @param string|null $valveControl
     * @param int|null $valveControlKey
     * @param Collection<VehicleBodyTypeRecordDTO>|null $vehicleBodyTypes
     * @param Collection<VehicleImageRecordDTO>|null $vehicleImages
     * @param int|null $vehicleModelSeriesId
     * @param string|null $vehicleModelSeriesName
     * @param string|null $vehicleSalesDescription
     * @param Collection<VehicleInOperationDTO>|null $vehiclesInOperation
     * @param Collection<LinkageTargetWheelBaseDTO>|null $wheelBases
     * @param string|null $wheelMounting
     * @param int|null $wheelMountingKey
     */
    public function __construct(
        public int $linkageTargetId,
        public string $linkageTargetType,
        public int $mfrId,
        public string $mfrName,
        public string $mfrShortName,
        public ?string $aspiration,
        public ?int $aspirationKey,
        public ?Collection $axles,
        public ?string $axleBody,
        public ?int $axleBodyKey,
        public ?Collection $axleBodyTypes,
        public ?string $axleConfiguration,
        public ?int $axleConfigurationKey,
        public ?int $axleLoadFromKg,
        public ?int $axleLoadToKg,
        public ?string $axleStyle,
        public ?int $axleStyleKey,
        public ?string $axleType,
        public ?int $axleTypeKey,
        public ?string $beginYearMonth,
        public ?string $bodyStyle,
        public ?int $bodyStyleKey,
        public ?float $boreDiameter,
        public ?string $brakeType,
        public ?int $brakeTypeKey,
        public ?Collection $cabs,
        public ?int $capacityCC,
        public ?float $capacityLiters,
        public ?int $compressionFrom,
        public ?int $compressionTo,
        public ?string $coolingType,
        public ?int $coolingTypeKey,
        public ?int $crankshaftBearings,
        public ?int $cylinders,
        public ?string $cylinderDesign,
        public ?int $cylinderDesignKey,
        public ?string $description,
        public ?string $driveType,
        public ?int $driveTypeKey,
        public ?string $emissionStandard,
        public ?string $endYearMonth,
        public ?Collection $engines,
        public ?string $engineConstructionType,
        public ?int $engineConstructionTypeKey,
        public ?string $engineManagement,
        public ?int $engineManagementKey,
        public ?string $engineType,
        public ?int $engineTypeKey,
        public ?string $fuelMixtureFormationType,
        public ?int $fuelMixtureFormationTypeKey,
        public ?string $fuelType,
        public ?int $fuelTypeKey,
        public ?int $hmdMfrModelId,
        public ?string $hmdMfrModelName,
        public ?int $horsePowerFrom,
        public ?int $horsePowerTo,
        public ?array $kbaNumbers,
        public ?int $kiloWattsFrom,
        public ?int $kiloWattsTo,
        public ?PerformanceRecordDTO $performance,
        public ?int $rmiTypeId,
        public ?int $rpmKwFrom,
        public ?string $salesDescription,
        public ?Collection $secondaryTypes,
        public ?float $stroke,
        public ?string $subLinkageTargetType,
        public ?int $tonnage,
        public ?int $valves,
        public ?string $valveControl,
        public ?int $valveControlKey,
        public ?Collection $vehicleBodyTypes,
        public ?Collection $vehicleImages,
        public ?int $vehicleModelSeriesId,
        public ?string $vehicleModelSeriesName,
        public ?string $vehicleSalesDescription,
        public ?Collection $vehiclesInOperation,
        public ?Collection $wheelBases,
        public ?string $wheelMounting,
        public ?int $wheelMountingKey,
    )
    {
    }
}