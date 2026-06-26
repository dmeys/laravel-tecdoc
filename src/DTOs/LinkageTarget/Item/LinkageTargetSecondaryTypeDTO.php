<?php

namespace Composite\TecDoc\DTOs\LinkageTarget\Item;

class LinkageTargetSecondaryTypeDTO
{
    /**
     * @param int $id
     * @param string $description
     */
    public function __construct(
        public int $id,
        public string $description,
    )
    {
    }
}