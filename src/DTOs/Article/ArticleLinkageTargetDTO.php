<?php

namespace Composite\TecDoc\DTOs\Article;

class ArticleLinkageTargetDTO
{
    /**
     * @param int $articleLinkId
     * @param bool $linked
     * @param int $linkingTargetId
     * @param string $linkingTargetType
     */
    public function __construct(
        public int $articleLinkId,
        public bool $linked,
        public int $linkingTargetId,
        public string $linkingTargetType,
    )
    {
    }

    /**
     * @return array
     */
    public function forLinkageTargetPayload(): array
    {
        return [
            'id' => $this->linkingTargetId,
            'type' => $this->linkingTargetType,
        ];
    }
}