<?php

declare(strict_types=1);

namespace Delivery\Domain\Entity\Shared;

use Delivery\Domain\Exceptions\DomainException;

final class Name
{
    private const MAX_LENGTH = 50;

    private function __construct(public readonly string $value) {
        $this->validateLength($value);
    }

    // -------- private functions --------

    private function validateLength(string $value): void
    {
        if ($value === '') throw new DomainException("名前が空文字です。入力値:[$value]");
        if (mb_strlen($value) > self::MAX_LENGTH) throw new DomainException("名前の文字数が50文字を超えています。入力値:[$value]");
    }

    // -------- static functions --------

    static public function of(string $value): Name
    {
        return new Name($value);
    }
}
