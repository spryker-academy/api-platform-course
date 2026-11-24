<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademy\Zed\Supplier\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\SupplierLocationTransfer;
use Generated\Shared\Transfer\SupplierTransfer;
use Orm\Zed\Supplier\Persistence\PyzSupplier;
use Orm\Zed\SupplierLocation\Persistence\PyzSupplierLocation;

class SupplierMapper
{
    public function mapSupplierTransferToSupplierEntity(
        SupplierTransfer $supplierTransfer,
        PyzSupplier $supplierEntity,
    ): PyzSupplier {
        return $supplierEntity->fromArray($supplierTransfer->modifiedToArray());
    }

    public function mapSupplierEntityToSupplierTransfer(
        PyzSupplier $supplierEntity,
        SupplierTransfer $supplierTransfer,
    ): SupplierTransfer {
        return $supplierTransfer->fromArray($supplierEntity->toArray(), true);
    }

    public function mapSupplierLocationEntityToSupplierLocationTransfer(
        PyzSupplierLocation $supplierLocationEntity,
        SupplierLocationTransfer $supplierLocationTransfer,
    ): SupplierLocationTransfer {
        return $supplierLocationTransfer->fromArray($supplierLocationEntity->toArray(), true);
    }
}
