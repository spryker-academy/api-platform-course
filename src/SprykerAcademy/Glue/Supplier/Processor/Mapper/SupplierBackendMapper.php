<?php
declare(strict_types=1);
namespace SprykerAcademy\Glue\Supplier\Processor\Mapper;
use Generated\Api\Backend\SuppliersBackendResource;
use Generated\Shared\Transfer\SupplierTransfer;
class SupplierBackendMapper
{
    public function mapSupplierTransferToSuppliersBackendResource(
        SupplierTransfer $supplierTransfer,
    ): SuppliersBackendResource {
        $supplierData = $supplierTransfer->toArray(false, true);
        unset($supplierData[SupplierTransfer::SUPPLIER_LOCATIONS]);
        return SuppliersBackendResource::fromArray($supplierData);
    }
}
