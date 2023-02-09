<?php

namespace WirelessLogic;
interface ParserInterface
{
    public function setPackage(object $content);
    public function getData(string $data);
    public function getPrice(string $data);
}

class Parser implements ParserInterface
{
    private $content;
    public function setPackage(object $content) : void
    {
        $this->content = $content;
    }

    public function getData(string $data) : string
    {
        return count($this->content->find($data)) > 0  ? $this->content->find($data)->innerHtml : '';
    }

    public function getPrice(string $data) : float
    {
        $price = $this->getData($data);

        return ltrim($price, '£' );
    }
}