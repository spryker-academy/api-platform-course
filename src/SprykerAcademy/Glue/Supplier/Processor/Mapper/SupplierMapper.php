<?php
declare(strict_types=1);
namespace SprykerAcademy\Glue\Supplier\Processor\Mapper;
use Generated\Api\Storefront\SupplierLocationsStorefrontResource;
use Generated\Api\Storefront\SuppliersStorefrontResource;
use Generated\Shared\Transfer\SupplierLocationTransfer;
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
    public function mapSupplierLocationTransferToResource(
        SupplierLocationTransfer $locationTransfer,
    ): SupplierLocationsStorefrontResource {
        $resource = SupplierLocationsStorefrontResource::fromArray(
            $locationTransfer->toArray(false, true),
        );
        $resource->idSupplier = $locationTransfer->getFkSupplier();
        return $resource;
    }
}
