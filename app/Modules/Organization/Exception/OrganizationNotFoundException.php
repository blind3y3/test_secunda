<?php

declare(strict_types=1);

namespace Modules\Organization\Exception;

use Modules\Api\Exception\BaseApiException;
use Throwable;

class OrganizationNotFoundException extends BaseApiException
{
    public function __construct(?Throwable $previous = null)
    {
        parent::__construct("Organization not found", 404, $previous);
    }
}