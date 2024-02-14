<?php

namespace App\Contracts\Services;

use Minicli\ServiceInterface;

interface ZeroTierServiceContract extends ServiceInterface
{
    public function getNetworks(): array;

    public function getMembers(string $network): array;
    
    public function authorizeMember(string $network, string $member): bool;
}
