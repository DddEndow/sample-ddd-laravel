<?php

declare(strict_types=1);

namespace  Delivery\Domain\Tests\Unit\UseCases\Shared;

use Delivery\Domain\Entity\Shared\Name;
use Delivery\Domain\Exceptions\DomainException;
use PHPUnit\Framework\TestCase;

class NameTest extends TestCase
{
    public function test_Nameを作成できること(): void
    {
        // given:
        $nameString = 'item name';

        // when:
        $result = Name::of('item name');

        // then:
        $this->assertEquals($nameString, $result->value);
    }

    public function test_文字数が50文字の場合、Nameを作成できること(): void
    {
        // given:
        $nameString = str_repeat('a', 50);

        // when:
        $result = Name::of($nameString);

        // then:
        $this->assertEquals($nameString, $result->value);
    }

    public function test_名前の文字数が50文字を超える場合エラーになること(): void
    {
        // given:
        $nameString = str_repeat('a', 51);

        // when:

        // then:
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage("名前の文字数が50文字を超えています。入力値:[$nameString]");
        Name::of($nameString);
    }

    public function test_名前が空文字の場合エラーになること(): void
    {
        // given:
        $nameString = '';

        // when:

        // then:
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage("名前が空文字です。入力値:[$nameString]");
        Name::of($nameString);
    }
}
