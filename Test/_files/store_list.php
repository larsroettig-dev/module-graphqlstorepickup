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

use LarsRoettig\GraphQLStorePickup\Api\Data\StoreInterface;
use LarsRoettig\GraphQLStorePickup\Api\Data\StoreInterfaceFactory;
use LarsRoettig\GraphQLStorePickup\Api\StoreRepositoryInterface;
use Magento\Framework\Api\DataObjectHelper;
use Magento\TestFramework\Helper\Bootstrap;

/** @var StoreInterfaceFactory $sourceFactory */
$storeFactory = Bootstrap::getObjectManager()->get(StoreInterfaceFactory::class);
/** @var DataObjectHelper $dataObjectHelper */
$dataObjectHelper = Bootstrap::getObjectManager()->get(DataObjectHelper::class);
/** @var SourceRepositoryInterface $sourceRepository */
$storeRepository = Bootstrap::getObjectManager()->get(StoreRepositoryInterface::class);

$storeListData = [
    [
        StoreInterface::NAME => 'Test Store 1',
        StoreInterface::STREET => 'Test Street',
        StoreInterface::STREET_NUM => 200,
        StoreInterface::CITY => 'MusterCity',
        StoreInterface::POSTCODE => 83559,
        StoreInterface::LATITUDE => 47.85637,
        StoreInterface::LONGITUDE => 11.57549
    ],
    [
        StoreInterface::NAME => 'Test Store 2',
        StoreInterface::STREET => 'FooBazStr.',
        StoreInterface::STREET_NUM => 200,
        StoreInterface::CITY => 'MusterCity',
        StoreInterface::POSTCODE => 99559,
        StoreInterface::LATITUDE => 50.85637,
        StoreInterface::LONGITUDE => 12.57549
    ]
];

foreach ($storeListData as $storeData) {
    $store = $storeFactory->create();
    $dataObjectHelper->populateWithArray($store, $storeData, StoreInterface::class);
    $storeRepository->save($store);
}
