<?php

namespace Modules\Activity\Service;

interface ActivityServiceInterface
{
    public function getCurrentAndDescendIdsByName(string $name): array;
}