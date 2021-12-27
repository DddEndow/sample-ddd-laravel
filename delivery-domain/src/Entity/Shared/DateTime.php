<?php

declare(strict_types=1);

namespace Delivery\Domain\Entity\Shared;

use DateTime as PHPDateTime;

final class DateTime
{
    private function __construct(public readonly PHPDateTime $value) {}

    // -------- private functions --------

    // -------- static functions --------

    static public function fromString(string $value): DateTime
    {
        return new DateTime(new PHPDateTime($value));
    }

    static public function fromDateTime(PHPDateTime $value): DateTime
    {
        return new DateTime($value);
    }

    static public function now(): DateTime
    {
        return new DateTime((new PHPDateTime()));
    }
}
