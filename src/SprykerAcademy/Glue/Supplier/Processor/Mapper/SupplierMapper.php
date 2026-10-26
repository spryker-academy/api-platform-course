<?php
declare(strict_types=1);
namespace SprykerAcademy\Glue\Supplier\Processor\Mapper;
use Generated\Api\Storefront\SuppliersStorefrontResource;
use Generated\Shared\Transfer\SupplierTransfer;
class SupplierMapper
{
    public function mapSupplierTransferToSuppliersStorefrontResource(
        SupplierTransfer $supplierTransfer,
    ): SuppliersStorefrontResource {
        $supplierData = $supplierTransfer->toArray(false, true);
        unset($supplierData[SupplierTransfer::SUPPLIER_LOCATIONS]);
        return SuppliersStorefrontResource::fromArray($supplierData);
    }
}
