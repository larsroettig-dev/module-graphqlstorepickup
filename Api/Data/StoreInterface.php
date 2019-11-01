<?php

declare(strict_types=1);

namespace LarsRoettig\GraphQLStorePickup\Api\Data;

/**
 * Represents a store and properties
 *
 * @api
 */
interface StoreInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const NAME = 'name';
    const STREET = 'street';
    const STREET_NUM = 'street_num';
    const CITY = 'city';
    const POSTCODE = 'postcode';
    const LATITUDE = 'latitude';
    const LONGITUDE = 'longitude';

    /**#@-*/

    public function getName(): ?string;

    public function setName(?string $name): void;

    public function getStreet(): ?string;

    public function setStreet(?string $street): void;

    public function getStreetNum(): ?int;

    public function setStreetNum(?int $streetNum): void;

    public function getCity(): ?string;

    public function setCity(?string $city): void;

    public function getPostCode(): ?int;

    public function setPostcode(?int $postCode): void;

    public function getLatitude(): ?float;

    public function setLatitude(?float $latitude): void;

    public function getLongitude(): ?float;

    public function setLongitude(?float $longitude): void;
}
