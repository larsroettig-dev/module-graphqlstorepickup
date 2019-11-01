<?php
/**
 * Copyright (c) 2019 Lars Roettig
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */
declare(strict_types=1);

namespace LarsRoettig\GraphQLStorePickup\Model;

use LarsRoettig\GraphQLStorePickup\Api\Data\StoreInterface;
use LarsRoettig\GraphQLStorePickup\Model\ResourceModel\Store as StoreResourceModel;
use Magento\Framework\Model\AbstractExtensibleModel;

class Store extends AbstractExtensibleModel implements StoreInterface
{

    protected function _construct()
    {
        $this->_init(StoreResourceModel::class);
    }

    public function getName(): ?string
    {
        return $this->getData(self::NAME);
    }

    public function setName(?string $name): void
    {
        $this->setData(self::NAME, $name);
    }

    public function getStreet(): ?string
    {
        return $this->getData(self::STREET);
    }

    public function setStreet(?string $street): void
    {
        $this->setData(self::STREET, $street);
    }

    public function getStreetNum(): ?int
    {
        return $this->getData(self::STREET_NUM);
    }

    public function setStreetNum(?int $streetNum): void
    {
        $this->setData(self::STREET_NUM, $streetNum);
    }

    public function getCity(): ?string
    {
        return $this->getData(self::CITY);
    }

    public function setCity(?string $city): void
    {
        $this->setData(self::CITY, $city);
    }

    public function getPostCode(): ?int
    {
        return $this->getData(self::POSTCODE);
    }

    public function setPostcode(?int $postCode): void
    {
        $this->setData(self::POSTCODE, $postCode);
    }

    public function getLatitude(): ?float
    {
        return $this->getData(self::LATITUDE);
    }

    public function setLatitude(?float $latitude): void
    {
        $this->setData(self::LATITUDE, $latitude);
    }

    public function getLongitude(): ?float
    {
        return $this->getData(self::LONGITUDE);
    }

    public function setLongitude(?float $longitude): void
    {
        $this->setData(self::LONGITUDE, $longitude);
    }
}
