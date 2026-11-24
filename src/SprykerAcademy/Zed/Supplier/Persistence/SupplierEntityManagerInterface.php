<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademy\Zed\Supplier\Persistence;

use Generated\Shared\Transfer\SupplierTransfer;

interface SupplierEntityManagerInterface
{
    public function createSupplier(SupplierTransfer $supplierTransfer): SupplierTransfer;

    public function updateSupplier(SupplierTransfer $supplierTransfer): SupplierTransfer;

    public function deleteSupplier(SupplierTransfer $supplierTransfer): void;

    /**
     * Deletes the locations of the supplier (pyz_supplier_location references it).
     */
    public function deleteSupplierLocations(int $idSupplier): void;

    /**
     * Deletes the merchant assignments of the supplier (pyz_merchant_to_supplier references it).
     */
    public function deleteSupplierMerchantRelations(int $idSupplier): void;
}
