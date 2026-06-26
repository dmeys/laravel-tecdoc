<?php

namespace Composite\TecDoc\DTOs\LinkageTarget\Item;

class VehicleImageRecordDTO
{
    /**
     * @param string $imageURL50
     * @param string $imageURL100
     * @param string $imageURL200
     * @param string $imageURL400
     * @param string $imageURL800
     */
    public function __construct(
        public string $imageURL50,
        public string $imageURL100,
        public string $imageURL200,
        public string $imageURL400,
        public string $imageURL800,
    )
    {
    }
}