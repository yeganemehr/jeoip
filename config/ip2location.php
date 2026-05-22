<?php

return [
    'databases' => [
        'general' => env('IP2LOCATION_GENERAL_DB', storage_path('app/ip2location.db11.bin')),
        'asn' => env('IP2LOCATION_ASN_DB', storage_path('app/ip2location.asn.bin')),
    ],
];
