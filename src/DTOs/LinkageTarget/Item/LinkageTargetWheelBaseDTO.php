<?php

namespace Composite\TecDoc\DTOs\LinkageTarget\Item;

class LinkageTargetWheelBaseDTO
{
    /**
     * @param string $axlePosition
     * @param string $axlePositionKey
     * @param int $wheelBase
     */
    public function __construct(
        public string $axlePosition,
        public string $axlePositionKey,
        public int $wheelBase,
    )
    {
    }
}