<?php

namespace Composite\TecDoc\DTOs\LinkageTarget\Item;

class PerformanceRecordDTO
{
    /**
     * @param int|null $continuousPower
     * @param int|null $systemPower
     * @param int|null $boostModePower
     * @param int|null $maximumPower
     * @param int|null $combustionPower
     */
    public function __construct(
        public ?int $continuousPower = null,
        public ?int $systemPower = null,
        public ?int $boostModePower = null,
        public ?int $maximumPower = null,
        public ?int $combustionPower = null,
    )
    {
    }
}