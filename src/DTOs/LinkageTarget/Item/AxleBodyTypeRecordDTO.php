<?php

namespace Composite\TecDoc\DTOs\LinkageTarget\Item;

class AxleBodyTypeRecordDTO
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