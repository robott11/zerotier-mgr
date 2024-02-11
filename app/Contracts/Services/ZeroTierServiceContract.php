<?php

namespace App\Contracts\Services;

use Minicli\ServiceInterface;

interface ZeroTierServiceContract extends ServiceInterface
{
    public function getNetwork(): array;
}
