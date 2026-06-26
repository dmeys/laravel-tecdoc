<?php

namespace Composite\TecDoc\Services;

use Composite\TecDoc\DTOs\Vehicle\VehicleDTO;
use Composite\TecDoc\Facades\TecDoc;
use Composite\TecDoc\Models\Vehicle\Vehicle;
use Illuminate\Support\Facades\Config;

class Vehicles
{
    /**
     * Find vehicles by CarIds
     *
     * $filter = [ // optional
     *  "lang" => "HU", // default is in config file
     * ]
     *
     * @param int $carId
     * @param array|null $filter
     * @return Vehicle
     */
    public function find(int $carId, array $filter = null): Vehicle
    {
        $response = TecDoc::post('', $this->createFindPayload($carId, $filter));
        return (new VehicleDTO())->createVehicleModel($response);
    }

    /**
     * Get vehicle ids by criteria
     *
     * $manuId = 5;
     * $modId = 4955;
     * $filter = [ // optional
     *  "carType" => "P",  // default is P (passenger car)
     *  "lang" => "HU",  // default is in config file
     * ];
     *
     * carType options:
     *  P: Passenger car
     *  O: Commercial vehicle
     *  L: Light commercial vehicle
     *
     * @param int $manuId
     * @param int $modId
     * @param array|null $filter
     * @return array
     */
    public function findByNumber(int $manuId, int $modId, array $filter = null): array
    {
        $response = TecDoc::post('', $this->createFindByNumberPayload($manuId, $modId, $filter));
        return (new VehicleDTO())->mapVehicleCollection($response);
    }

    /**
     * Create get ids request payload for API calls
     *
     * @param int $manuId
     * @param int $modId
     * @param array|null $filter
     * @return array[]
     */
    private function createFindByNumberPayload(int $manuId, int $modId, array $filter = null): array
    {
        return [
            "getVehicleIdsByCriteria" => [
                "countriesCarSelection" => Config::get('tecdoc.country'),
                "provider" => Config::get('tecdoc.provider_id'),
                "carType" => $filter["carType"] ?? "P",
                "lang" => $filter["lang"] ?? Config::get('tecdoc.lang'),
                "manuId" => $manuId,
                "modId" => $modId
            ]
        ];
    }

    /**
     * Create filter request payload for API calls
     *
     * @param int $carId
     * @param array|null $filter
     * @return array[]
     */
    private function createFindPayload(int $carId, array $filter = null): array
    {
        return [
            "getVehicleByIds3" => [
                "country" => Config::get('tecdoc.country'),
                "articleCountry" => Config::get('tecdoc.country'),
                "countriesCarSelection" => Config::get('tecdoc.country'),
                "provider" => Config::get('tecdoc.provider_id'),
                "lang" => $filter["lang"] ?? Config::get('tecdoc.lang'),
                "motorCodes" => true,
                "carIds" => [
                    "array" => [$carId]
                ]
            ]
        ];
    }
}
