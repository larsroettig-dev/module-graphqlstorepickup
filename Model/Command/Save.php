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

namespace LarsRoettig\GraphQLStorePickup\Model\Command;

use Exception;
use LarsRoettig\GraphQLStorePickup\Api\Data\StoreInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use LarsRoettig\GraphQLStorePickup\Model\ResourceModel\Store as StoreResourceModel;

class Save
{

    /**
     * @param StoreResourceModel $storeResourceModel
     */
    public function __construct(StoreResourceModel $storeResourceModel)
    {
        $this->storeResourceModel = $storeResourceModel;
    }

    /**
     * @param StoreInterface $store
     * @throws CouldNotSaveException
     */
    public function execute(StoreInterface $store)
    {
        try {
            $this->storeResourceModel->save($store);
        } catch (Exception $e) {
            throw new CouldNotSaveException(__('Could not save Source'), $e);
        }
    }
}
