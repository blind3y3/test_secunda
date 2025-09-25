<?php

declare(strict_types=1);

namespace Modules\Building\Dto;

readonly class SquareSearchDto
{
    public function __construct(
        private float $latMin,
        private float $latMax,
        private float $lngMin,
        private float $lngMax
    ) {
    }

    public function getLatMin(): float
    {
        return $this->latMin;
    }

    public function getLatMax(): float
    {
        return $this->latMax;
    }

    public function getLngMin(): float
    {
        return $this->lngMin;
    }

    public function getLngMax(): float
    {
        return $this->lngMax;
    }

}