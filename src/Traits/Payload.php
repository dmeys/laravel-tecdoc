<?php

namespace Composite\TecDoc\Traits;

trait Payload
{
    /**
     * @param array $payload
     * @return array
     */
    private function cleanPayload(array $payload): array
    {
        return array_filter($payload, fn ($value) => $value !== null);
    }
}