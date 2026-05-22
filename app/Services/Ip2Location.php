<?php

namespace App\Services;

use App\Contracts\IGeoIPService;
use App\DTOs\Cidr;
use App\DTOs\Location;
use App\Exceptions\PrivateClassException;
use App\Exceptions\QueryException;
use App\Exceptions\UnknownLocationException;
use Illuminate\Container\Attributes\Config;
use Illuminate\Container\Attributes\Singleton;
use Illuminate\Support\Arr;
use IP2Location\Database;
use Symfony\Component\HttpFoundation\IpUtils;

#[Singleton]
class Ip2Location implements IGeoIPService
{
    public readonly Database $generalDatabase;

    public readonly Database $asnDatabase;

    public function __construct(
        #[Config('ip2location.databases.general')]
        string $generalDatabase,

        #[Config('ip2location.databases.asn')]
        string $asnDatabase,
    ) {
        $this->generalDatabase = new Database($generalDatabase);
        $this->asnDatabase = new Database($asnDatabase);
    }

    public function query(string $ip): Location
    {
        if (! filter_var($ip, FILTER_VALIDATE_IP)) {
            throw new QueryException($ip, 'Invalid IP', 422);
        }

        if (IpUtils::isPrivateIp($ip)) {
            throw new PrivateClassException($ip);
        }

        $generalInfo = $this->generalDatabase->lookup($ip, [
            Database::IP_ADDRESS,
            Database::IP_VERSION,
            Database::IP_NUMBER,
            Database::COUNTRY,
            Database::COORDINATES,
            Database::REGION_NAME,
            Database::CITY_NAME,
            Database::ZIP_CODE,
            Database::TIME_ZONE,
        ]);
        if ($generalInfo === false || $generalInfo['countryCode'] == '-') {
            throw new UnknownLocationException($ip);
        }
        $asInfo = $this->asnDatabase->lookup($ip, [
            Database::AS,
            Database::ASN,
        ]);
        foreach (['as', 'asn'] as $k) {
            if ($asInfo[$k] === '-') {
                $asInfo[$k] = null;
            }
        }

        if ($generalInfo['ipVersion'] === 6 || ! ($cidrs = $this->generalDatabase->getCidr($ip))) {
            $cidrs = [
                IpUtils::anonymize($ip).'/'.($generalInfo['ipVersion'] == 4 ? 24 : 64),
            ];
        }

        return new Location(
            ip: $ip,
            ipDecimal: $generalInfo['ipNumber'],
            ipVersion: $generalInfo['ipVersion'],
            countryCode: $generalInfo['countryCode'],
            subnet: Cidr::parse(Arr::last($cidrs)),
            country: $generalInfo['countryName'],
            region: $generalInfo['regionName'],
            city: $generalInfo['cityName'],
            latitude: $generalInfo['latitude'],
            longitude: $generalInfo['longitude'],
            zipcode: $generalInfo['zipCode'],
            timezone: $generalInfo['timeZone'],
            asn: $asInfo['asn'],
            asn_org: $asInfo['as'],
            hostname: $this->resolveHostname($ip),
        );
    }

    private function resolveHostname(string $ip): ?string
    {
        $hostname = gethostbyaddr($ip);

        if ($hostname === false || $hostname === $ip) {
            return null;
        }

        return $hostname;
    }
}
