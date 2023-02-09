<?php

namespace WirelessLogic;

require "vendor/autoload.php";

$offersBuilder = new OffersBuilder();

$offersObj = $offersBuilder->getOffers('http://wltest.dns-systems.net/', '.package');

$offersArr = $offersBuilder->getOffersArr($offersObj);

$offersArr = $offersBuilder->sortOffersArr($offersArr, 'price');

$offersBuilder->returnJson($offersArr);
