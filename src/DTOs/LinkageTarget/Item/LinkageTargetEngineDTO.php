<?php

namespace Composite\TecDoc\DTOs\LinkageTarget\Item;

class LinkageTargetEngineDTO
{
    /**
     * @param string $code
     * @param int|null $id
     */
    public function __construct(
        public string $code,
        public ?int $id,
    )
    {
    }
}