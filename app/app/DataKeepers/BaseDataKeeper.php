<?php

declare(strict_types=1);

namespace App\DataKeepers;

class BaseDataKeeper
{
    /** Базовый радиус для поиска, в метрах */
    public const int RADIUS = 50000;

    /** Количество записей для пагинации */
    public const int PER_PAGE = 20;
}