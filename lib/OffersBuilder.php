<?php

namespace WirelessLogic;

use PHPHtmlParser\Dom;
use WirelessLogic\Parser as Parser;

interface OffersBuilderInterface
{
    public function getOffers(string $url, string $data);
    public function getOffersArr(object $packages);
    public function sortOffersArr(array $offersArr, string $key);
    public function returnJson(array $offersArr);
}

class OffersBuilder extends Parser implements OffersBuilderInterface
{
    private $dom;

    public function __construct()
    {
        $this->dom = new Dom;
    }

    public function getOffers(string $url, string $data): object
    {
        $this->dom->loadFromUrl($url);

        $offers = $this->dom->find($data);

        return $offers;
    }

    public function getOffersArr(object $packages): array
    {
        $offers = [];

        foreach ($packages as $package) {

            $this->setPackage($package);

            $offers[] = [
                'title' => $this->getData('h3'),
                'name' => $this->getData('.package-name'),
                'description' => $this->getData('.package-description'),
                'priceStr' => $this->getData('.price-big'),
                'price' => $this->getPrice('.price-big'),
                'discount' => $this->getData('p')
            ];
        }

        return $offers;
    }

    public function sortOffersArr(array $offersArr, string $key): array
    {
        array_multisort(array_column($offersArr, $key), SORT_DESC, $offersArr);

        return $offersArr;
    }

    public function returnJson(array $offersArr): void
    {
        header('Content-Type: application/json; charset=utf-8');

        echo json_encode($offersArr);
    }
}