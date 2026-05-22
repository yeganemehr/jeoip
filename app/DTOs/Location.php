<?php

namespace App\DTOs;

readonly class Location
{
    public bool $isEU;

    public function __construct(
        public string $ip,
        public string $ipDecimal,
        public int $ipVersion,
        public string $countryCode,
        public Cidr $subnet,
        public string $country,
        public string $region,
        public string $city,
        public ?int $asn,
        public ?string $asn_org,
        public float $latitude,
        public float $longitude,
        public string $zipcode,
        public string $timezone,
        public ?string $hostname,
    ) {
        $this->isEU = in_array($countryCode, [
            'BE', 'EL', 'LT', 'PT', 'BG', 'ES', 'LU', 'RO', 'CZ', 'FR', 'HU', 'SI', 'DK', 'HR', 'MT', 'SK', 'DE', 'IT', 'NL', 'FI', 'EE', 'CY', 'AT', 'SE', 'IE', 'LV', 'PL',
        ]);
    }

    public function jsonSerialize(): array
    {
        $data = [
            'ip' => $this->ip,
            'ip_decimal' => $this->ipDecimal,
            'ip_version' => $this->ipVersion,
            'subnet' => $this->subnet,
            'countryCode' => $this->countryCode,
            'country_code' => $this->countryCode,
            'country' => $this->country,
            'country_eu' => $this->isEU,
            'region' => $this->region,
            'city' => $this->city,
            'asn' => $this->asn,
            'asn_org' => $this->asn_org,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'zipcode' => $this->zipcode,
            'timezone' => $this->timezone,
            'hostname' => $this->hostname,
        ];

        return $data;
    }
}
