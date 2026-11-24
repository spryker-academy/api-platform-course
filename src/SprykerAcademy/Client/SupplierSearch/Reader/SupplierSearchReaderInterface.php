<?php

declare(strict_types=1);

namespace SprykerAcademy\Client\SupplierSearch\Reader;

use Generated\Shared\Transfer\SupplierCollectionTransfer;
use Generated\Shared\Transfer\SupplierTransfer;

interface SupplierSearchReaderInterface
{
    /**
     * @param array<mixed> $requestParameters
     */
    public function searchSuppliers(array $requestParameters = []): SupplierCollectionTransfer;

    public function findSupplierById(int $idSupplier): SupplierTransfer;
}
