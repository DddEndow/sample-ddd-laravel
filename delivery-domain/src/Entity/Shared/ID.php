<?php

declare(strict_types=1);

namespace Delivery\Domain\Entity\Shared;

use Delivery\Domain\Exceptions\DomainException;
use Symfony\Component\Uid\Ulid;

abstract class ID
{
    protected function __construct(public readonly string $value)
    {
        $this->validateId($value);
    }

    // -------- private functions --------

    private function validateId(string $id): void
    {
        if (!Ulid::isValid($id)) throw new DomainException('ULIDではない文字列が渡されました。');
    }

    // -------- static functions --------

    static public function gen(): static
    {
        return new static((new Ulid())->toBase32());
    }

    static public function from(string $id): static
    {
        return new static(Ulid::fromString($id)->toBase32());
    }
}
