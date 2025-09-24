<?php

declare(strict_types=1);

namespace Modules\Building\Dto;

readonly class GeoSearchDto
{
    public function __construct(private float $latitude, private float $longitude, private int $radius = 50000)
    {
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function getRadius(): int
    {
        return $this->radius;
    }


}