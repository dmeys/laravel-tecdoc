<?php

namespace Composite\TecDoc\DTOs\LinkageTarget\Item;

class VehicleBodyTypeRecordDTO
{
    /**
     * @param string $bodyTypeCode
     */
    public function __construct(
        public string $bodyTypeCode,
    )
    {
    }
}