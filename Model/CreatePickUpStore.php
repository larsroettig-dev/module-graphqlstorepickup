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
use LarsRoettig\GraphQLStorePickup\Api\Data\StoreInterfaceFactory;
use LarsRoettig\GraphQLStorePickup\Api\StoreRepositoryInterface;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;

class CreatePickUpStore
{

    /**
     * @var DataObjectHelper
     */
    private $dataObjectHelper;
    /**
     * @var StoreRepositoryInterface
     */
    private $storeRepository;
    /**
     * @var StoreInterfaceFactory
     */
    private $storeFactory;

    /**
     * @param DataObjectHelper $dataObjectHelper
     * @param StoreRepositoryInterface $storeRepository
     * @param StoreInterfaceFactory $storeInterfaceFactory
     */
    public function __construct(
        DataObjectHelper $dataObjectHelper,
        StoreRepositoryInterface $storeRepository,
        StoreInterfaceFactory $storeInterfaceFactory
    ) {
        $this->dataObjectHelper = $dataObjectHelper;
        $this->storeRepository = $storeRepository;
        $this->storeFactory = $storeInterfaceFactory;
    }

    /**
     * @param array $data
     * @return StoreInterface
     * @throws GraphQlInputException
     */
    public function execute(array $data): StoreInterface
    {
        try {
            $this->vaildateData($data);
            $store = $this->createStore($data);
        } catch (LocalizedException $e) {
            throw new GraphQlInputException(__($e->getMessage()));
        }

        return $store;
    }

    /**
     * Guard function to handle bad request.
     * @param array $data
     * @throws LocalizedException
     */
    private function vaildateData(array $data)
    {
        if (!isset($data[StoreInterface::NAME])) {
            throw new LocalizedException(__('Name must be set'));
        }
    }

    /**
     * @param array $data
     * @return StoreInterface
     * @throws CouldNotSaveException
     */
    private function createStore(array $data): StoreInterface
    {
        /** @var StoreInterface $storeDataObject */
        $storeDataObject = $this->storeFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $storeDataObject,
            $data,
            StoreInterface::class
        );

        $this->storeRepository->save($storeDataObject);

        return $storeDataObject;
    }
}
