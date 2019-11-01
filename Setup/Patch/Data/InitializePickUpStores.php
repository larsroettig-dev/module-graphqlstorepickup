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

namespace LarsRoettig\GraphQLStorePickup\Setup\Patch\Data;

use LarsRoettig\GraphQLStorePickup\Api\Data\StoreInterface;
use LarsRoettig\GraphQLStorePickup\Api\Data\StoreInterfaceFactory;
use LarsRoettig\GraphQLStorePickup\Api\StoreRepositoryInterface;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class InitializePickUpStores implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;
    /**
     * @var StoreInterfaceFactory
     */
    private $storeInterfaceFactory;
    /**
     * @var StoreRepositoryInterface
     */
    private $storeRepository;
    /**
     * @var DataObjectHelper
     */
    private $dataObjectHelper;

    /**
     * EnableSegmentation constructor.
     *
     * @param ModuleDataSetupInterface $moduleDataSetup
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        StoreInterfaceFactory $storeInterfaceFactory,
        StoreRepositoryInterface $storeRepository,
        DataObjectHelper $dataObjectHelper
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->storeInterfaceFactory = $storeInterfaceFactory;
        $this->storeRepository = $storeRepository;
        $this->dataObjectHelper = $dataObjectHelper;
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     * @throws Exception
     * @throws Exception
     */
    public function apply()
    {
        $this->moduleDataSetup->startSetup();
        $maxStore = 50;

        $citys = ['Rosenheim', 'Kolbermoor', 'München', 'Erfurt', 'Berlin'];

        for ($i = 1; $i <= $maxStore; $i++) {

            $storeData = [
                StoreInterface::NAME => 'Brick and Mortar ' . $i,
                StoreInterface::STREET => 'Test Street' . $i,
                StoreInterface::STREET_NUM => $i * random_int(1, 100),
                StoreInterface::CITY => $citys[random_int(0, 4)],
                StoreInterface::POSTCODE => $i * random_int(1000, 9999),
                StoreInterface::LATITUDE => random_int(4757549, 5041053) / 100000,
                StoreInterface::LONGITUDE => random_int(1157549, 1341053) / 100000,
            ];
            /** @var StoreInterface $store */
            $store = $this->storeInterfaceFactory->create();
            $this->dataObjectHelper->populateWithArray($store, $storeData, StoreInterface::class);
            $this->storeRepository->save($store);
        }

        $this->moduleDataSetup->endSetup();
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
