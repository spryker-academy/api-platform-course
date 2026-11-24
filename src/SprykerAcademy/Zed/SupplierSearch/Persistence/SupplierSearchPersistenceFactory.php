<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademy\Zed\SupplierSearch\Persistence;

use Orm\Zed\SupplierSearch\Persistence\PyzSupplierSearchQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;
use SprykerAcademy\Zed\SupplierSearch\Persistence\Propel\Mapper\SupplierSearchMapper;

/**
 * @method \SprykerAcademy\Zed\SupplierSearch\Persistence\SupplierSearchRepositoryInterface getRepository()
 * @method \SprykerAcademy\Zed\SupplierSearch\Persistence\SupplierSearchEntityManagerInterface getEntityManager()
 */
class SupplierSearchPersistenceFactory extends AbstractPersistenceFactory
{
    public function createSupplierSearchQuery(): PyzSupplierSearchQuery
    {
        return PyzSupplierSearchQuery::create();
    }

    public function createSupplierSearchMapper(): SupplierSearchMapper
    {
        return new SupplierSearchMapper();
    }
}
