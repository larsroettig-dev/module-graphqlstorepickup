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
use LarsRoettig\GraphQLStorePickup\Api\StoreRepositoryInterface;
use LarsRoettig\GraphQLStorePickup\Model\Command\GetList as ListCommand;
use LarsRoettig\GraphQLStorePickup\Model\Command\Save as SaveCommand;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;

class StoreRepository implements StoreRepositoryInterface
{
    /**
     * @var SaveCommand
     */
    private $saveCommand;

    /**
     * @var ListCommand
     */
    private $listCommand;

    /**
     * @param SaveCommand $saveCommand
     * @param ListCommand $listCommand
     */
    public function __construct(SaveCommand $saveCommand, ListCommand $listCommand)
    {
        $this->saveCommand = $saveCommand;
        $this->listCommand = $listCommand;
    }

    /**
     * @inheritDoc
     */
    public function save(StoreInterface $store): void
    {
        $this->saveCommand->execute($store);
    }

    /**
     * @inheritDoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria = null): SearchResultsInterface
    {
        return $this->listCommand->execute($searchCriteria);
    }
}
