<?php

namespace App\DTOs;

use Exception;
use JsonSerializable;

readonly class Cidr implements JsonSerializable
{
    public static function parse(string $subnet): self
    {
        $parts = explode('/', $subnet);
        $count = count($parts);
        if ($count == 1) {
            throw new Exception('Cannot find prefix');
        }
        if ($count > 2) {
            throw new Exception('Subnet is malformed');
        }
        $prefix = intval($parts[1]);
        $network = $parts[0];

        return new self($network, $prefix);
    }

    public function __construct(
        public string $network,
        public int $prefix
    ) {}

    public function __toString(): string
    {
        return $this->network.'/'.$this->prefix;
    }

    public function jsonSerialize(): string
    {
        return $this->__toString();
    }
}
