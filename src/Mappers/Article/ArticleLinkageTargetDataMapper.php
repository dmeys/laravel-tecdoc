<?php

namespace Composite\TecDoc\Mappers\Article;

use Composite\TecDoc\DTOs\Article\ArticleLinkageTargetDTO;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;

class ArticleLinkageTargetDataMapper
{
    /**
     * @param array $response
     * @return array
     */
    public function fetchDataFromResponse(array $response): array
    {
        return $response['data']['array'][0]['articleLinkages']['array'] ?? [];
    }

    /**
     * @param array $response
     * @return Collection
     */
    public function collectionFromResponse(array $response): Collection
    {
        $data = $this->fetchDataFromResponse($response);
        if (!$data) {
            return Collection::make([]);
        }

        return Collection::make($data)
            ->map(fn (array $item) => $this->getResponseDTO($item))
            ->values();
    }

    /**
     * @param array $item
     * @return ArticleLinkageTargetDTO
     */
    public function getResponseDTO(array $item): ArticleLinkageTargetDTO
    {
        return new ArticleLinkageTargetDTO(
            articleLinkId: (int) $item['articleLinkId'],
            linked: (bool) $item['linked'],
            linkingTargetId: (int) $item['linkingTargetId'],
            linkingTargetType: $item['linkingTargetType'],
        );
    }

    /**
     * @param int $articleId
     * @param array|null $filter
     * @return array[]
     */
    public function createArticleLinkageTargetsPayload(int $articleId, array $filter = null): array
    {
        return [
            'getArticleLinkedAllLinkingTarget4' => [
                'articleCountry' => Config::get('tecdoc.country'),
                'articleId' => $articleId,
                'country' => $filter["country"] ?? Config::get('tecdoc.country'),
                'countryGroupFlag' => $filter["countryGroupFlag"] ?? false,
                'lang' => $filter["lang"] ?? Config::get('tecdoc.lang'),
                'linkingTargetId' => $filter["linkingTargetId"] ?? -1,
                'linkingTargetManuId' => $filter["linkingTargetManuId"] ?? null,
                'linkingTargetType' => $filter["linkingTargetType"] ?? 'P',
                'provider' =>  Config::get('tecdoc.provider_id'),
                'withMainArticles' => $filter["withMainArticles"] ?? true,
            ],
        ];
    }
}