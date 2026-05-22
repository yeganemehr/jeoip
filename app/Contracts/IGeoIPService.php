<?php

namespace App\Contracts;

use App\DTOs\Location;

interface IGeoIPService
{
    public function query(string $ip): Location;
}
