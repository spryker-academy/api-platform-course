<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademy\Zed\Supplier\Persistence;

use Generated\Shared\Transfer\SupplierCriteriaTransfer;
use Generated\Shared\Transfer\SupplierLocationCollectionTransfer;
use Generated\Shared\Transfer\SupplierLocationCriteriaTransfer;
use Generated\Shared\Transfer\SupplierTransfer;

interface SupplierRepositoryInterface
{
    public function getSuppliers(SupplierCriteriaTransfer $supplierCriteriaTransfer): array;

    public function findSupplierById(int $idSupplier): ?SupplierTransfer;

    public function getSupplierLocationCollection(
        SupplierLocationCriteriaTransfer $supplierLocationCriteriaTransfer,
    ): SupplierLocationCollectionTransfer;
}
