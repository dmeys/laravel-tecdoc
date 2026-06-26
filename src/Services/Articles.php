<?php

namespace Composite\TecDoc\Services;

use Composite\TecDoc\DTOs\Article\ArticleDTO;
use Composite\TecDoc\Facades\TecDoc;
use Composite\TecDoc\Mappers\Article\ArticleLinkageTargetDataMapper;
use Composite\TecDoc\Models\Article\Article;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;

class Articles
{
    public function __construct(
        protected ArticleLinkageTargetDataMapper $articleLinkageTargetMapper,
    )
    {
    }

    /**
     * Get article ids with state
     *
     * $filter = [
     *  "lang" => "HU",  // default is in config file
     *  "assemblyGroupNodeId" => 100006, // Required
     *  "linkingTargetId" => 26582, // Required (carId / motor id)
     *  "linkingTargetType" => "P",  // default is P (passenger car)
     *  "sort" => 1 // 1: by brand name, 2: by generic article name
     *  "brandNo" => [ // optional
     *      5,
     *      347,
     *      432
     *  ]
     * ]
     *
     * linkingTargetType options:
     *  P: Passenger car
     *  O: Commercial vehicle
     *  L: Light commercial vehicle
     *  M: Motor
     *  A: Axles
     *  K: Body type
     *  U: Universal
     *
     * sort options:
     *  1: Sort by brand name
     *  2: Sort by generic article name
     *
     * @param  array $filter
     * @return array
     */
    public function filter(array $filter): array
    {
        $response = TecDoc::post('', $this->createIdsPayload($filter));
        return (new ArticleDTO())->mapArticleCollection($response);
    }

    /**
     * Find article by articleId, and filter results
     * if needed
     *
     * $articleId = 599605873; // Required
     * $filter = [ // Optional
     *  'lang' => 'HU',
     *  'attributes' => true,
     *  'basicData' => true,
     *  'documents' => true,
     *  'eanNumbers' => true,
     *  'immediateAttributes' => true,
     *  'immediateInfo' => true,
     *  'info' => true,
     *  'mainArticles' => true,
     *  'normalAustauschPrice' => false,
     *  'oeNumbers' => true,
     *  'prices' => true,
     *  'replacedByNumbers' => true,
     *  'replacedNumbers' => true,
     *  'thumbnails' => true,
     *  'usageNumbers' => true,
     * ]
     *
     * @param int $articleId
     * @param array|null $filter
     * @return Article
     */
    public function find(int $articleId, array $filter = null): Article
    {
        $response = TecDoc::post('', $this->createFindPayload($articleId, $filter));
        return (new ArticleDTO())->createArticleModel($response);
    }

    /**
     * Find article by any number
     *
     * $articleNumber = '7.03703.90.0'; // Required
     * $filter = [ // optional
     *  'lang' => 'HU',
     *  'numberType' => 0,
     *  'searchExact' => true,
     * ]
     * 
     * numberType options:
     *  0: Article number
     *  1: OE number
     *  2: Trade number
     *  3: Comparable number
     *  4: Replacement number
     *  5: Replaced number
     *  6: EAN number
     *  10: Any number
     * 
     * @param  mixed $articleNumber
     * @param  mixed $filter
     * @return array
     */
    public function findByNumber(string $articleNumber, array $filter = null): array
    {
        $response = TecDoc::post('', $this->createFindByNumberPayload($articleNumber, $filter));
        return (new ArticleDTO())->mapArticleCollection($response);
    }

    /**
     * Find vehicles, motors and axles of a manufacturer, which are linked to articles.
     * This function can be used to lookup linkages for country groups but the article
     * country must be set in addition.
     *
     *  $articleId = 599605873; // Required
     *  $filter = [ // Optional
     *   'country' => 'DE',
     *   'countryGroupFlag' => false,
     *   'lang' => 'HU',
     *   'linkingTargetId' => -1,
     *   'linkingTargetManuId' => 16,
     *   'linkingTargetType' => 'P',
     *   'withMainArticles' => true,
     *  ]
     *
     * Linking target type:
     * P: Passenger car
     * O: Commercial vehicle
     * M: Motor
     * A: Axles
     * K: Body type
     *
     * @param int $articleId
     * @param array|null $filter
     * @return Collection
     */
    public function findArticleLinkageTargets(int $articleId, array $filter = null): Collection
    {
        $response = TecDoc::post('', $this->articleLinkageTargetMapper->createArticleLinkageTargetsPayload($articleId, $filter));
        return $this->articleLinkageTargetMapper->collectionFromResponse($response);
    }

    /**
     * Create get ids request payload for API calls
     *
     * @param  array $filter
     * @return array[]
     */
    private function createIdsPayload(array $filter): array
    {
        return [
            "getArticleIdsWithState" => [
                "articleCountry" => Config::get('tecdoc.country'),
                "provider" => Config::get('tecdoc.provider_id'),
                "lang" => $filter["lang"] ?? Config::get('tecdoc.lang'),
                "assemblyGroupNodeId" => $filter["assemblyGroupNodeId"],
                "linkingTargetId" => $filter["linkingTargetId"],
                "linkingTargetType" => $filter["linkingTargetType"] ?? "P",
                "sort" => $filter["sort"] ?? 1,
                "brandNo" => [
                    "array" => $filter["brandNo"] ?? []
                ]
            ]
        ];
    }

    /**
     * @param int $articleId
     * @param array|null $filter
     * @return array[]
     */
    public function createFindPayload(int $articleId, array $filter = null): array
    {
        return [
            'getDirectArticlesByIds6' => [
                'articleCountry' => Config::get('tecdoc.country'),
                'provider' => Config::get('tecdoc.provider_id'),
                'articleId' => [
                    'array' => [
                        $articleId,
                    ],
                ],
                'lang' => $filter["lang"] ?? Config::get('tecdoc.lang'),
                'attributs' => $filter['attributs'] ?? true,
                'basicData' => $filter['basicData'] ?? true,
                'documents' => $filter['documents'] ?? true,
                'eanNumbers' => $filter['eanNumbers'] ?? true,
                'immediateAttributs' => $filter['immediateAttributs'] ?? true,
                'immediateInfo' => $filter['immediateInfo'] ?? true,
                'info' => $filter['info'] ?? true,
                'mainArticles' => $filter['mainArticles'] ?? true,
                'normalAustauschPrice' => $filter['normalAustauschPrice'] ?? false,
                'oeNumbers' => $filter['oeNumbers'] ?? true,
                'prices' => $filter['prices'] ?? true,
                'replacedByNumbers' => $filter['replacedByNumbers'] ?? true,
                'replacedNumbers' => $filter['replacedNumbers'] ?? true,
                'thumbnails' => $filter['thumbnails'] ?? true,
                'usageNumbers' => $filter['usageNumbers'] ?? true,
            ],
        ];
    }

    /**
     * @param string $articleNumber
     * @param array|null $filter
     * @return array[]
     */
    public function createFindByNumberPayload(string $articleNumber, array $filter = null): array
    {
        return [
            'getArticleDirectSearchAllNumbersWithState' => [
                'articleCountry' => Config::get('tecdoc.country'),
                'provider' =>  Config::get('tecdoc.provider_id'),
                'lang' => $filter["lang"] ?? Config::get('tecdoc.lang'),
                'articleNumber' => $articleNumber,
                'numberType' => $filter["numberType"] ?? 0,
                'searchExact' => $filter["searchExact"] ?? true,
                'brandId' => $filter["brandId"] ?? null,
            ],
        ];
    }
}
