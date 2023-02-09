<?php

declare(strict_types=1);

use WirelessLogic\OffersBuilder;
use PHPUnit\Framework\TestCase;

final class PriceTest extends TestCase
{
    public function testPrice(): void
    {
        $this->assertEquals(69.99, ltrim("£69.99", '£' ));
    }
}