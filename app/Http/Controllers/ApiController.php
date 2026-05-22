<?php

namespace App\Http\Controllers;

use App\Http\Resources\LocationResource;
use App\Services\Ip2Location;
use Illuminate\Http\Request;

readonly class ApiController
{
    public function __construct(
        public Ip2Location $ip2location
    ) {}

    public function query(Request $request, ?string $ip = null): LocationResource
    {
        $location = $this->ip2location->query($ip ?? $request->ip());

        return new LocationResource($location);
    }

    public function ip(Request $request, ?string $ip = null): string
    {
        return $ip ?? $request->ip();
    }

    public function country(Request $request, ?string $ip = null): string
    {
        return $this->ip2location->query($ip ?? $request->ip())->country;
    }

    public function countryCode(Request $request, ?string $ip = null)
    {
        return $this->ip2location->query($ip ?? $request->ip())->countryCode;
    }

    public function city(Request $request, ?string $ip = null): string
    {
        return $this->ip2location->query($ip ?? $request->ip())->city;
    }

    public function asn(Request $request, ?string $ip = null): string
    {
        return $this->ip2location->query($ip ?? $request->ip())->asn;
    }
}
