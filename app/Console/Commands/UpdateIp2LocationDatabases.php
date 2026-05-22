<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Container\Attributes\Config;
use Illuminate\Support\Facades\Http;
use ZipArchive;

#[Signature('ip2location:update')]
#[Description('Download the latest IP2Location databases.')]
class UpdateIp2LocationDatabases extends Command
{
    private const ENDPOINT = 'https://www.ip2location.com/download';

    private const DATABASES = [
        'DB11LITEBINIPV6' => 'general',
        'DBASNLITEBINIPV6' => 'asn',
    ];

    public function handle(
        #[Config('ip2location.token')]
        ?string $token,

        #[Config('ip2location.databases.general')]
        string $generalDatabase,

        #[Config('ip2location.databases.asn')]
        string $asnDatabase,
    ): int {
        if ($token === null || $token === '') {
            $this->error('Missing IP2LOCATION_TOKEN.');

            return self::FAILURE;
        }

        $paths = ['general' => $generalDatabase, 'asn' => $asnDatabase];

        foreach (self::DATABASES as $db => $key) {
            $this->info("Downloading {$db}...");
            $this->download($token, $db, $paths[$key]);
            $this->info("Saved to {$paths[$key]}");
        }

        return self::SUCCESS;
    }

    private function download(string $token, string $db, string $destination): void
    {
        $zipPath = tempnam(sys_get_temp_dir(), 'ip2location_');

        Http::sink($zipPath)
            ->get(self::ENDPOINT, ['token' => $token, 'file' => $db])
            ->throw();

        $zip = new ZipArchive;
        $zip->open($zipPath);

        for ($i = 0; $i < $zip->numFiles; $i++) {
            $name = $zip->getNameIndex($i);

            if (str_ends_with(strtoupper($name), '.BIN')) {
                file_put_contents($destination, $zip->getStream($name));
                break;
            }
        }

        $zip->close();
        unlink($zipPath);
    }
}
