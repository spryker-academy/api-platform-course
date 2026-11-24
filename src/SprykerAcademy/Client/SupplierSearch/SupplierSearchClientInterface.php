<?php

declare(strict_types=1);

namespace SprykerAcademy\Client\SupplierSearch;

use Generated\Shared\Transfer\SupplierCollectionTransfer;
use Generated\Shared\Transfer\SupplierTransfer;

interface SupplierSearchClientInterface
{
    /**
     * Specification:
     * - Searches suppliers in Elasticsearch.
     * - Returns a SupplierCollectionTransfer with matching suppliers.
     *
     * @api
     *
     * @param array<mixed> $requestParameters
     */
    public function searchSuppliers(array $requestParameters = []): SupplierCollectionTransfer;

    /**
     * Specification:
     * - Finds a single supplier by ID from Elasticsearch.
     * - Returns an empty transfer when not found.
     *
     * @api
     *
     */
    public function findSupplierById(int $idSupplier): SupplierTransfer;
}
