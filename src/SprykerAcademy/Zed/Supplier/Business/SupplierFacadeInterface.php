<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace SprykerAcademy\Zed\Supplier\Business;

use Generated\Shared\Transfer\SupplierCollectionTransfer;
use Generated\Shared\Transfer\SupplierCriteriaTransfer;
use Generated\Shared\Transfer\SupplierLocationCollectionTransfer;
use Generated\Shared\Transfer\SupplierLocationCriteriaTransfer;
use Generated\Shared\Transfer\SupplierTransfer;

interface SupplierFacadeInterface
{
    /**
     * - Creates a new supplier into the database
     *
     * @api
     */
    public function createSupplier(SupplierTransfer $supplierTransfer): SupplierTransfer;

    /**
     * @api
     *
     * @return array<\Generated\Shared\Transfer\SupplierTransfer>
     */
    public function getSuppliers(SupplierCriteriaTransfer $supplierCriteriaTransfer): array;

    /**
     * Specification:
     * - Retrieves supplier collection by criteria.
     * - Returns array of SupplierTransfer objects.
     *
     * @api
     *
     * @return array<\Generated\Shared\Transfer\SupplierTransfer>
     */
    public function getSupplierCollection(SupplierCriteriaTransfer $supplierCriteriaTransfer): array;

    /**
     * - Finds a supplier by id.
     * - Returns null when a supplier is not found.
     *
     * @api
     */
    public function findSupplierById(int $idSupplier): ?SupplierTransfer;

    /**
     * - Updates an existing supplier.
     * - Requires `SupplierTransfer.idSupplier`.
     * - Returns the updated supplier transfer.
     *
     * @api
     */
    public function updateSupplier(SupplierTransfer $supplierTransfer): SupplierTransfer;

    /**
     * - Deletes supplier by `SupplierTransfer.idSupplier`.
     *
     * @api
     */
    public function deleteSupplier(SupplierTransfer $supplierTransfer): void;

    /**
     * Specification:
     * - Retrieves the supplier locations that match the criteria.
     * - Filters by `SupplierLocationCriteriaTransfer.fkSupplier`, `.fksSupplier` and `.idSupplierLocation` when they are set.
     *
     * @api
     */
    public function getSupplierLocationCollection(
        SupplierLocationCriteriaTransfer $supplierLocationCriteriaTransfer,
    ): SupplierLocationCollectionTransfer;

    /**
     * Specification:
     * - Retrieves one page of suppliers, ordered by id.
     * - Uses `SupplierCriteriaTransfer.pagination.offset` and `.limit`; without a pagination it returns all suppliers.
     * - Sets `SupplierCollectionTransfer.pagination.nbResults` to the number of suppliers that match the criteria.
     *
     * @api
     */
    public function getPaginatedSupplierCollection(
        SupplierCriteriaTransfer $supplierCriteriaTransfer,
    ): SupplierCollectionTransfer;
}
