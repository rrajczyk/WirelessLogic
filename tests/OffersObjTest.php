<?php

declare(strict_types=1);

use WirelessLogic\OffersBuilder;
use PHPUnit\Framework\TestCase;

final class OffersObjTest extends TestCase
{
    public function test_instanceOf() {

        $dom = Mockery::mock('Dom');
        $offersBuilder = new OffersBuilder($dom);

        $this->assertInstanceOf(OffersBuilder::class, $offersBuilder);
    }

    public function testOffersObj(): void
    {
        $dom = Mockery::mock('Dom');
        $offersBuilder = new OffersBuilder($dom);

        $offersObj = $offersBuilder->getOffers('http://wltest.dns-systems.net/', '.package');

        $this->assertIsObject($offersObj);
    }

    public function testSortOffersArr(): void
    {
        $dom = Mockery::mock('Dom');
        $offersBuilder = new OffersBuilder($dom);

        $offersArr[] = [
            'title' => 'Optimum: 24GB Data - 1 Year',
            'name' => 'The optimum subscription providing..'  ,
            'description' => 'Up to 12GB of data per year..',
            'priceStr' => '£174.00',
            'price' => 174,
            'discount' => 'Save £17.90 on the monthly price'
        ];

        $offersArr[] = [
            'title' => 'Basic: 500MB Data - 12 Months',
            'name' => 'The basic starter subscription providing you with ...',
            'description' => 'Up to 500MB of data per month..',
            'priceStr' => '£5.99',
            'price' => 5.99,
            'discount' => ""
        ];

        $offersObj = $offersBuilder->sortOffersArr($offersArr, 'price');

        $this->assertIsArray($offersObj);
    }
}