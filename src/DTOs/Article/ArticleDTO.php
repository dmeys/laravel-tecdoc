<?php

namespace Composite\TecDoc\DTOs\Article;

use Composite\TecDoc\Models\Article\Article;
use Composite\TecDoc\Services\Articles;

class ArticleDTO
{

    /**
     * Create article model from array
     *
     * @param array $articleArray
     * @return Article
     */
    public function createArticleModel(array $articleArray): Article
    {
        if ($articleArray) {
            # code...
            $article = new Article();
            $article->setArticleAttributes((new ArticleAttributeDTO())->mapArticleAttributeCollection($articleArray));
            $article->setArticleDocuments((new ArticleDocumentDTO())->mapArticleDocumentCollection($articleArray));
            $article->setArticleInfo((new ArticleInfoDTO())->mapArticleInfoCollection($articleArray));
            // TODO articlePrices implementation, DTO and others
            $article->setArticleThumbnails((new ArticleThumbnailDTO())->mapArticleThumbnailCollection($articleArray));
            $article->setDirectArticle((new DirectArticleDTO())->createDirectArticleModel($articleArray));
            $article->setEanNumber((new EanNumberDTO())->mapEanNumberCollection($articleArray));
            $article->setImmediateAttributs((new ImmediateAttributDTO())->mapImmediateAttributCollection($articleArray));
            // TODO immediateInfo implementation, DTO and others
            // TODO mainArticle implementation, DTO and others
            $article->setOenNumbers((new OenNumberDTO())->mapOenNumberCollection($articleArray));
            // TODO replacedByNumber implementation, DTO and others
            // TODO replacedNumber implementation, DTO and others
            $article->setUsageNumbers((new UsageNumberDTO())->mapUsageNumberCollection($articleArray));

            return $article;
        }
    }

    /**
     * Map articles to array
     *
     * @param array $data
     * @return array
     */
    public function mapArticleCollection(array $data): array
    {
        $result = [];
        $articles = $data['data']['array'] ?? [];

        foreach ($articles as $article) {
            $result[] = app(Articles::class)->find($article['articleId']);
        }

        return $result;
    }
}
